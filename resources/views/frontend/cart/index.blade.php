@extends('frontend.layout.master')
@section('content')


    <main>
        <div class="banner margin_bottom_100">
            <div class="container">
                <h3 class="title-font ">سبد خرید</h3>
                <ul class="breadcrumb des-font">
                    <li><a href="{{route('home')}}">صفحه نخست</a></li>
                    <li class="active">سبد خرید</li>
                </ul>
            </div>
        </div>
        <!--  -->
        <div class="container">

            @if(Session::has('warning'))
                <div class="container">

                    <div class="alert alert-danger">
                        <p>{{session('warning')}}</p>
                    </div>
                </div>
            @endif
{{--                class="table-responsive"--}}
                @if(count($cart)==0)
                    <div class="page-content">
                        <div class="cart">
                            <div class="container">
                                <div class="page404-bg text-center">
                                    <div class="page404-text">
                                        <div class="empty-image"><img src="{{asset('theme/theme2/assets/images/empty3.png')}}"
                                                                      alt="">
                                        </div>
                                        <div class="empty-text display-3">سبد خرید شما خالی است!</div>

                                        <a href="{{route('home')}}" class="btn btn-outline-primary-2 btn-order mt-3"><span>رفتن به
                                        فروشگاه و شروع خرید</span><i class="icon-long-arrow-left"></i></a>
                                    </div>
                                </div>
                            </div><!-- End .container -->
                        </div><!-- End .cart -->
                    </div><!-- End .page-content -->
                @else
            <div  >
                <style>
                    td,table{
                        border:solid gray 1px;
                        text-align: center;
                    }
                </style>
                <table class="table cart-table ">
                    <thead>
                    <tr class="number-font">
                        <td >محصول</td>
                        <td >توضیحات</td>
                        <td >قیمت</td>
                        <td >تعداد</td>
                        <td >جمع </td>
                        <td >حذف</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $product)
                        @php
                            $productDet = App\Http\Controllers\Frontend\Carts2Controller::getProduct($product->product_id);
                            $qty = App\Http\Controllers\Frontend\Carts2Controller::qty($product->product_id);
                        @endphp
                        <tr class="item_cart">
                            <td class=" product-name" width="20%">
                                <div class="product-img">
                                    {{$productDet->title}}
                                    <a href="{{route('product.single',$productDet->slug)}}">
                                        <img src="https://www.ishopsaz.com{{$productDet->photos[0]->path}}"
                                             alt="{{$productDet->title}}" class="img-responsive" width="30%">
                                    </a>
                                </div>
                            </td>
                            <td class="">
                                <div class="">
                                    <a href="{{route('product.single',$productDet->slug)}}"
                                       >{{App\Http\Controllers\Frontend\Carts2Controller::getProduct($product->product_id)->title}}</a>
                                    <p class="number-font margin_top_20">کد محصول: <span
                                                class="menu-child-font"> {{$productDet->slug}}</span></p>
{{--                                    {{App\Http\Controllers\Frontend\ProductController::loadsize($product['item']->id)}}--}}

                                </div>
                            </td>
                            <td>
                                <p class="price number-font">{{number_format($productDet->discount_price ? $productDet->discount_price : $productDet->price) }}
                                    تومان </p>
                            </td>
                            <td class="btn-fuction">
                                <div class="input-number-group">
                                    <div class="relative input-number-custom">
                                        {{$qty}} عدد

                                        {{--                                        <input class="input-number menu-font" type="number" min="0" max="1000"--}}
                                        {{--                                               value="{{$product['qty']}}">--}}

                                    </div>
                                </div>
                            </td>
                            <td class="total-price">
                                <p class="price number-font">{{number_format($productDet->discount_price ? $productDet->discount_price*$qty : $productDet->price*$qty)}} تومان </p>
                            </td>
                            <td class="product-remove">
                            <span onclick="event.preventDefault();
                                    document.getElementById('remove-cart-item_{{$productDet->id}}').submit();"
                                  class="btn-del link-default"><i class="ti-close"></i></span>
                                <form id="remove-cart-item_{{$productDet->id}}"
                                      action="{{ route('cart.remove2', ['id' => $productDet->id]) }}"
                                      method="post" style="display: none;">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                    @php
                        $sumprize =intval($sumprize) + intval($productDet->discount_price ? $productDet->discount_price*$qty : $productDet->price*$qty);

                    @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--  -->
            <hr/>
            <div class="table-cart-bottom margin_top_20 margin_bottom_50" id="app">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="cart-address">
                            <div class="container">
                                <h3 class="cart-address__title title-font">
                                    آدرس تحویل سفارش
                                </h3>
                                <div class="cart-address__wrapper">
                                    <div class="">


                                        @foreach($addresses as $address)
                                            <div class="row well title-font">
                                                <div class="col-md-2">
                                                    <input type="radio" name="address" checked/>
                                                </div>
                                                <div class="col-md-8">

                                                    {{$address->address}}

                                                </div>
                                            </div>

                                        @endforeach
                                        @if($addresses == '[]')
                                                @if(count($errors)>0)
                                                    @include('partials.form-error')
                                                @endif
                                            <form method="post" action="{{route('address.store')}}" class="login__form">
                                                @csrf
                                                <div class="row">

                                                    @if(empty(\Illuminate\Support\Facades\Auth::user()))

                                                        <a href="{{route('login')}}"
                                                           class="btn btn-warning title-font">ثبت نام یا ورود به
                                                            سایت</a>
                                                    @else
                                                        <div class="col-md-2">

                                                            <label for="postal_code" class="login__form-label">
                                                                کدپستی خود را وارد کنید
                                                            </label>
                                                            <input id="post_code" type="text"
                                                                   placeholder="کدپستی را وارد نمایید"
                                                                   class="form-control"
                                                                   name="post_code" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="postal_code" class="login__form-label">
                                                                توضیحات را وارد کنید
                                                            </label>
                                                            <input id="company" type="text"
                                                                   placeholder="توضیحات را وارد نمایید"
                                                                   class="form-control" name="company">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="address" class="login__form-label">
                                                                آدرس خود را وارد کنید
                                                            </label>
                                                            <input id="address" type="text"
                                                                   placeholder="آدرس خود را وارد کنید"
                                                                   class="form-control "
                                                                   name="address" required autofocus>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select-city-component-frontend></select-city-component-frontend>
{{--                                                        <select class="form-control">--}}
{{--                                                            <option></option>--}}
{{--                                                        </select>--}}
                                                        </div>

                                                        <br/>
                                                        <div class="col-md-1">
                                                            <input type="submit" value=" ثبت آدرس"
                                                                   class="btn btn-success"/>
                                                        </div>
                                                    @endif


                                                </div>


                                            </form>

                                        @endif


                                    </div>
                                    <a href="{{route('address.add')}}" title="" class="cart-address__add">
                                        <i class="icon-pluse-border"></i>
                                        <span class="cart-address__add-title title-font">افزودن آدرس جدید</span>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr/>
                <form
                        action="{{route('order.verify')}}"
                        method="post" >
                    @csrf
                @if(!empty($postal))
            <div class="table-cart-bottom margin_top_20 margin_bottom_50" id="app">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="cart-address">
                            <div class="container">
                                <h4 class="cart-address__title title-font">
                                    نحوه ارسال سفارش
                                </h4>
                                <div class="cart-address__wrapper">
                                    <div class="row">

                                        @foreach($postal as $value)
                                            <div class="col-md-3 well">
                                                {{--                                        <p class="number-font right">{{number_format($value->price)}}--}}
                                                {{--                                            تومان</p>--}}
                                                <input type="radio" name="postal" value="{{$value->id}}" checked> {{$value->title}}
                                            </div>
                                                <div class="col-md-1 "></div>
                                         @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endif
            <div class="table-cart-bottom margin_top_20 margin_bottom_50">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">

                        <div class="form-note">

                            <h3 class="title-font margin_bottom_20">یادداشتی برای خریدتان</h3>
                            <div class="form_coupon">
                                <div class="">
                                    <label for="CartSpecialInstructions" class="des-font margin_bottom_20">دستورالعمل
                                        ویژه برای فروشنده</label>
                                    <textarea rows="6" name="note" id="CartSpecialInstructions"
                                              class="form-control note--input des-font"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="cart-text">
                            <div class="cart-element flex">
                                <p class="des-font">جمع کل:</p>
                                <p class="number-font right">{{number_format($sumprize)}}
                                    تومان </p>
                            </div>

{{--                            <div class="cart-element flex">--}}
{{--                                <p class="des-font">تخفیف:</p>--}}
{{--                                <p class="number-font right">{{number_format(Session::get('cart')->totalDiscountPrice)}}--}}
{{--                                    تومان</p>--}}
{{--                            </div>--}}
                            <div class="cart-element flex">
                                <p class="des-font">مبلغ قابل پرداخت :</p>
                                @if(!empty($postal))
                                    <p class="number-font right">{{number_format($sumprize)}}
{{--                                        +$postal[0]->price--}}
                                @else
                                    <p class="number-font right">{{number_format($sumDiscount)}}
                                 @endif
                                        تومان</p>
                            </div>
                        </div>
                        @if($addresses == '[]')
                            <btn id="successtoast"
                                 class="btn-nixx number-font">پرداخت اینترنتی
                            </btn>
                        @else

                                <input type="submit" class="btn-nixx number-font" value="پرداخت اینترنتی">

                            </form>
{{--                            <a href="{{route('order.verify')}}" class="btn-nixx number-font">پرداخت اینترنتی</a>--}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
        @endif


    </main>






@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
@section('script')
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script type='text/javascript'
            src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>

    <script type='text/Javascript'>$(document).ready(function () {

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
                    "hideMethod": "fadeOut",
                    "onHidden": function () {
                        window.location.href = 'login';
                    }
                }
                toastr["warning"]("لطفا ابتدا در سایت ثبت نام کنید و سپس آدرس را وارد نمایید.درحال انتقال...", "خطای آدرس");
            });

        });
    </script>

@endsection