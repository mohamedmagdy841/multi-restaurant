@extends('frontend.master')
@section('content')
    <section class="section pt-5 pb-5 products-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Popular Restaurants</h2>
                <p>Top restaurants, cafes  based on trends</p>
                <span class="line"></span>
            </div>
            <div class="row">

                @php
                    $vendors = App\Models\Vendor::latest()->where('status','1')->get();
                @endphp

                @foreach ($vendors as $vendor)

                    @php
                        $products = App\Models\Product::where('vendor_id',$vendor->id)->limit(3)->get();
                        $menuNames = $products->map(function($product){
                         return $product->menu->menu_name;
                        })->toArray();
                        $menuNamesString = implode(' . ',$menuNames);
                        $coupons = App\Models\Coupon::where('vendor_id',$vendor->id)->where('status','1')->first();
                    @endphp
                    @php
                        $reviewcount = App\Models\Review::where('vendor_id',$vendor->id)->where('status',1)->latest()->get();
                        $avarage = App\Models\Review::where('vendor_id',$vendor->id)->where('status',1)->avg('rating');
                    @endphp

                    <div class="col-md-3">
                        <div class="item pb-3">
                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                <div class="list-card-image">
                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i>{{ number_format($avarage,1) }} ({{ count($reviewcount ) }}+)</span></div>
                                    <div class="favourite-heart text-danger position-absolute"><a aria-label="Add to Wishlist" onclick="addWishList({{$vendor->id}})" ><i class="icofont-heart"></i></a></div>
                                    @if ($coupons)
                                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                    @else
                                    @endif
                                    <a href="{{ route('res.details',$vendor->id) }}">
                                        <img src="{{ asset('upload/vendor_images/' . $vendor->photo) }}" class="img-fluid item-img" style="width: 300px; height:200px;">
                                    </a>
                                </div>
                                <div class="p-3 position-relative">
                                    <div class="list-card-body">
                                        <h6 class="mb-1"><a href="{{ route('res.details',$vendor->id) }}" class="text-black">{{ $vendor->name }}</a></h6>
                                        <p class="text-gray mb-3"> {{ $menuNamesString  }}</p>
                                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 20–25 min</span>  </p>
                                    </div>
                                    <div class="list-card-badge">
                                        @if ($coupons)
                                            <span class="badge badge-success">OFFER</span> <small>{{ $coupons->discount  }}% off | Use Coupon {{ $coupons->coupon_name  }}</small>
                                        @else
                                            <span class="badge badge-success">OFFER</span> <small>No Coupons</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- // end col md-3 --}}
            </div>
        </div>
    </section>

@endsection
