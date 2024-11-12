<section class="pt-5 pb-5 homepage-search-block position-relative">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="row d-flex align-items-center py-lg-4">
            <div class="col-lg-8 mx-auto">
                <div class="homepage-search-title text-center">
                    <h1 class="mb-2 display-4 text-shadow text-white font-weight-normal"><span class="font-weight-bold">Discover the best food & drinks in Egypt
                     </span></h1>
                    <h5 class="mb-5 text-shadow text-white-50 font-weight-normal">Lists of top restaurants, cafes, based on trends</h5>
                </div>
                <h6 class="mt-4 text-shadow text-white font-weight-normal">E.g. Beverages, Pizzas, Burgers, Cafe...</h6>
                <div class="owl-carousel owl-carousel-category owl-theme">
                    @php
                        $products = App\Models\Product::latest()->limit(8)->get();
                    @endphp
                    @foreach ($products  as $product)
                        <div class="item">
                        <div class="osahan-category-item">
                            <a href="#">
                                <img class="img-fluid" src="{{ asset($product->image ) }}" alt="">
                                <h6>{{ Str::limit($product->name, 8)  }}</h6>
                                <p>${{ $product->price }}</p>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
