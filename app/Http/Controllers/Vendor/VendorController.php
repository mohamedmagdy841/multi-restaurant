<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function vendorDashboard()
    {
        return view('vendor.index');
    }

    public function vendorProfile()
    {
        $city = City::latest()->get();
        $id = Auth::guard('vendor')->id();
        $profileData = Vendor::find($id);
        return view('vendor.vendor_profile',compact('profileData','city'));
    }

    public function vendorProfileStore(Request $request)
    {
        $id = Auth::guard('vendor')->id();
        $data = Vendor::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->city_id = $request->city_id;
        $data->shop_info = $request->shop_info;
        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/vendor_images'),$filename);
            $data->photo = $filename;
            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                unlink(public_path('upload/vendor_images/'.$oldPhotoPath));
            }
        }

        if ($request->hasFile('cover_photo')) {
            $file1 = $request->file('cover_photo');
            $filename1 = time().'.'.$file1->getClientOriginalExtension();
            $file1->move(public_path('upload/vendor_images'),$filename1);
            $data->cover_photo = $filename1;
        }

        $data->save();

        return redirect()->back()->with([
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function vendorChangePassword(){
        $id = Auth::guard('vendor')->id();
        $profileData = Vendor::find($id);
        return view('vendor.vendor_change_Password',compact('profileData'));
    }

    public function vendorPasswordUpdate(Request $request){
        $vendor = Auth::guard('vendor')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        if (!Hash::check($request->old_password,$vendor->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $vendor->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with([
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        ]);
    }
}
