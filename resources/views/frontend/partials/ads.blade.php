@php
    $banner = App\Models\Banner::latest()->limit(4)->get();
@endphp
<section class="section pt-5 pb-5 bg-white homepage-add-section">
    <div class="container">
        <div class="row">
            @foreach ($banner  as $item)
                <div class="col-md-3 col-6">
                <div class="products-box">
                    <img alt="" src="{{ asset($item->image) }}" class="img-fluid rounded">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
