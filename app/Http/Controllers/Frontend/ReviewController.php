<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        $vendor = $request->vendor_id;
        $request->validate([
            'comment' => 'required'
        ]);
        Review::insert([
            'vendor_id' => $vendor,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
            'created_at' => Carbon::now(),
        ]);

        $previousUrl = $request->headers->get('referer');
        $redirectUrl = $previousUrl ? $previousUrl . '#pills-reviews' : route('res.details', ['id' => $vendor]) . '#pills-reviews';
        return redirect()->to($redirectUrl)->with([
            'message' => 'Review will be approved by Admin',
            'alert-type' => 'success'
        ]);
    }
}
