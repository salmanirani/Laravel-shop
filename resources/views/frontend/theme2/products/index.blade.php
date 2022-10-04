@extends('frontend.layout.master')
@section('content')
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/plugins/nouislider/nouislider.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif">خانه</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">محصولات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$product->title}}</li>
                </ol>

                {{--                <nav class="product-pager mr-auto" aria-label="Product">--}}
                {{--                    <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">--}}
                {{--                        <i class="icon-angle-right"></i>--}}
                {{--                        <span>قبلی</span>--}}
                {{--                    </a>--}}

                {{--                    <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">--}}
                {{--                        <span>بعدی</span>--}}
                {{--                        <i class="icon-angle-left"></i>--}}
                {{--                    </a>--}}
                {{--                </nav><!-- End .pager-nav -->--}}
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    @if(!empty($product->photos[0]->path))

                                        <figure class="product-main-image">
                                            <img id="product-zoom"
                                                 src="https://www.ishopsaz.com{{$product->photos[0]->path}}"
                                                 data-zoom-image="https://www.ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="{{$product->title}}">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->
                                    @endif
                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @php
                                            $active = 'active';
                                        @endphp
                                        @foreach($product->photos as $photo)

                                            <a class="product-gallery-item {{$active}}" href="#"
                                               data-image="https://www.ishopsaz.com{{$photo->path}}"
                                               data-zoom-image="https://www.ishopsaz.com{{$photo->path}}">
                                                <img src="https://www.ishopsaz.com{{$photo->path}}"
                                                     alt="{{$product->title}}">
                                            </a>
                                            @php
                                                $active = '';
                                            @endphp
                                        @endforeach


                                    </div><!-- End .product-image-gallery -->
                                </div><!-- End .row -->
                            </div><!-- End .product-gallery -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{$product->title}}</h1>
                                <!-- End .product-title -->

                                {{--                                <div class="ratings-container">--}}
                                {{--                                    <div class="ratings">--}}
                                {{--                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->--}}
                                {{--                                    </div><!-- End .ratings -->--}}
                                {{--                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 نظر--}}
                                {{--                                        )</a>--}}
                                {{--                                </div><!-- End .rating-container -->--}}
                                <div class="product-price">
                                    @if($product->priceNull == 1)
                                        برای اطلاع از قیمت تماس بگیرید
                                    @else
                                        @if($product->price != 0 )
                                            @if($product->discount_price)
                                                <ins>

                                                    <b class="number-font price margin_bottom_40">{{number_format($product->discount_price)}}
                                                        تومان </b></ins>
                                                <del style="color:red">
                                                    <span class="number-font price margin_bottom_40">{{number_format($product->price)}} تومان</span>
                                                </del>

                                            @else
                                                <ins>{{number_format($product->price)}} تومان</ins>
                                            @endif
                                        @endif
                                    @endif
                                </div>

                                <!-- End .product-price -->

                                <div class="product-content">
                                    <p>{!! $product->short_description !!}
                                    </p>
                                </div><!-- End .product-content -->

                                <div class="details-filter-row details-row-size">


                                    @php
                                        $inventory = 0;
                                    @endphp
                                    @if(count($product['sizecolors'])>0 and $product->price!= 0)
                                        {{--  سایز و رنگ های موجود--}}
                                        <div class="product-content">
                                            <label>رنگ و سایز </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <select class="form-control" onchange="sizeChoose(this.value);">
                                                    <option value="">انتخاب کنید</option>
                                                    @foreach($product->sizecolors as $sizecolor)
                                                        @if($sizecolor->inventory>0)
                                                            <option value="{{$sizecolor->id}}"
                                                                    style="background-color: {{$sizecolor->colors}};border-style: solid;border-color: black;border-width: 1px">
                                                                سایز {{$sizecolor->size}}
                                                                رنگ {{$sizecolor->colorname}}  </option>
                                                            @php
                                                                $inventory = $inventory + $sizecolor->inventory;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" id="choosecolor"></div>

                                        </div>
                                    @endif
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size">

                                    @if(!empty($sizeTable))

                                        <a href="#" class="size-guide" data-toggle="modal" data-target="#myModal"><i
                                                class="icon-th-list"></i>راهنمای اندازه</a>

                                    @endif
                                </div><!-- End .details-filter-row -->


                                <div class="product-details-action">
                                    @if($inventory>0 and $product->price!= 0)
                                        <span id="addToCartBtn">
                                             <btn id="successtoast"
                                                  class="btn-product btn-cart">افزودن به سبد</btn>

                                         </span>

                                    @else
                                        @if($product->priceNull != 1)

                                            <button class="btn btn-sm btn-danger"> اتمام موجودی</button>

                                        @endif
                                    @endif

                                    @if($product->inventory>0)
                                        <a href="@if(!empty($demo))  {{route('demo.cart.add',['id'=>$product->id ,'size'=>'1'])}} @else  {{route('cart.add',['id'=>$product->id ,'size'=>'1'])}} @endif"
                                           class="btn-product btn-cart">افزودن به سبد</a>
                                    @endif

                                    <div class="details-action-wrapper">
                                        <a href="#" class="btn-product btn-wishlist"
                                           title="لیست علاقه مندی"><span>افزودن
                                                    به
                                                    علاقه مندی</span></a>
                                        <a href="#" class="btn-product btn-compare" title="مقایسه"><span>افزودن به
                                                    لیست مقایسه</span></a>
                                    </div><!-- End .details-action-wrapper -->
                                </div><!-- End .product-details-action -->

                                <div class="product-details-footer">
                                    <div class="product-cat text-center">
                                        <span>دسته بندی : </span>
                                        @foreach($product->mtcategories as $categories)
                                            <a href="@if(!empty($demo))  {{route('demo.category.index',$categories->slug)}} @else  {{route('category.index',$categories->slug)}} @endif"
                                               class="delay03 margin_right_10">{{$categories->name}}</a>

                                        @endforeach
                                    </div><!-- End .product-cat -->

                                    <div class="social-icons social-icons-sm">
                                        <span class="social-label">اشتراک گذاری : </span>
                                        <a href="#" class="social-icon" title="فیسبوک" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="#" class="social-icon" title="توییتر" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="#" class="social-icon" title="اینستاگرام" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                        <a href="#" class="social-icon" title="پینترست" target="_blank"><i
                                                class="icon-pinterest"></i></a>
                                    </div>
                                </div><!-- End .product-details-footer -->
                            </div><!-- End .product-details -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->
                </div><!-- End .product-details-top -->

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab"
                               href="#product-desc-tab" role="tab" aria-controls="product-desc-tab"
                               aria-selected="true">توضیحات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                               role="tab" aria-controls="product-info-tab" aria-selected="false">ویژگی های محصول</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab"
                               href="#product-review-tab" role="tab" aria-controls="product-review-tab"
                               aria-selected="false">نظرات </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                             aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>اطلاعات محصول</h3>
                                <p>{!! $product->short_description !!} </p>
                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel"
                             aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>اطلاعات</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="space_left_20 des-font des-tab">
                                            @foreach($detailSelect as $attribute)
                                                <li>{{$attribute['attributegroup']['title']}}
                                                    : {{$attribute['title']}}    </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <ul class="space_left_20 des-font des-tab">
                                            @foreach($detailText as $attribute)
                                                <li>{{$attribute['att'][0]['title']}} : {{$attribute['value']}}    </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div><!-- End .product-desc-content -->
                        </div><!-- .End .tab-pane -->

                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                             aria-labelledby="product-review-link">
                            <div class="reviews">
                                <div class="review">
                                    <p class="des-font content-review">
                                        @include('partials.theme2.mtcomments',['comments'=>$product->mtcomments,'product'=>$product])
                                    </p>
                                </div>
                                <div class="form-review ">
                                    @if(count($errors)>0)
                                        @include('partials.form-error')

                                    @endif
                                    @if(Session::has('comments_status'))
                                        <div class="alert alert-success">
                                            <p>{{session('comments_status')}}</p>
                                        </div>

                                    @endif
                                    @if(Auth::check())
                                        <h3 class="menu-font title-form">ثبت دیدگاه برای {{$product->title}}</h3>

                                        <p class="des-font des-review margin_bottom_50">آدرس ایمیل شما منتشر نخواهد
                                            شد.</p>

                                        {{--                                    {!! Form::open((['method'=>'GET','route'=>['frontend.mtcomments.store',$product->id],'class'=>'comments__form'])) !!}--}}
                                        <form
                                            action="@if(!empty($demo))  {{route('demo.frontend.mtcomments.store',$product->id)}} @else  {{route('frontend.mtcomments.store',$product->id)}} @endif">
                                            <div class="filter__category-search" class="comments__form">
                                                <div class="comments__list-header">
                                                    <br/> نظر خود را درباره این پست وارد نمایید
                                                </div>
                                                <textarea name="description" class="form-control"></textarea>
                                                {{--                                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}--}}
                                                <div class="comments__form-btn">
                                                    {{--                                            {!! Form::button('ارسال <i class="icon-arrow-left"></i> ', ['class' => 'btn btn-block btn-success btn-sm', 'type' => 'submit']) !!}--}}
                                                    <button type="submit" class="btn btn-block btn-success btn-sm">ارسال
                                                        <i class="icon-arrow-left"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        برای ثبت نظر لطفا ابتدا از
                                        <a href="@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif">اینجا</a>
                                        وارد حساب کاربری خود شوید
                                    @endif


                                </div><!-- End .نظر -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">محصولاتی که شاید بپسندید</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "rtl": true,
                            "responsive": {
                                "0": {
                                    "items":1
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
                        @foreach($relatedProducts as $rproduct)
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">جدید</span>
                                    <a href="@if(!empty($demo))  {{route('demo.product.single',$rproduct->slug)}} @else  {{route('product.single',$rproduct->slug)}} @endif">
                                        @if(!empty($product->photos[0]->path))
                                            <img src="https://ishopsaz.com{{$product->photos[0]->path}}"
                                                 alt="تصویر محصول" class="product-image">
                                        @endif
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>افزودن به
                                            لیست علاقه مندی</span></a>
                                        {{--                                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview"--}}
                                        {{--                                           title="مشاهده سریع"><span>مشاهده سریع</span></a>--}}
                                        {{--                                        <a href="{{route('product.single',$rproduct->slug)}}" class="btn-product-icon btn-compare" title="مقایسه"><span>لیست--}}
                                        {{--                                            مقایسه</span></a>--}}
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="@if(!empty($demo))  {{route('demo.product.single',$rproduct->slug)}}@else  {{route('product.single',$rproduct->slug)}} @endif"
                                           class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
{{--                                    <div class="product-cat text-center">--}}
{{--                                        <a href="#">زنانه</a>--}}
{{--                                    </div><!-- End .product-cat -->--}}
                                    <h3 class="product-title text-center"><a
                                            href="@if(!empty($demo))  {{route('demo.product.single',$rproduct->slug)}} @else  {{route('product.single',$rproduct->slug)}} @endif">{{str_limit($rproduct['title'],30)}}</a>
                                    </h3>
                                    <!-- End .product-title -->
                                    <div class="product-price">
                                        @if($rproduct->price != 0)
                                            <p class="number-font price-product"><span class="price">
                                            @if($rproduct->discount_price)
                                                        {{number_format($rproduct->discount_price)}} تومان
                                                    @else
                                                        {{number_format($rproduct->price)}} تومان

                                                    @endif
                                        </span></p>
                                        @endif
                                    </div><!-- End .product-price -->
                                    {{--                                    <div class="ratings-container">--}}
                                    {{--                                        <div class="ratings">--}}
                                    {{--                                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->--}}
                                    {{--                                        </div><!-- End .ratings -->--}}
                                    {{--                                        <span class="ratings-text">( 2 دیدگاه )</span>--}}
                                    {{--                                    </div><!-- End .rating-container -->--}}

                                    {{--                                    <div class="product-nav product-nav-thumbs">--}}
                                    {{--                                        <a href="#" class="active">--}}
                                    {{--                                            <img src="assets/images/products/product-4-thumb.jpg" alt="product desc">--}}
                                    {{--                                        </a>--}}
                                    {{--                                        <a href="#">--}}
                                    {{--                                            <img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">--}}
                                    {{--                                        </a>--}}

                                    {{--                                        <a href="#">--}}
                                    {{--                                            <img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </div><!-- End .product-nav -->--}}
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->

                        @endforeach


                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">جدول سایز</h4>
                        </div>
                        <div class="modal-body">
                            @if(!empty($sizeTable))
                                <img src="https://www.ishopsaz.com{{$sizeTable->path}}" width="100%"/>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                        </div>
                    </div>

                </div>
            </div>
    </main>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function sizeChoose(sizeId) {
            var form_data = new FormData();
            form_data.append("_token", $('#token').val());
            form_data.append("sizeId", sizeId);
            form_data.append("product_id", {{$product->id}});
            $('#choosecolor').html('loading...');
            $.ajax({
                url: '@if(!empty($demo))  {{route('demo.showBox')}} @else  {{route('showBox')}} @endif', // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (php_script_response) {
                    $('#choosecolor').html(php_script_response);
                }
            });

            {{--$('#addToCartBtn').html('<a href="{{route('cart.add',['id'=>$product->id ])}}/' + sizeId + '/{{\Illuminate\Support\Facades\Session::get('coderahgiri')}}"  class="btn btn-warning title-font">افزودن به سبد</a>');--}}
            $('#addToCartBtn').html('<a href="@if(!empty($demo))  {{route('demo.cart.add2',['product_id'=>$product->id ])}} @else  {{route('cart.add2',['product_id'=>$product->id ])}} @endif"  class="btn btn-warning title-font">افزودن به سبد</a>');
            toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            toastr["success"](" سایز و رنگ با موفقیت انتخاب شد", "موفق");
        }
    </script>
    <style>
        .slick-list {
            height: auto !important;
        }
    </style>

@endsection

@section('script')
    {{--    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>--}}
    <link href="{{asset('theme/toastr/toastr.css')}}" rel="stylesheet"/>
    <script src="{{asset('theme/toastr/toastr.js')}}"></script>

    {{--    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>--}}

    <script type='text/Javascript'>$(document).ready(function () {
            $("#buttonGo").click(function () {

                $('html, body').animate({
                    scrollTop: $("#myDiv").offset().top
                }, 2000);
            });
//success toast
            $('#successtoast').click(function () {

                toastr.options = {
                    "closeButton": true,
                    "debug": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-left",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["warning"]("لطفا ابتدا سایز و رنگ را انتخاب کنید", "خطای سایز و رنگ");
            });

        });
    </script>

    <script src="{{asset('theme/theme2/assets/js/jquery.elevateZoom.min.js')}}"></script>
    <script src="{{asset('theme/theme2/assets/js/bootstrap-input-spinner.js')}}"></script>
@endsection
