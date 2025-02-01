@extends('frontEnd.layouts.master')
@section('title', $generalsetting->meta_title)
@push('seo')
    <meta name="app-url" content="" />
    <meta name="robots" content="index, follow" />
    <meta name="description" content="{{ $generalsetting->meta_description }}" />
    <meta name="keywords" content="{{ $generalsetting->meta_keyword }}" />
    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $generalsetting->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
    <meta property="og:description" content="{{ $generalsetting->meta_description }}" />
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
@endpush
@section('content')
    <section class="slider-section ">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-slider-container">
                        <div class="main_slider owl-carousel owl-theme">
                            @foreach ($sliders as $key => $value)
                                <div class="slider-item">
                                    <a href="{{ $value->link }}">
                                        <img src="{{ asset($value->image) }}" alt="" />
                                    </a>
                                </div>
                                <!-- slider item -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- col-end -->

            </div>
        </div>
    </section>
    <!-- slider end -->

    <!-- specialty starts -->
    <div class="specialty-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="specialty-carousel owl-carousel">
                        @foreach ($specialty_banners as $key => $value)
                            <div class="specialty-item {{ 'background-' . $key + 1 }}">
                                <div class="content">
                                    <a href="{{ $value->link }}">
                                        <h3>{{ $value->title }}</h3>
                                        <div class="subtitle">
                                            <span>{{ $value->subtitle }}</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="icon-wrapper">
                                    <img src="{{ asset($value->image) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- specialty end -->


    <section class="homeproduct flash-sale">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <div class="left">
                            <h3> <a href="{{ route('bestdeals') }}">Flash Sales</a></h3>
                            <p>Up to {{ $most_discounted_product->discount_percentage ?? '50' }}% discount for limited time 🔥</p>
                        </div>
                        <div class="right">
                            <a href="{{ route('bestdeals') }}" class="view_all">See All</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="product_slider owl-carousel">
                        @foreach ($hotdeal_top as $key => $value)
                            <div class="product_item wist_item">
                                @include('frontEnd.layouts.partials.product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="home-category">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-title">
                        <h3>Top Categories</h3>
                    </div>
                    <div class="category-item-wrapper">
                        @foreach ($homecategories as $key => $value)
                            <div class="cat-item">
                                <div class="cat-img">
                                    <a href="{{ route('category', $value->slug) }}">
                                        <img src="{{ asset($value->image) }}" alt="">
                                    </a>
                                </div>
                                <div class="cat-name">
                                    <a href="{{ route('category', $value->slug) }}">
                                        {{ $value->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($homecategory as $key => $homecat)
        <section class="homeproduct {{ $key % 2 == 0 ? 'odd' : 'even' }}">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h3><a href="{{ route('category', $homecat->slug) }}">{{ $homecat->name }} </a></h3>
                            <a href="{{ route('category', $homecat->slug) }}" class="view_all">See All</a>
                        </div>
                    </div>
                    @php
                        $products = App\Models\Product::where(['status' => 1, 'category_id' => $homecat->id])
                            ->orderBy('id', 'DESC')
                            ->select('id', 'name', 'slug', 'new_price', 'old_price', 'type', 'category_id')
                            ->withCount('variable')
                            ->limit(12)
                            ->get();
                    @endphp
                    <div class="col-sm-12">
                        <div class="product_slider owl-carousel">
                            @foreach ($products as $key => $value)
                                <div class="product_item wist_item">
                                    @include('frontEnd.layouts.partials.product')
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

    <div class="home-category mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-title">
                        <h3>Brands</h3>
                    </div>
                    <div class="brand-carousel owl-carousel">
                        @foreach ($brands as $key => $value)
                            <div class="brand-item">
                                <a href="{{ route('brand', $value->slug) }}">
                                    <img src="{{ asset($value->image) }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-gap"></div>
@endsection
@push('script')
    <script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // main slider
            $(".main_slider").owlCarousel({
                items: 1,
                loop: true,
                dots: true,
                autoplay: true,
                nav: true,
                autoplayHoverPause: false,
                margin: 0,
                mouseDrag: true,
                smartSpeed: 400,
                autoplayTimeout: 3000,
            });

            $(".product_slider").owlCarousel({
                margin: 15,
                items: 4,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: false,
                    },
                    600: {
                        items: 4,
                        nav: false,
                    },
                    1000: {
                        items: 4,
                        nav: false,
                    },
                    1400: {
                        items: 6,
                        nav: false,
                    },
                },
            });

            $(".brand-carousel").owlCarousel({
                items: 4,
                slideBy: 3,
                loop: false,
                margin: 15,
                nav: true,
                dots: true,
                autoplay: false,
                mouseDrag: false,
                touchDrag: false,
                smartSpeed: 100,
                navText: [
                    '<i class="fa fa-angle-left"></i>',
                    '<i class="fa fa-angle-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 2,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 4,
                    },
                },
            });

            $(".specialty-carousel").owlCarousel({
                items: 3,
                slideBy: 2,
                loop: false,
                margin: 10,
                nav: true,
                dots: true,
                autoplay: false,
                mouseDrag: false,
                touchDrag: false,
                smartSpeed: 100,
                navText: [
                    '<i class="fa fa-angle-left"></i>',
                    '<i class="fa fa-angle-right"></i>'
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 3,
                    },
                },
            });
            // Custom drag function for 2-item movement
            let owl = $(".specialty-carousel");
            owl.on("dragged.owl.carousel", function(event) {
                let direction = event.relatedTarget.drag.direction;
                if (direction === "left") {
                    owl.trigger("next.owl.carousel", [500]); // Move forward by 2 items
                } else {
                    owl.trigger("prev.owl.carousel", [500]); // Move backward by 2 items
                }
            });
        });
    </script>
@endpush
