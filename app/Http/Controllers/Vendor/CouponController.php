<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function allCoupon()
    {
        $cid = Auth::guard('vendor')->id();
        $coupon = Coupon::where('vendor_id',$cid )->latest()->get();
        return view('vendor.backend.coupon.all_coupon', compact('coupon'));
    }

    public function addCoupon()
    {

        return view('vendor.backend.coupon.add_coupon' );
    }

    public function storeCoupon(Request $request)
    {

        Coupon::create([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_desc' => $request->coupon_desc,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'vendor_id' => Auth::guard('vendor')->id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('all.coupon')->with([
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function editCoupon($id)
    {
        $coupon = Coupon::find($id);
        return view('vendor.backend.coupon.edit_coupon',compact('coupon'));
    }

    public function updateCoupon(Request $request)
    {
        $cop_id = $request->id;
        Coupon::find($cop_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_desc' => $request->coupon_desc,
            'discount' => $request->discount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('all.coupon')->with([
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        ]);

    }

    public function deleteCoupon($id)
    {
        Coupon::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
