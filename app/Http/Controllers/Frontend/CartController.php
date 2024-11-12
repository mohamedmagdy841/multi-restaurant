<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /*
     * This method handles adding items to a session-based cart by incrementing quantities for existing items
     * or creating new entries for new items. It also clears any applied coupon when items are added,
     * updating the cart structure and redirecting the user with a success notification.
    */
    public function addToCart($id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $products = Product::find($id);
        $cart = session()->get('cart',[]);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $priceToShow = isset($products->discount_price) ? $products->discount_price : $products->price;
            $cart[$id] = [
                'id' => $id,
                'name' => $products->name,
                'image' => $products->image,
                'price' => $priceToShow,
                'vendor_id' => $products->vendor_id,
                'quantity' => 1
            ];
        }
        session()->put('cart',$cart);

        return redirect()->back()->with([
            'message' => 'Added to Cart Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function updateCartQuantity(Request $request)
    {
        $cart = session()->get('cart',[]);
        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart',$cart);
        }

        return response()->json([
            'message' => 'Quantity Updated',
            'alert-type' => 'success'
        ]);
    }

    public function cartRemove(Request $request)
    {
        $cart = session()->get('cart',[]);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart',$cart);
        }

        return response()->json([
            'message' => 'Product Removed Successfully',
            'alert-type' => 'success'
        ]);
    }

    /*
     * This method validates a coupon by checking its existence, expiration date,
     * and whether it matches the vendor of the items in the cart. If all conditions are satisfied,
     * the coupon is applied by calculating the discount and storing it in the session, returning a success response.
     */
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('validity','>=',Carbon::now()->format('Y-m-d'))->first();
        $cart = session()->get('cart',[]);
        $totalAmount = 0;
        $vendorIds = [];
        foreach($cart as $car){
            $totalAmount += ($car['price'] * $car['quantity']);
            $pd = Product::find($car['id']);
            $cdid = $pd->vendor_id;
            $vendorIds[] = $cdid;
        }
        if ($coupon) {
            if (count(array_unique($vendorIds)) === 1) {
                $cvendorId = $coupon->vendor_id;
                if ($cvendorId == $vendorIds[0]) {
                    Session::put('coupon',[
                        'coupon_name' => $coupon->coupon_name,
                        'discount' => $coupon->discount,
                        'discount_amount' => $totalAmount - ($totalAmount * $coupon->discount/100),
                    ]);
                    $couponData = Session()->get('coupon');
                    return response()->json(array(
                        'validity' => true,
                        'success' => 'Coupon Applied Successfully',
                        'couponData' => $couponData,
                    ));
                }

                return response()->json(['error' => 'This coupon is not valid for this restaurant']);
            }

            return response()->json(['error' => 'You cannot use the coupon for different restaurants']);
        }

        return response()->json(['error' => 'Invalid Coupon']);
    }

    public function couponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function shopCheckout()
    {
        if (Auth::check()) {
            $cart = session()->get('cart',[]);
            $totalAmount = 0;
            foreach ($cart as $car) {
                $totalAmount += $car['price'];
            }
            if ($totalAmount > 0) {
                return view('frontend.checkout.view_checkout', compact('cart'));
            }

            return redirect()->to('/')->with([
                'message' => 'Shopping at least one item',
                'alert-type' => 'error'
            ]);

        }

        return redirect()->route('login')->with([
            'message' => 'Please Login First',
            'alert-type' => 'success'
        ]);
    }
}
