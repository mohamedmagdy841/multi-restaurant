<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class AdminAuthController extends Controller
{
    public function adminLoginForm()
    {
        return view('admin.admin_login');
    }

    public function adminLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful');
        }
        return redirect()->back()->with('error', 'Invalid email or password');
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

//    public function adminForgotPasswordForm()
//    {
//        return view('admin.forgot_password');
//    }
//
//    public function adminResetPasswordLink(Request $request)
//    {
////        $request->validate([
////            'email' => 'required|email',
////        ]);
////
////        $admin_data = Admin::where('email', $request->email)->first();
////        if (!$admin_data) {
////            return redirect()->back()->with('error', 'Email not found');
////        }
////
////        $token = hash('sha256', time());
////        $admin_data->update(['token' => $token]);
////
//////        $reset_link = url('admin/reset_password/' . $token . '/' . $request->email);
////        $reset_link = route('admin.reset_password', ['token' => $token, 'email' => $request->email]);
////        $subject = "Reset Password";
////        $message = "Please click on the link below to reset your password" . "</br>";
////        $message .= "<a href='" . $reset_link . "'>Click Here</a>";
////
////        Mail::to($request->email)->send(new Websitemail($subject, $message));
////        return redirect()->back()->with('success', 'Reset password link sent to your email');
//        $request->validate([
//            'email' => ['required', 'email'],
//        ]);
//
//        $status = Password::sendResetLink(
//            $request->only('email')
//        );
//
//        return $status == Password::RESET_LINK_SENT
//            ? back()->with('status', __($status))
//            : back()->withInput($request->only('email'))
//                ->withErrors(['email' => __($status)]);
//    }
//
//    public function adminResetPasswordForm($token, $email)
//    {
//        $admin_data = Admin::where('token', $token)->where('email', $email)->first();
//        if (!$admin_data) {
//            return redirect()->back()->with('error', 'Invalid or expired reset password link');
//        }
//        return view('admin.reset_password', compact('token', 'email'));
//    }
//
//    public function adminResetPasswordSubmit(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'token' => 'required',
//            'password' => 'required|confirmed',
//        ]);
//
//        $admin_data = Admin::where('email', $request->email)->where('token', $request->token)->first();
//        if (!$admin_data) {
//            return redirect()->route('admin.login')->with('error', 'Invalid or expired reset password link');
//        }
//
//        $admin_data->update([
//            'password' => Hash::make($request->password),
//            'token' => null,
//        ]);
//
//        return redirect()->route('admin.login')->with('success', 'Password reset successfully');
//    }

}
