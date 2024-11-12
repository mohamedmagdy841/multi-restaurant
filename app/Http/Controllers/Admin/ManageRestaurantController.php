<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ManageRestaurantController extends Controller
{
    public function pendingRestaurant()
    {
        $vendor = Vendor::where('status',0)->get();
        return view('admin.backend.restaurant.pending_restaurant',compact('vendor'));
    }

    public function vendorChangeStatus(Request $request)
    {
        $vendor = Vendor::find($request->vendor_id);
        $vendor->status = $request->status;
        $vendor->save();
        return response()->json(['success' => 'Status Change Successfully']);
    }

    public function approveRestaurant()
    {
        $vendor = Vendor::where('status',1)->get();
        return view('admin.backend.restaurant.approve_restaurant',compact('vendor'));
    }
}
