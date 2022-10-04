@extends('frontend.layout.master')
@section('content')

    <main>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="banner margin_bottom_150">
            <div class="container">
                <h1 class="title-font banner-product-detail">{{$product->title}}</h1>
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li><a href="#">محصولات</a></li>
                    <li class="active">{{$product->title}}</li>
                </ul>
            </div>
        </div>

        <div class="container product-detail margin_bottom_150">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin_bottom_50">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <div class="slick-nav-product-detail-vertical">

                                {{--                                @foreach($product['data']['images'] as $photo)--}}
                                {{--                                    <div>--}}
                                {{--                                        <img src="https://www.ishopsaz.com{{$photo['path']}}"  class="img-responsive" alt="">--}}
                                {{--                                    </div>--}}
                                {{--                                @endforeach --}}
                                @foreach($product->photos as $photo)
                                    <div>
                                        <img src="https://www.ishopsaz.com{{$photo->path}}" class="img-responsive"
                                             alt="">

                                    </div>

                                @endforeach


                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                            <div class="slick-product-detail-vertical margin_bottom_20">
                                @foreach($product->photos as $photo)
                                    <div>
                                        <img src="https://www.ishopsaz.com{{$photo->path}}"
                                             class="img-responsive full-width" alt="">

                                    </div>
                                @endforeach
                                @foreach($product->photos as $photo)
                                    <div>
                                        <img src="https://www.ishopsaz.com{{$photo->path}}"
                                             class="img-responsive full-width" alt="">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!--  -->

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 info-product-detail">
                    <h1 class="title-font title-product margin_bottom_30">{{$product->title}}</h1>
                    @if($product->price != 0)
                        <p class="number-font price margin_bottom_40">
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
                        </p>
                    @endif
                    <div class="margin_bottom_30 title-font">
                        @php
                            $inventory = 0;
                        @endphp
                        @if(count($product['sizecolors'])>0 and $product->price!= 0)
                            {{--  سایز و رنگ های موجود--}}
                            <div class="variations" data-tabindex="variations">
                                <div class="variations__tab tab-title">
                                     در کادر زیر سایز و رنگ مورد نظر خود را انتخاب کنید:
                                    <div class="row">
                                        <div class="col-md-2">
                                            <select class="form-control" onchange="sizeChoose(this.value);">
                                                <option value="">انتخاب کنید</option>
                                                @foreach($product->sizecolors as $sizecolor)
                                                    @if($sizecolor->inventory>0)
                                                    <option value="{{$sizecolor->id}}"
                                                            style="background-color: {{$sizecolor->colors}};border-style: solid;border-color: black;border-width: 1px"> سایز {{$sizecolor->size}}  رنگ {{$sizecolor->colorname}}  </option>
                                                    @php
                                                        $inventory = $inventory + $sizecolor->inventory;
                                                    @endphp
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="choosecolor"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <br/>
                        @if(!empty($sizeTable))
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">جدول
                                سایز
                            </button>

                        @endif
                    </div>
                    <!-- Modal -->
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

                    {{--                    //add to cart for product with size and color--}}
                    @if($inventory>0 and $product->price!= 0)
                        <span id="addToCartBtn">
                            <btn id="successtoast"
                                 class="btn btn-warning title-font">افزودن به سبد</btn>

                        </span>

                    @else
                        <button class="btn btn-sm btn-danger"> اتمام موجودی</button>

                    @endif




                    {{--                    //add to cart for product without size and color--}}
                    @if($product->inventory>0)
                        <a href="@if(!empty($demo)) {{route('demo.cart.add',['id'=>$product->id ,'size'=>'1'])}} @else  {{route('cart.add',['id'=>$product->id ,'size'=>'1'])}} @endif"
                           class="btn btn-warning title-font">افزودن به سبد</a>
                    @endif

                    @if($inventory==0 && $product->inventory==0 && $product->price== 0)
                        {{--                        <button class="btn btn-sm btn-danger"> اتمام موجودی</button>--}}
                    @endif
                    <div class="info-more">
                        {{--                        <p class="des-font margin_bottom_30 margin_top_50"><span--}}
                        {{--                                    class="menu-font">موجودی :</span>--}}
                        {{--                            @if($inventory>0)--}}
                        {{--                            {{$inventory}}--}}
                        {{--                            @else--}}
                        {{--                            {{$product->inventory}}--}}
                        {{--                            @endif--}}
                        {{--                            عدد </p>--}}
                        @if($product->pichazi==1)
                            <p class="des-font margin_bottom_30 margin_top_50"><span
                                        class="menu-font">نوع پارچه:</span>پیچازی </p>
                        @endif

                        <p class="des-font margin_bottom_30 margin_top_50"><span
                                    class="menu-font">کد محصول:</span>{{$product->sku}}</p>
                        <p class="margin_bottom_30">
                            <span class="menu-font margin_right_10">دسته بندی:</span>
                            @foreach($product->mtcategories as $categories)
                                <a href="@if(!empty($demo)) {{route('demo.category.index',$categories->slug)}} @else  {{route('category.index',$categories->slug)}} @endif"
                                   class="delay03 margin_right_10">{{$categories->name}}</a>

                            @endforeach

                        </p>
                        <p class="margin_bottom_30">
                            <button id="buttonGo" class="btn btn-primaryslick-track">ویژگی های محصول</button>
                        </p>

                        <p class="margin_bottom_30">
                            <span class="menu-font margin_right_30">به اشتراک بگذارید:</span>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=cherllo.ir"
                               class="delay03 margin_right_30"><i class="ti-facebook"></i></a>
                            <a target="_blank" href="https://www.twitter.com/sharer/sharer.php?u=cherllo.ir"
                               class="delay03 margin_right_30"><i class="ti-twitter-alt"></i></a>
                            <a target="_blank" href="https://www.pinterest.com/sharer/sharer.php?u=cherllo.ir"
                               class="delay03 margin_right_30"><i class="ti-pinterest"></i></a>
                            <a target="_blank" href="https://www.linkedin.com/sharer/sharer.php?u=cherllo.ir"
                               class="delay03 margin_right_30"><i class="ti-linkedin"></i></a>
                            <a target="_blank" href="https://www.instagram.com/sharer/sharer.php?u=cherllo.ir"
                               class="delay03 margin_right_30"><i class="ti-instagram"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="tab-content-detail container margin_bottom_150" id="myDiv">
            <div class="border-bot space_bot_100">
                <ul class="nav nav-tabs btn-tab-product-detail margin_bottom_100">
                    <li class="active"><a data-toggle="tab" href="#menu1" class=" menu-font btn-tab relative">ویژگی
                            ها
                            <figure class="line"></figure>
                        </a></li>
                    <li class="container_60 "><a data-toggle="tab" href="#home" class=" menu-font btn-tab relative">نقد
                            و بررسی
                            <figure class="line"></figure>
                        </a></li>

                    <li><a data-toggle="tab" href="#menu2" class=" menu-font btn-tab relative">دیدگاه مشتریان
                            <figure class="line"></figure>
                        </a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade ">
                        <h1 class="des-font des-tab font">

                            {!! $product->short_description !!}
                        </h1>
                        <h1 class="des-font des-tab">

                            {!! $product->long_description !!}
                        </h1>


                    </div>
                    <div id="menu1" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-3">
                                <ul class="space_left_20 des-font des-tab">
                                    @foreach($detailSelect as $attribute)
                                        <li>{{$attribute['attributegroup']['title']}} : {{$attribute['title']}}    </li>
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

                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <div class="row">
                            <div class="review margin_bottom_50 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <h1 class="menu-font title-review">دیدگاه ها</h1>
                                <p class="des-font content-review">
                                    @include('partials.mtcomments',['comments'=>$product->mtcomments,'product'=>$product])
                                </p>
                            </div>
                            <div class="form-review col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                @if(count($errors)>0)
                                    @include('partials.form-error')

                                @endif
                                @if(Session::has('comments_status'))
                                    <div class="alert alert-success">
                                        <p>{{session('comments_status')}}</p>
                                    </div>

                                @endif
                                @if(Auth::check())
                                    <h1 class="menu-font title-form">ثبت دیدگاه برای {{$product->title}}</h1>

                                    <p class="des-font des-review margin_bottom_50">آدرس ایمیل شما منتشر نخواهد شد.</p>

{{--                                    {!! Form::open((['method'=>'GET','route'=>['frontend.mtcomments.store',$product->id],'class'=>'comments__form'])) !!}--}}
                                  <form action="@if(!empty($demo)) {{route('demo.frontend.mtcomments.store',$product->id)}} @else  {{route('frontend.mtcomments.store',$product->id)}} @endif">
                                    <div class="filter__category-search" class="comments__form">
                                        <div class="comments__list-header">
                                            <br/> نظر خود را درباره این پست وارد نمایید
                                        </div>
                                        <textarea name="description" class="form-control"></textarea>
{{--                                        {!! Form::textarea('description',null,['class'=>'form-control']) !!}--}}
                                        <div class="comments__form-btn">
{{--                                            {!! Form::button('ارسال <i class="icon-arrow-left"></i> ', ['class' => 'btn btn-block btn-success btn-sm', 'type' => 'submit']) !!}--}}
                                            <button type="submit" class="btn btn-block btn-success btn-sm">ارسال <i class="icon-arrow-left"></i></button>
                                        </div>
                                    </div>
                                  </form>
                                @else
                                    برای ثبت نظر لطفا ابتدا از
                                    <a href="@if(!empty($demo)) {{route('login')}} @else  {{route('login')}} @endif">اینجا</a>
                                    وارد حساب کاربری خود شوید
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------ -->
        </div>
        <div class="container margin_bottom_130 section-bestseller-home1">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title-font margin_bottom_10 title-bestseller">محصولات مرتبط</h1>

                    <div class="slick-bestseller">
                        @foreach($relatedProducts as $rproduct)
                            <div class="product">
                                <div class="img-product relative">
                                    @if(!empty($rproduct->photos[0]->path))
                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$rproduct->slug)}} @else  {{route('product.single',$rproduct->slug)}} @endif"><img
                                                src="https://www.ishopsaz.com{{$rproduct->photos[0]->path}}"
                                                class="img-responsive"
                                                width="328px" alt=""></a>
                                    @endif
                                    @if($rproduct->price == 0)
                                        <figure class="absolute uppercase label-new title-font text-center"
                                                style="width: 100px;">اتمام موجودی
                                        </figure>
                                    @endif
                                    {{--                                    <figure class="absolute uppercase label-new title-font text-center">جدید</figure>--}}
                                    <div class="product-icon text-center absolute">


                                        <a href="@if(!empty($demo)) {{route('demo.product.single',$rproduct->slug)}} @else  {{route('product.single',$rproduct->slug)}} @endif"
                                           class="engoj_btn_quickview icon-quickview inline-block"
                                           title="{{$rproduct['slug']}}">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="info-product text-center">
                                    <h4 class="des-font capital title-product space_top_20"><a
                                                href="@if(!empty($demo)) {{route('demo.product.single',$rproduct->slug)}} @else  {{route('product.single',$rproduct->slug)}} @endif">{{str_limit($rproduct['title'],30)}}</a>
                                    </h4>
                                    @if($rproduct->price != 0)
                                        <p class="number-font price-product"><span class="price">
                                            @if($rproduct->discount_price)
                                                    {{number_format($rproduct->discount_price)}} تومان
                                                @else
                                                    {{number_format($rproduct->price)}} تومان

                                                @endif
                                        </span></p>
                                    @endif
                                </div>
                            </div>
                    @endforeach
                    <!--  -->
                    </div>

                </div>
            </div>
        </div>
    </main>
    {{--    <a href="{{route('cart.add',['id'=>$product->id ,'size'=>'1'])}}"--}}
    {{--       class="btn btn-warning title-font">افزودن به سبد</a>--}}
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
                url: '@if(!empty($demo)) {{route('demo.showBox')}} @else  {{route('showBox')}} @endif', // point to server-side PHP script
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
            $('#addToCartBtn').html('<a href="@if(!empty($demo)) {{route('demo.cart.add2',['product_id'=>$product->id ])}}@else  {{route('cart.add2',['product_id'=>$product->id ])}} @endif"  class="btn btn-warning title-font">افزودن به سبد</a>');
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
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script type='text/javascript'
            src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

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

@endsection
