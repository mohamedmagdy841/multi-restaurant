<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Review;
use App\Models\Vendor;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function restaurantDetails($id)
    {
        $vendor = Vendor::find($id);
        $menus = Menu::where('vendor_id',$vendor->id)->get()->filter(function($menu){
            return $menu->products->isNotEmpty();
        });
        $gallerys = Gallery::where('vendor_id',$id)->get();
        $reviews = Review::where('vendor_id',$vendor->id)->get();
        $totalReviews = $reviews->count();
        $ratingSum = $reviews->sum('rating');
        $averageRating = $totalReviews > 0 ? $ratingSum / $totalReviews : 0;
        $roundedAverageRating = round($averageRating, 1);

        $ratingCounts = [
            '5' => $reviews->where('rating',5)->count(),
            '4' => $reviews->where('rating',4)->count(),
            '3' => $reviews->where('rating',3)->count(),
            '2' => $reviews->where('rating',2)->count(),
            '1' => $reviews->where('rating',1)->count(),
        ];
        $ratingPercentages =  array_map(function ($count) use ($totalReviews){
            return $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
        },$ratingCounts);

        return view('frontend.details_page',compact('vendor','menus','gallerys','reviews','roundedAverageRating','totalReviews','ratingCounts','ratingPercentages'));
    }

    public function addWishList(Request $request, $id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id',Auth::id())->where('vendor_id',$id)->first();
            if (!$exists ) {
                Wishlist::insert([
                    'user_id'=> Auth::id(),
                    'vendor_id' => $id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Your Wishlist is Added Successfully']);
            }

            return response()->json(['error' => 'This product is already on your wishlist']);
        }

        return response()->json(['error' => 'You Need To Login First']);
    }

    public function allWishlist()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.dashboard.all_wishlist',compact('wishlist'));
    }

    public function removeWishlist($id){
        Wishlist::find($id)->delete();

        return redirect()->back()->with([
            'message' => 'Wishlist Deleted Successfully',
            'alert-type' => 'success'
        ]);
    }
}
