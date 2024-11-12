<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ManageOrderController extends Controller
{
    public function pendingOrder()
    {
        $allData = Order::where('status','Pending')->orderBy('id','desc')->get();
        return view('admin.backend.order.pending_order',compact('allData'));
    }

    public function confirmOrder()
    {
        $allData = Order::where('status','confirm')->orderBy('id','desc')->get();
        return view('admin.backend.order.confirm_order',compact('allData'));
    }

    public function processingOrder()
    {
        $allData = Order::where('status','processing')->orderBy('id','desc')->get();
        return view('admin.backend.order.processing_order',compact('allData'));
    }
    //End Method
    public function deliveredOrder()
    {
        $allData = Order::where('status','delivered')->orderBy('id','desc')->get();
        return view('admin.backend.order.delivered_order',compact('allData'));
    }

    public function adminOrderDetails($id){
        $order = Order::with('user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }
        return view('admin.backend.order.admin_order_details',compact('order','orderItem','totalPrice'));
    }

    public function pendingToConfirm($id)
    {
        Order::find($id)->update(['status' => 'confirm']);

        return redirect()->route('confirm.order')->with([
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function confirmToProcessing($id)
    {
        Order::find($id)->update(['status' => 'processing']);

        return redirect()->route('processing.order')->with([
            'message' => 'Order Processed Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function processingToDelivered($id)
    {
        Order::find($id)->update(['status' => 'delivered']);

        return redirect()->route('delivered.order')->with([
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        ]);
    }

    //--------------Vendor
    public function allVendorOrders()
    {
        $vendorId = Auth::guard('vendor')->id();
        $orderItemGroupData = OrderItem::with(['product','order'])->where('vendor_id',$vendorId)
            ->orderBy('order_id','desc')
            ->get()
            ->groupBy('order_id');
        return view('vendor.backend.order.all_orders',compact('orderItemGroupData'));
    }

    public function vendorOrderDetails($id)
    {
        $cid = Auth::guard('vendor')->id();
        $order = Order::with('user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')
            ->where('order_id',$id)
            ->where('vendor_id',$cid)
            ->orderBy('id','desc')
            ->get();
        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }
        return view('vendor.backend.order.vendor_order_details',compact('order','orderItem','totalPrice'));
    }

    //---------------------User
    public function userOrderList()
    {
        $userId = Auth::user()->id;
        $allUserOrder = Order::where('user_id',$userId)->orderBy('id','desc')->get();
        return view('frontend.dashboard.order.order_list',compact('allUserOrder'));
    }

    public function userOrderDetails($id)
    {
        $order = Order::with('user')->where('id',$id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }
        return view('frontend.dashboard.order.order_details',compact('order','orderItem','totalPrice'));
    }

    public function userInvoiceDownload($id)
    {
        $order = Order::with('user')->where('id',$id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }
        $pdf = Pdf::loadView('frontend.dashboard.order.invoice_download',compact('order','orderItem','totalPrice'))
            ->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }
}
