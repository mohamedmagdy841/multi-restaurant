<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function profileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'),$filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                unlink(public_path('upload/user_images/'.$oldPhotoPath));
            }
        }

        $data->save();

        return redirect()->back()->with([
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function userLogout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Logout Successfully');
    }

    public function changePassword(){
        return view('frontend.dashboard.change_password');
    }

    public function userPasswordUpdate(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password,$user->password)) {

            return back()->with([
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            ]);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with([
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ]);
    }
}
