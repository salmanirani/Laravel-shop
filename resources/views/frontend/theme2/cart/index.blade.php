@extends('frontend.layout.master')
@section('content')

    <main class="main">
        <form
                action="@if(!empty($demo)) {{route('demo.order.verify')}} @else  {{route('order.verify')}}  @endif"
                method="post" >
            @csrf
        <div class="page-header text-center"
             style="background-image: url('{{asset('theme/theme2/assets/images/page-header-bg.jpg')}}')">
            <div class="container">
                <h1 class="page-title">سبد خرید <span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}}  @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="#">فروشگاه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سبد خرید</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->
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

                                <a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}}  @endif" class="btn btn-outline-primary-2 btn-order mt-3"><span>رفتن به
                                        فروشگاه و شروع خرید</span><i class="icon-long-arrow-left"></i></a>
                            </div>
                        </div>
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        @else
            <div class="page-content">
                <div class="cart">
                    <div class="container">
                        <div class="row">

                            @if(Session::has('warning'))
                                <div class="container">

                                    <div class="alert alert-danger">
                                        <p>{{session('warning')}}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-9">
                                <table class="table table-cart table-mobile">
                                    <thead>
                                    <tr>
                                        <th>محصول</th>
                                        <th>قیمت</th>
                                        <th>تعداد</th>
                                        <th>مجموع</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($cart as $product)
                                        @php
                                            $productDet = App\Http\Controllers\Frontend\Carts2Controller::getProduct($product->product_id);
                                            $qty = App\Http\Controllers\Frontend\Carts2Controller::qty($product->product_id);
                                        @endphp
                                        <tr>
                                            <td class="product-col">
                                                <div class="product">
                                                    <figure class="product-media">
                                                        <a href="#">
                                                            <img src="https://www.ishopsaz.com{{$productDet->photos[0]->path}}"
                                                                 alt="{{$productDet->title}}">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a href="@if(!empty($demo)) {{route('demo.product.single',$productDet->slug)}} @else  {{route('product.single',$productDet->slug)}}  @endif">{{$productDet->title}}</a>
                                                    </h3><!-- End .product-title -->
                                                </div><!-- End .product -->
                                            </td>
                                            <td class="price-col">{{number_format($productDet->discount_price ? $productDet->discount_price : $productDet->price) }}
                                                تومان
                                            </td>
                                            <td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control" value="{{$qty}}" min="1"
                                                           max="10"
                                                           step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
                                            <td class="total-col"> {{number_format($productDet->discount_price ? $productDet->discount_price*$qty : $productDet->price*$qty)}}
                                                تومان
                                            </td>
                                            <td class="remove-col">
                                                <button class="btn-remove" onclick="event.preventDefault();
                                                        document.getElementById('remove-cart-item_{{$productDet->id}}').submit();">
                                                    <i
                                                            class="icon-close"></i></button>
                                                <form id="remove-cart-item_{{$productDet->id}}"
                                                      action="@if(!empty($demo)) {{ route('demo.cart.remove2', ['id' => $productDet->id]) }} @else  {{ route('cart.remove2', ['id' => $productDet->id]) }}  @endif"
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
                                </table><!-- End .table table-wishlist -->

                                <div class="cart-bottom">
{{--                                    <div class="cart-discount">--}}
{{--                                            <div class="input-group">--}}
{{--                                                <input type="text" class="form-control"  placeholder="کد تخفیف">--}}
{{--                                                <div class="input-group-append">--}}
{{--                                                    <button class="btn btn-outline-primary-2" type="submit"><i--}}
{{--                                                                class="icon-long-arrow-left"></i></button>--}}
{{--                                                </div><!-- .End .input-group-append -->--}}
{{--                                            </div><!-- End .input-group -->--}}
{{--                                    </div><!-- End .cart-discount -->--}}
                                    <div class="cart-discount">
                                        <div class="input-group">
                                            <input type="text"  name="note"  class="form-control note--input des-font" placeholder="یادداشت و توضیحات اضافه">

                                        </div><!-- End .input-group -->
                                    </div><!-- End .cart-discount -->

                                    <a href="@if(!empty($demo)) {{route('demo.cart.cart')}} @else  {{route('cart.cart')}}  @endif" class="btn btn-outline-dark-2"><span>به روز رسانی سبد خرید</span><i
                                                class="icon-refresh"></i></a>
                                </div><!-- End .cart-bottom -->

                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary summary-cart">
                                    <h3 class="summary-title">جمع سبد خرید</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                        <tbody>
                                        <tr class="summary-subtotal">
                                            <td>جمع کل سبد خرید :</td>
                                            <td class="text-left">{{number_format($sumprize)}} تومان</td>
                                        </tr><!-- End .summary-subtotal -->
                                        <tr class="summary-shipping">
                                            <td>شیوه ارسال :</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        @foreach($postal as $value)
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <input type="radio" name="postal"
                                                           value="{{$value->id}}" checked>
                                                    &nbsp;
                                                    {{$value->title}}

                                                </td>
                                            </tr><!-- End .summary-shipping-row -->


                                        @endforeach

                                        <tr class="summary-shipping">

                                            <td colspan="2">آدرس :    </td>

                                        </tr>
                                        @foreach($addresses as $address)
                                            <tr>
                                                <td colspan="2">
                                                    <input type="radio" name="address" checked/> {{$address->address}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="summary-shipping-estimate">

                                            <td><a href="@if(!empty($demo)) {{route('demo.user.profile')}} @else  {{route('user.profile')}}  @endif"> آدرس جدید </a></td>

                                            <td>&nbsp;</td>
                                        </tr><!-- End .summary-shipping-estimate -->

                                        <tr class="summary-total">
                                            <td>مبلغ قابل پرداخت :</td>
                                            <td class="text-left">{{number_format($sumprize)}} تومان</td>
                                        </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                                    @if($addresses == '[]')
                                        <btn id="successtoast"
                                             class="btn btn-outline-primary-2 btn-order btn-block">پرداخت اینترنتی
                                        </btn>
                                    @else

                                        <input type="submit"  class="btn btn-outline-primary-2 btn-order btn-block" value="پرداخت اینترنتی">


                                        {{--                            <a href="{{route('order.verify')}}" class="btn-nixx number-font">پرداخت اینترنتی</a>--}}
                                    @endif

                                </div><!-- End .summary -->

                                <a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}}  @endif" class="btn btn-outline-dark-2 btn-block mb-3"><span>ادامه
                                        خرید</span><i class="icon-refresh"></i></a>
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->

        @endif
        </form>
    </main>
    <!-- End .main -->





@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
@section('script')
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <link href="{{asset('theme/toastr/toastr.css')}}" rel="stylesheet"/>
    <script src="{{asset('theme/toastr/toastr.js')}}"></script>

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
                        window.location.href = 'profile';
                    }
                }
                toastr["warning"]("لطفا ابتدا در سایت ثبت نام کنید و سپس آدرس منزل  را وارد نمایید.درحال انتقال...", "خطای آدرس");
            });

        });
    </script>

@endsection
