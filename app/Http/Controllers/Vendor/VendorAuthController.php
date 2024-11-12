<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function vendorRegisterForm()
    {
        return view('vendor.vendor_register');
    }
    public function vendorRegisterSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:vendors',
            'password' => 'required',
            'phone' => 'required|min:11|max:11|unique:vendors',
            'address' => 'required|string|max:200',
        ]);

        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => '0',
        ]);

        return redirect()->route('vendor.login')->with([
            'message' => 'Vendor Register Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function vendorLoginForm()
    {
        return view('vendor.vendor_login');
    }

    public function vendorLoginSubmit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials)) {
            return redirect()->route('vendor.dashboard')->with('success','Login successful');
        }
        return redirect()->back()->with('error','Invalid email or password');
    }

    public function vendorLogout(){
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login')->with('success','Logged out successfully');
    }

}
