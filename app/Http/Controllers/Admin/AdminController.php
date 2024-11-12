<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminProfile()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('upload/admin_images', $fileName);
            $data->photo = $fileName;

            if($oldPhotoPath && $oldPhotoPath !== $fileName){
                unlink('upload/admin_images/' . $oldPhotoPath);
            }
        }
        $data->save();

        return redirect()->back()->with([
            'message' => 'Profile updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function adminProfileChangePassword()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }

    public function adminProfilePasswordUpdate(Request $request){
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$admin->password)) {
            return back()->with([
                'message' => 'Old password does not Match!',
                'alert-type' => 'error'
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with([
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        ]);
    }

}
