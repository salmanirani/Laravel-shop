@extends('frontend.layout.master')


@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">تمام محصولات<span>دسته بندی</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.home')}} @else {{route('home')}}  @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="#">فروشگاه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تمام محصولات</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-info">
                                    نمایش <span>{{$products->firstItem()}} تا {{$products->lastItem()}}</span> محصول
                                </div><!-- End .toolbox-info -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-right">
                                <div class="toolbox-sort">
                                    <label for="sortby">مرتب سازی براساس : </label>
                                    <div class="select-custom">
                                        <select name="sortby" id="sortby" class="form-control">
                                            <option value="popularity" selected="selected">بیشترین خرید</option>
                                            {{--                                            <option value="rating">بیشترین امتیاز</option>--}}
                                            {{--                                            <option value="date">تاریخ</option>--}}
                                        </select>
                                    </div>
                                </div><!-- End .toolbox-sort -->
                                <div class="toolbox-layout">
                                    {{--                                    <a href="category-list.html" class="btn-layout">--}}
                                    {{--                                        <svg width="16" height="10">--}}
                                    {{--                                            <rect x="0" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="0" width="10" height="4" />--}}
                                    {{--                                            <rect x="0" y="6" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="6" width="10" height="4" />--}}
                                    {{--                                        </svg>--}}
                                    {{--                                    </a>--}}

                                    {{--                                    <a href="category-2cols.html" class="btn-layout">--}}
                                    {{--                                        <svg width="10" height="10">--}}
                                    {{--                                            <rect x="0" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="0" y="6" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="6" width="4" height="4" />--}}
                                    {{--                                        </svg>--}}
                                    {{--                                    </a>--}}

                                    {{--                                    <a href="category.html" class="btn-layout">--}}
                                    {{--                                        <svg width="16" height="10">--}}
                                    {{--                                            <rect x="0" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="12" y="0" width="4" height="4" />--}}
                                    {{--                                            <rect x="0" y="6" width="4" height="4" />--}}
                                    {{--                                            <rect x="6" y="6" width="4" height="4" />--}}
                                    {{--                                            <rect x="12" y="6" width="4" height="4" />--}}
                                    {{--                                        </svg>--}}
                                    {{--                                    </a>--}}

                                    <a href="#" class="btn-layout active">
                                        <svg width="22" height="10">
                                            <rect x="0" y="0" width="4" height="4"/>
                                            <rect x="6" y="0" width="4" height="4"/>
                                            <rect x="12" y="0" width="4" height="4"/>
                                            <rect x="18" y="0" width="4" height="4"/>
                                            <rect x="0" y="6" width="4" height="4"/>
                                            <rect x="6" y="6" width="4" height="4"/>
                                            <rect x="12" y="6" width="4" height="4"/>
                                            <rect x="18" y="6" width="4" height="4"/>
                                        </svg>
                                    </a>
                                </div><!-- End .toolbox-layout -->
                            </div><!-- End .toolbox-right -->
                        </div><!-- End .toolbox -->

                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                @if(count($products)==0)
                                    محصولی در این دسته بندی وجود ندارد
                                @endif
                                @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                {{--                                                <span class="product-label label-new">جدید</span>--}}
                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">
                                                    @if(!empty($product->photos[0]->path))
                                                        <img src="https://ishopsaz.com{{$product->photos[0]->path}}" alt="تصویر محصول" class="product-image">
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
                                                    {{--                                                    <a href="popup/quickView.html"--}}
                                                    {{--                                                       class="btn-product-icon btn-quickview"--}}
                                                    {{--                                                       title="مشاهده سریع محصول"><span>مشاهده سریع</span></a>--}}
                                                    {{--                                                    <a href="#" class="btn-product-icon btn-compare"--}}
                                                    {{--                                                       title="مقایسه"><span>مقایسه</span></a>--}}
                                                </div><!-- End .product-action-vertical -->

                                                <div class="product-action">
                                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif" class="btn-product btn-cart"><span>مشاهده محصول</span></a>
                                                </div><!-- End .product-action -->
                                            </figure><!-- End .product-media -->

                                            <div class="product-body">
                                                <div class="product-cat text-center">
                                                    <a href="#">زنانه</a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title text-center"><a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">{{$product->title}}</a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    @if($product->discount_price)
                                                        <div> <del style="color:red">
                                                                <b>{{number_format($product->price)}} تومان</b>
                                                            </del></div>
                                                        {{number_format($product->discount_price)}} تومان
                                                    @else
                                                        {{number_format($product->price)}} تومان

                                                    @endif
                                                </div><!-- End .product-price -->
                                                {{--                                                <div class="ratings-container">--}}
                                                {{--                                                    <div class="ratings">--}}
                                                {{--                                                        <div class="ratings-val" style="width: 20%;"></div>--}}
                                                {{--                                                        <!-- End .ratings-val -->--}}
                                                {{--                                                    </div><!-- End .ratings -->--}}
                                                {{--                                                    <span class="ratings-text">( 2 بازدید )</span>--}}
                                                {{--                                                </div><!-- End .rating-container -->--}}


                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->

                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        {{$products->links('pagination::bootstrap-4')}}
                                    </div>
                                </div>
                            </div><!-- End .row -->
                        </div><!-- End .products -->


                        {{--                        <nav aria-label="Page navigation">--}}
                        {{--                            <ul class="pagination justify-content-center">--}}
                        {{--                                <li class="page-item disabled">--}}
                        {{--                                    <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"--}}
                        {{--                                       aria-disabled="true">--}}
                        {{--                                        <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>قبلی--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a>--}}
                        {{--                                </li>--}}
                        {{--                                <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                        {{--                                <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                        {{--                                <li class="page-item-total">از 6</li>--}}
                        {{--                                <li class="page-item">--}}
                        {{--                                    <a class="page-link page-link-next" href="#" aria-label="Next">--}}
                        {{--                                        بعدی <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}
                        {{--                            </ul>--}}
                        {{--                        </nav>--}}
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>فیلترها : </label>
                                {{--                                <a href="#" class="sidebar-filter-clear">پاک کردن همه</a>--}}
                            </div><!-- End .widget widget-clean -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                       aria-controls="widget-1">
                                        دسته بندی
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach($mtcategories as $category)
                                                <div class="filter-item">
                                                    <div class="custom-control ">
                                                        {{--                                                        <input type="checkbox" class="custom-control-input" id="cat-1">--}}
                                                        <label class="custom-control-label" for="cat-1"><a
                                                                    href="@if(!empty($demo)) {{route('demo.category.index',$category['id'])}} @else {{route('category.index',$category['id'])}} @endif">
                                                                {{$category['name']}}
                                                            </a></label>
                                                    </div><!-- End .custom-checkbox -->
                                                    {{--                                                    <span class="item-count">3</span>--}}
                                                </div><!-- End .filter-item -->
                                            @endforeach



                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            {{--                            <div class="widget widget-collapsible">--}}
                            {{--                                <h3 class="widget-title">--}}
                            {{--                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"--}}
                            {{--                                       aria-controls="widget-2">--}}
                            {{--                                        سایز--}}
                            {{--                                    </a>--}}
                            {{--                                </h3><!-- End .widget-title -->--}}

                            {{--                                <div class="collapse show" id="widget-2">--}}
                            {{--                                    <div class="widget-body">--}}
                            {{--                                        <div class="filter-items">--}}
                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" id="size-1">--}}
                            {{--                                                    <label class="custom-control-label" for="size-1">XS</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" id="size-2">--}}
                            {{--                                                    <label class="custom-control-label" for="size-2">S</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" checked--}}
                            {{--                                                           id="size-3">--}}
                            {{--                                                    <label class="custom-control-label" for="size-3">M</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" checked--}}
                            {{--                                                           id="size-4">--}}
                            {{--                                                    <label class="custom-control-label" for="size-4">L</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" id="size-5">--}}
                            {{--                                                    <label class="custom-control-label" for="size-5">XL</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input" id="size-6">--}}
                            {{--                                                    <label class="custom-control-label" for="size-6">XXL</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}
                            {{--                                        </div><!-- End .filter-items -->--}}
                            {{--                                    </div><!-- End .widget-body -->--}}
                            {{--                                </div><!-- End .collapse -->--}}
                            {{--                            </div><!-- End .widget -->--}}

                            {{--                            <div class="widget widget-collapsible">--}}
                            {{--                                <h3 class="widget-title">--}}
                            {{--                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"--}}
                            {{--                                       aria-controls="widget-3">--}}
                            {{--                                        رنگ--}}
                            {{--                                    </a>--}}
                            {{--                                </h3><!-- End .widget-title -->--}}

                            {{--                                <div class="collapse show" id="widget-3">--}}
                            {{--                                    <div class="widget-body">--}}
                            {{--                                        <div class="filter-colors">--}}
                            {{--                                            <a href="#" style="background: #b87145;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #f0c04a;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #333333;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" class="selected" style="background: #cc3333;"><span--}}
                            {{--                                                        class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #3399cc;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #669933;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #f2719c;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                            <a href="#" style="background: #ebebeb;"><span class="sr-only">نام رنگ</span></a>--}}
                            {{--                                        </div><!-- End .filter-colors -->--}}
                            {{--                                    </div><!-- End .widget-body -->--}}
                            {{--                                </div><!-- End .collapse -->--}}
                            {{--                            </div><!-- End .widget -->--}}

                            {{--                            <div class="widget widget-collapsible">--}}
                            {{--                                <h3 class="widget-title">--}}
                            {{--                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"--}}
                            {{--                                       aria-controls="widget-4">--}}
                            {{--                                        برند--}}
                            {{--                                    </a>--}}
                            {{--                                </h3><!-- End .widget-title -->--}}

                            {{--                                <div class="collapse show" id="widget-4">--}}
                            {{--                                    <div class="widget-body">--}}
                            {{--                                        <div class="filter-items">--}}
                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-1">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-1">نکست</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-2">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-2">ریور ایسلند</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-3">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-3">جیوکس</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-4">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-4">نیو بالانس</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-5">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-5">یو جی جی</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-6">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-6">اف اند اف</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                            <div class="filter-item">--}}
                            {{--                                                <div class="custom-control custom-checkbox">--}}
                            {{--                                                    <input type="checkbox" class="custom-control-input"--}}
                            {{--                                                           id="brand-7">--}}
                            {{--                                                    <label class="custom-control-label" for="brand-7">نایکی</label>--}}
                            {{--                                                </div><!-- End .custom-checkbox -->--}}
                            {{--                                            </div><!-- End .filter-item -->--}}

                            {{--                                        </div><!-- End .filter-items -->--}}
                            {{--                                    </div><!-- End .widget-body -->--}}
                            {{--                                </div><!-- End .collapse -->--}}
                            {{--                            </div><!-- End .widget -->--}}

                            {{--                            <div class="widget widget-collapsible">--}}
                            {{--                                <h3 class="widget-title">--}}
                            {{--                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"--}}
                            {{--                                       aria-controls="widget-5">--}}
                            {{--                                        قیمت--}}
                            {{--                                    </a>--}}
                            {{--                                </h3><!-- End .widget-title -->--}}

                            {{--                                <div class="collapse show" id="widget-5">--}}
                            {{--                                    <div class="widget-body">--}}
                            {{--                                        <div class="filter-price">--}}
                            {{--                                            <div class="filter-price-text">--}}
                            {{--                                                محدوده قیمت :--}}
                            {{--                                                <span id="filter-price-range"></span>--}}
                            {{--                                            </div><!-- End .filter-price-text -->--}}

                            {{--                                            <div id="price-slider"></div><!-- End #price-slider -->--}}
                            {{--                                        </div><!-- End .filter-price -->--}}
                            {{--                                    </div><!-- End .widget-body -->--}}
                            {{--                                </div><!-- End .collapse -->--}}
                            {{--                            </div><!-- End .widget -->--}}
                        </div><!-- End .sidebar sidebar-shop -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->



@endsection
