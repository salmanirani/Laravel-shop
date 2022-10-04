@extends('frontend.layout.master')
@section('content')
    <main class="main">
        <div class="intro-slider-container">
            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
                 data-owl-options='{
                        "dots": true,
                        "nav": true,
                        "rtl": true,
                            "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                @foreach($sliders as $slide)

                    <div class="intro-slide"
                         style="background-image: url(https://ishopsaz.com{{$slide->photo->path}})">
                        <div class="container intro-content text-center">
                            <h3 class="intro-subtitle text-white">{{$slide->description}}</h3>
                            <!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">{{$slide->title}}</h1><!-- End .intro-title -->

                            {{--                            <a href="category.html" class="btn btn-outline-white-4">--}}
                            {{--                                <span>مشاهده</span>--}}
                            {{--                            </a>--}}
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                @endforeach

            </div><!-- End .intro-slider owl-carousel owl-theme -->

            <span class="slider-loader"></span><!-- End .slider-loader -->
        </div><!-- End .intro-slider-container -->

        <div class="mb-5"></div><!-- End .mb-5 -->
        <div class="container">
            <div class="heading heading-center mb-3">
                <h2 class="title text-center">محصولات برتر</h2><!-- End .title -->

                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab"
                           role="tab" aria-controls="trending-all-tab" aria-selected="false">جدیدترین ها</a>
                    </li>
                    @if(count($trendingSell)!=0)
                        <li class="nav-item">
                            <a class="nav-link " id="trending-link" data-toggle="tab" href="#trending-tab"
                               role="tab" aria-controls="trending-tab" aria-selected="true">فروش ویژه</a>
                        </li>
                    @endif

                    @if(count($mostSeller)!=0)
                        <li class="nav-item">
                            <a class="nav-link" id="trending-women-link" data-toggle="tab" href="#trending-women-tab"
                               role="tab" aria-controls="trending-women-tab" aria-selected="false">پرفروش ترین ها</a>
                        </li>
                    @endif

                    {{--                    --}}
                </ul>
            </div><!-- End .heading -->

            <div class="tab-content tab-content-carousel ">
                <div class="tab-pane p-0 fade show active " id="trending-all-tab" role="tabpanel"
                     aria-labelledby="trending-all-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>

                        @if(count($latestProduct)==0)
                            محصولی  وجود ندارد
                        @endif
                        @foreach($latestProduct as $product)

                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    @if($product->price == 0 and $product->priceNull != 1)
                                        <span class="product-label label-sale">اتمام موجودی</span>
                                    @endif
                                    @if($product->trending == 1)
                                        <span class="product-label label-sale">فروش ویژه</span>
                                    @endif

                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">
                                        @if(!empty($product->photos[0]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="تصویر محصول" class="product-image">
                                        @else
                                            <img src="https://ishopsaz.com/images/email/noimage.png" alt="تصویر محصول"
                                                 class="product-image">

                                        @endif
                                        @if(!empty($product->photos[1]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                 alt="تصویر محصول"
                                                 class="product-image-hover">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(count($product->wishlists)>0)

@if(!empty($demo)) {{route('demo.frontend.removeWishlist',$product->id)}} @else {{route('frontend.removeWishlist',$product->id)}} @endif
                                        @else

@if(!empty($demo)) {{route('demo.frontend.addWishlist',$product->id)}} @else {{route('frontend.addWishlist',$product->id)}} @endif
                                        @endif
                                        @else

@if(!empty($demo)) {{route('demo.login')}} @else {{route('login')}} @endif
                                        @endif
                                                "
                                           class="btn-product-icon btn-wishlist btn-expandable "><span>
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @if(count($product->wishlists)>0)
                                                        پاک کردن از علاقه مندی ها

                                                    @else
                                                        افزودن به
                                                        لیست علاقه مندی
                                                    @endif
                                                @else
                                                    افزودن به
                                                    لیست علاقه مندی

                                                @endif
                                            </span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif"
                                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat text-center">
                                        <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">{{$product->slug}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title text-center"><a
                                            href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">{{$product->title}}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                    </div><!-- End .product-price -->
                                    @if($product->priceNull == 1)
                                        برای اطلاع از قیمت تماس بگیرید
                                    @else
                                        @if($product->discount_price)
                                            {{number_format($product->discount_price)}} تومان
                                        @else
                                            {{number_format($product->price)}} تومان

                                        @endif
                                    @endif
                                    <div class="product-nav product-nav-thumbs">
                                        <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif"
                                           class="active">
                                            @if(!empty($product->photos[0]->path))
                                                <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                     alt="تصویر محصول" class="product-image">

                                            @else
                                                <img src="https://ishopsaz.com/images/email/noimage.png"
                                                     alt="تصویر محصول" class="product-image">

                                            @endif

                                        </a>
                                        @if(!empty($product->photos[1]->path))
                                            <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                     alt="product desc">
                                            </a>
                                        @endif
                                        @if(!empty($product->photos[2]->path))
                                            <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[2]->path}}"
                                                     alt="product desc">
                                            </a>

                                        @endif
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->

                        @endforeach

                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane p-0 fade" id="trending-women-tab" role="tabpanel"
                     aria-labelledby="trending-women-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items":0
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>

                        @foreach($mostSeller as $product)

                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    @if($product->price == 0 and $product->priceNull != 1)
                                        <span class="product-label label-sale">اتمام موجودی</span>
                                    @endif
                                    @if($product->trending == 1)
                                        <span class="product-label label-sale">فروش ویژه</span>
                                    @endif
                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">
                                        @if(!empty($product->photos[0]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="تصویر محصول" class="product-image">
                                        @else
                                            <img src="https://ishopsaz.com/images/email/noimage.png" alt="تصویر محصول"
                                                 class="product-image">

                                        @endif
                                        @if(!empty($product->photos[1]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                 alt="تصویر محصول"
                                                 class="product-image-hover">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(count($product->wishlists)>0)

@if(!empty($demo)) {{route('demo.frontend.removeWishlist',$product->id)}} @else {{route('frontend.removeWishlist',$product->id)}} @endif
                                        @else

@if(!empty($demo)) {{route('demo.frontend.addWishlist',$product->id)}} @else {{route('frontend.addWishlist',$product->id)}} @endif
                                        @endif
                                        @else

@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif
                                        @endif
                                                "
                                           class="btn-product-icon btn-wishlist btn-expandable "><span>
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @if(count($product->wishlists)>0)
                                                        پاک کردن از علاقه مندی ها

                                                    @else
                                                        افزودن به
                                                        لیست علاقه مندی
                                                    @endif
                                                @else
                                                    افزودن به
                                                    لیست علاقه مندی

                                                @endif
                                            </span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat text-center">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->slug}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title text-center"><a
                                            href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->title}}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                    </div><!-- End .product-price -->
                                    @if($product->priceNull == 1)
                                        برای اطلاع از قیمت تماس بگیرید
                                    @else
                                        @if($product->discount_price)
                                            {{number_format($product->discount_price)}} تومان
                                        @else
                                            {{number_format($product->price)}} تومان

                                        @endif
                                    @endif
                                    <div class="product-nav product-nav-thumbs">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="active">
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="product desc">
                                        </a>
                                        @if(!empty($product->photos[1]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                     alt="product desc">
                                            </a>
                                        @endif
                                        @if(!empty($product->photos[2]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[2]->path}}"
                                                     alt="product desc">
                                            </a>

                                        @endif
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->

                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->

                <div class="tab-pane p-0 fade show " id="trending-tab" role="tabpanel"
                     aria-labelledby="trending-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow"
                         data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "rtl": true,
                            "responsive": {
                                    "0": {
                                        "items":0
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                        @foreach($trendingSell as $product)
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    @if($product->price == 0 and $product->priceNull != 1)
                                        <span class="product-label label-sale">اتمام موجودی</span>
                                    @endif
                                    @if($product->trending == 1)
                                        <span class="product-label label-sale">فروش ویژه</span>
                                    @endif

                                    <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                        @if(!empty($product->photos[0]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="تصویر محصول" class="product-image">
                                        @else
                                            <img src="https://ishopsaz.com/images/email/noimage.png" alt="تصویر محصول"
                                                 class="product-image">

                                        @endif
                                        @if(!empty($product->photos[1]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                 alt="تصویر محصول"
                                                 class="product-image-hover">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">

                                        <a href="
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(count($product->wishlists)>0)

@if(!empty($demo))  {{route('demo.frontend.removeWishlist',$product->id)}} @else  {{route('frontend.removeWishlist',$product->id)}} @endif
                                        @else

@if(!empty($demo))  {{route('demo.frontend.addWishlist',$product->id)}} @else  {{route('frontend.addWishlist',$product->id)}} @endif
                                        @endif
                                        @else

@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif
                                        @endif
                                                "
                                           class="btn-product-icon btn-wishlist btn-expandable "><span>
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @if(count($product->wishlists)>0)
                                                        پاک کردن از علاقه مندی ها

                                                    @else
                                                        افزودن به
                                                        لیست علاقه مندی
                                                    @endif
                                                @else
                                                    افزودن به
                                                    لیست علاقه مندی

                                                @endif
                                            </span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat text-center">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->slug}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title text-center"><a
                                            href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->title}}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                    </div><!-- End .product-price -->
                                    @if($product->priceNull == 1)
                                        برای اطلاع از قیمت تماس بگیرید
                                    @else
                                        @if($product->discount_price)
                                            {{number_format($product->discount_price)}} تومان
                                        @else
                                            {{number_format($product->price)}} تومان

                                        @endif

                                    @endif
                                    <div class="product-nav product-nav-thumbs">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="active">
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="product desc">
                                        </a>
                                        @if(!empty($product->photos[1]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                     alt="product desc">
                                            </a>
                                        @endif
                                        @if(!empty($product->photos[2]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[2]->path}}"
                                                     alt="product desc">
                                            </a>

                                        @endif
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->

                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- End .mb-5 -->

        {{--        <div class="deal bg-image pt-8 pb-8"--}}
        {{--             style="background-image: url({{asset('theme/theme2/assets/images/demos/demo-6/deal/bg-1.jpg);')}}">--}}
        {{--            <div class="container">--}}
        {{--                <div class="row justify-content-center">--}}
        {{--                    <div class="col-sm-12 col-md-8 col-lg-6">--}}
        {{--                        <div class="deal-content text-center">--}}
        {{--                            <h4>تعداد محدود. </h4>--}}
        {{--                            <h2>پیشنهاد روزانه</h2>--}}
        {{--                            <div class="deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->--}}
        {{--                        </div><!-- End .deal-content -->--}}
        {{--                        <div class="row deal-products">--}}
        {{--                            <div class="col-6 deal-product text-center">--}}
        {{--                                <figure class="product-media">--}}
        {{--                                    <a href="product.html">--}}
        {{--                                        <img src="{{asset('theme/theme2/assets/images/demos/demo-6/deal/product-1.jpg')}}"--}}
        {{--                                             alt="تصویر محصول"--}}
        {{--                                             class="product-image">--}}
        {{--                                    </a>--}}

        {{--                                </figure><!-- End .product-media -->--}}

        {{--                                <div class="product-body">--}}
        {{--                                    <h3 class="product-title text-center"><a href="product.html">شلوارک کتان</a>--}}
        {{--                                    </h3><!-- End .product-title -->--}}
        {{--                                    <div class="product-price">--}}
        {{--                                        <span class="new-price">24,000 تومان</span>--}}
        {{--                                        <span class="old-price">30,000</span>--}}
        {{--                                    </div><!-- End .product-price -->--}}
        {{--                                </div><!-- End .product-body -->--}}
        {{--                                <a href="category.html" class="action">خرید</a>--}}
        {{--                            </div>--}}
        {{--                            <div class="col-6 deal-product text-center">--}}
        {{--                                <figure class="product-media">--}}
        {{--                                    <a href="product.html">--}}
        {{--                                        <img src="{{asset('theme/theme2/assets/images/demos/demo-6/deal/product-2.jpg')}}"--}}
        {{--                                             alt="تصویر محصول"--}}
        {{--                                             class="product-image">--}}
        {{--                                    </a>--}}

        {{--                                </figure><!-- End .product-media -->--}}

        {{--                                <div class="product-body">--}}
        {{--                                    <h3 class="product-title text-center"><a href="product.html">سوییشرت</a></h3>--}}
        {{--                                    <!-- End .product-title -->--}}
        {{--                                    <div class="product-price">--}}
        {{--                                        <span class="new-price">8,000 تومان</span>--}}
        {{--                                        <span class="old-price">17,000</span>--}}
        {{--                                    </div><!-- End .product-price -->--}}
        {{--                                </div><!-- End .product-body -->--}}
        {{--                                <a href="category.html" class="action">خرید</a>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div><!-- End .col-lg-5 -->--}}
        {{--                </div><!-- End .row -->--}}
        {{--            </div><!-- End .container -->--}}
        {{--        </div><!-- End .deal -->--}}

        <div class="pt-4 pb-3" style="background-color: #222;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-truck"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">پرداخت و ارسال</h3><!-- End .icon-box-title -->
                                <p class="text-center">ارسال توسط بسته بندی حرفه ای</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-3 col-sm-6 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-rotate-left"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">مرجوع کردن سفارشات</h3><!-- End .icon-box-title -->
                                <p class="text-center">گارانتی بازگرداندن وجه به صورت کامل</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-3 col-sm-6 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-unlock"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">پرداخت امن</h3><!-- End .icon-box-title -->
                                <p class="text-center">100% پرداخت امن</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-3 col-sm-6 -->

                    <div class="col-lg-3 col-sm-6">
                        <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-headphones"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">پشتیبانی حرفه ای</h3><!-- End .icon-box-title -->
                                <p class="text-center">پشتبانی آنلاین به صورت 7روز هفته/24ساعته</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-lg-3 col-sm-6 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .bg-light pt-2 pb-2 -->

        <div class="mb-6"></div><!-- End .mb-5 -->

        <div class="container">
            <h2 class="title text-center mb-4">محصولات جدید</h2><!-- End .title text-center -->

            <div class="products">
                <div class="row justify-content-center">

                    @foreach($latestProduct as $product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    @if($product->price == 0 and $product->priceNull != 1)
                                        <span class="product-label label-sale">اتمام موجودی</span>
                                    @endif
                                    @if($product->trending == 1)
                                        <span class="product-label label-sale">فروش ویژه</span>
                                    @endif

                                    <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">

                                        @if(!empty($product->photos[0]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="تصویر محصول" class="product-image">
                                        @else
                                            <img src="https://ishopsaz.com/images/email/noimage.png" alt="تصویر محصول"
                                                 class="product-image">

                                        @endif

                                        @if(!empty($product->photos[1]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                 alt="تصویر محصول"
                                                 class="product-image-hover">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        @if(count($product->wishlists)>0)

@if(!empty($demo))  {{route('demo.frontend.removeWishlist',$product->id)}} @else  {{route('frontend.removeWishlist',$product->id)}} @endif
                                        @else

@if(!empty($demo))  {{route('demo.frontend.addWishlist',$product->id)}} @else  {{route('frontend.addWishlist',$product->id)}} @endif
                                        @endif
                                        @else

@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif
                                        @endif
                                                "
                                           class="btn-product-icon btn-wishlist btn-expandable "><span>
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    @if(count($product->wishlists)>0)
                                                        پاک کردن از علاقه مندی ها

                                                    @else
                                                        افزودن به
                                                        لیست علاقه مندی
                                                    @endif
                                                @else
                                                    افزودن به
                                                    لیست علاقه مندی

                                                @endif
                                            </span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat text-center">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->slug}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title text-center"><a
                                            href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">{{$product->title}}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                    </div><!-- End .product-price -->
                                    @if($product->priceNull == 1)
                                        برای اطلاع از قیمت تماس بگیرید
                                    @else
                                        @if($product->discount_price)
                                            {{number_format($product->discount_price)}} تومان
                                        @else
                                            {{number_format($product->price)}} تومان

                                        @endif
                                    @endif
                                    <div class="product-nav product-nav-thumbs">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif"
                                           class="active">
                                            @if(!empty($product->photos[0]->path))
                                                <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                     alt="تصویر محصول" class="product-image">
                                            @else
                                                <img src="https://ishopsaz.com/images/email/noimage.png"
                                                     alt="تصویر محصول" class="product-image">

                                            @endif
                                        </a>
                                        @if(!empty($product->photos[1]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[1]->path}}"
                                                     alt="product desc">
                                            </a>
                                        @endif
                                        @if(!empty($product->photos[2]->path))
                                            <a href="@if(!empty($demo))  {{route('demo.product.single',$product->slug)}} @else  {{route('product.single',$product->slug)}} @endif">
                                                <img src="https://ishopsaz.com{{$product->photos[2]->path}}"
                                                     alt="product desc">
                                            </a>

                                        @endif
                                    </div><!-- End .product-nav -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->


                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    @endforeach


                </div><!-- End .row -->
            </div><!-- End .products -->

            <div class="more-container text-center mt-2">
                <a href="@if(!empty($demo))  {{route('demo.frontend.allproduct')}} @else  {{route('frontend.allproduct')}} @endif"
                   class="btn btn-outline-dark-2 btn-more"><span>نمایش بیشتر</span></a>
            </div><!-- End .more-container -->
        </div><!-- End .container -->

        {{--        <div class="pb-3">--}}
        {{--            <div class="container brands pt-5 pt-lg-7 ">--}}

        {{--                <h2 class="title text-center mb-4">برندهای معروف</h2><!-- End .title text-center -->--}}

        {{--                <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{--}}
        {{--                            "nav": false,--}}
        {{--                            "dots": false,--}}
        {{--                            "margin": 30,--}}
        {{--                            "loop": false,--}}
        {{--                            "rtl": true,--}}
        {{--                            "responsive": {--}}
        {{--                                "0": {--}}
        {{--                                    "items":2--}}
        {{--                                },--}}
        {{--                                "420": {--}}
        {{--                                    "items":3--}}
        {{--                                },--}}
        {{--                                "600": {--}}
        {{--                                    "items":4--}}
        {{--                                },--}}
        {{--                                "900": {--}}
        {{--                                    "items":5--}}
        {{--                                },--}}
        {{--                                "1024": {--}}
        {{--                                    "items":6--}}
        {{--                                }--}}
        {{--                            }--}}
        {{--                        }'>--}}
        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/1.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/2.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/3.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/4.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/5.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/6.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}

        {{--                    <a href="#" class="brand">--}}
        {{--                        <img src="{{asset('theme/theme2/assets/images/brands/7.png')}}" alt="نام برند">--}}
        {{--                    </a>--}}
        {{--                </div><!-- End .owl-carousel -->--}}
        {{--            </div><!-- End .container -->--}}

        {{--            <div class="mb-5 mb-lg-7"></div><!-- End .mb-5 -->--}}

        {{--            <div class="container newsletter">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-lg-6 banner-overlay-div">--}}
        {{--                        <div class="banner banner-overlay">--}}
        {{--                            <a href="#">--}}
        {{--                                <img src="{{asset('theme/theme2/assets/images/demos/demo-6/banners/banner-3.jpg')}}"--}}
        {{--                                     alt="بنر">--}}
        {{--                            </a>--}}

        {{--                            <div class="banner-content banner-content-center">--}}
        {{--                                <h4 class="banner-subtitle text-white"><a href="#">مدت زمان محدود</a></h4>--}}
        {{--                                <!-- End .banner-subtitle -->--}}
        {{--                                <h3 class="banner-title text-white"><a href="#">تا پایان فصل<br>50% تخفیف</a>--}}
        {{--                                </h3><!-- End .banner-title -->--}}
        {{--                                <a href="#" class="btn btn-outline-white banner-link underline">خرید</a>--}}
        {{--                            </div><!-- End .banner-content -->--}}
        {{--                        </div><!-- End .banner -->--}}
        {{--                    </div><!-- End .col-lg-6 -->--}}

        {{--                    <div class="col-lg-6 d-flex align-items-stretch subscribe-div">--}}
        {{--                        <div class="cta cta-box">--}}
        {{--                            <div class="cta-content">--}}
        {{--                                <h3 class="cta-title">عضویت در خبرنامه ما</h3><!-- End .cta-title -->--}}
        {{--                                <p class="text-center">همین حالا ثبت نام کنیدو <span class="primary-color">10%--}}
        {{--                                            تخفیف</span> برای اولین--}}
        {{--                                    سفارش خود دریافت کنید--}}
        {{--                                </p>--}}

        {{--                                <form action="#">--}}
        {{--                                    <input type="email" class="form-control"--}}
        {{--                                           placeholder="آدرس ایمیل خود را وارد کنید" aria-label="Email Adress"--}}
        {{--                                           required>--}}
        {{--                                    <div class="text-center">--}}
        {{--                                        <button class="btn btn-outline-dark-2"--}}
        {{--                                                type="submit"><span>عضویت</span></i></button>--}}
        {{--                                    </div><!-- End .text-center -->--}}
        {{--                                </form>--}}
        {{--                            </div><!-- End .cta-content -->--}}
        {{--                        </div><!-- End .cta -->--}}
        {{--                    </div><!-- End .col-lg-6 -->--}}
        {{--                </div><!-- End .row -->--}}
        {{--            </div><!-- End .container -->--}}
        {{--        </div><!-- End .bg-gray -->--}}

        <div class="mb-2"></div><!-- End .mb-5 -->

        <div class="container">
        </div><!-- End .container -->

        <div class="blog-posts mb-5">
            <div class="container">
                <h2 class="title text-center mb-4">آخرین مطالب وبلاگ</h2><!-- End .title text-center -->

                <div class="owl-carousel owl-simple mb-3" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>


                    @foreach($posts as $post)
                        @if(!empty($post->title))
                            <article class="entry">
                                <figure class="entry-media">
                                    <a href="@if(!empty($demo))  {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif">
                                        <img src="https://ishopsaz.com{{$post->photo->path}}"
                                             alt="{{$post->title}}">
                                    </a>
                                </figure><!-- End .entry-media -->

                                <div class="entry-body text-center">
                                    <div class="entry-meta">
                                        {{--                                <a href="#">22 فروردین 1401</a>, 1 دیدگاه--}}
                                    </div><!-- End .entry-meta -->

                                    <h3 class="entry-title text-center">
                                        <a href="@if(!empty($demo))  {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif">{{$post->title}}</a>
                                    </h3><!-- End .entry-title -->

                                    <div class="entry-content">
                                        <a href="@if(!empty($demo))  {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif"
                                           class="read-more">خواندن
                                            بیشتر</a>
                                    </div><!-- End .entry-content -->
                                </div><!-- End .entry-body -->
                            </article><!-- End .entry -->
                        @endif
                    @endforeach


                </div><!-- End .owl-carousel -->
            </div><!-- End .container -->
        </div><!-- End .blog-posts -->
    </main><!-- End .main -->

@endsection
