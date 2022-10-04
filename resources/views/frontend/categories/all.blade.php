@extends('frontend.layout.master')


@section('content')

    <main>
        <div class="banner margin_bottom_150">
            <div class="container">
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه
                            نخست</a></li>
                    <li class="active">محصولات</li>
                </ul>
            </div>
        </div>
        <!--  -->
        <div class="container shop-page margin_bottom_150">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="row btn-function-shop">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin_bottom_50">
                            <button class="active" id="btn-grid"><i class="ti-layout-grid3-alt"></i></button>
                            <button id="btn-list"><i class="ti-list"></i></button>
                        </div>

                    </div>
                    <div class="row">
                        @if(count($products)==0)
                            محصولی با این نام وجود ندارد
                        @endif
                        @foreach($products as $product)
                            @if($product->shop[0]->id == $shop)
                                <div class="product col-lg-2 col-md-2 col-sm-6 col-xs-6 margin_bottom_50">
                                    <div class="product">
                                        <div class="img-product relative">
                                            @if(!empty($product->photos[0]->path))
                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product['slug'])}} @else  {{route('product.single',$product['slug'])}} @endif"><img
                                                        src="https://www.ishopsaz.com{{$product['photos'][0]['path']}}"
                                                        class="img-responsive" alt=""></a>
                                            @else
                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product['slug'])}} @else  {{route('product.single',$product['slug'])}} @endif"><img
                                                        src="https://ishopsaz.com/images/email/noimage.png"
                                                        class="img-responsive" alt=""></a>
                                            @endif
                                            @if($product->price == 0)
                                                <figure class="absolute uppercase label-new title-font text-center"
                                                        style="width: 100px;">اتمام موجودی
                                                </figure>
                                            @endif
                                            <div class="product-icon text-center absolute">


                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product['slug'])}} @else  {{route('product.single',$product['slug'])}} @endif"
                                                   class="engoj_btn_quickview icon-quickview inline-block"
                                                   title="quickview">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="info-product text-center">
                                            <h4 class="des-font capital title-product space_top_20"><a
                                                    href="@if(!empty($demo)) {{route('demo.product.single',$product['slug'])}} @else  {{route('product.single',$product['slug'])}} @endif">{{str_limit($product['title'],30)}}</a>
                                            </h4>
                                            @if($product->price != 0)
                                                <p class="number-font price-product"><span class="price">
                                                @if($product['discount_price'])
                                                    <div>
                                                        <del style="color:red">
                                                            <b>{{number_format($product->price)}} تومان</b>
                                                        </del>
                                                    </div>
                                                    {{number_format($product->discount_price)}} تومان
                                                @else
                                                    {{number_format($product['price'])}} تومان

                                                    @endif
                                                    </span></p>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <!--  -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    {{$products->links('pagination::bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
