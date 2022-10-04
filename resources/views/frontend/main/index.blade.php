@extends('frontend.layout.master')

@section('content')

    <main>

        <div class="container relative margin_bottom_50">
            <div class="row">

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 info-slider-home1 text-left">
                    @php
                        $count = 1;
                    @endphp

                    @foreach($sliders as $slide)

                        <div class="slider-nav">
                            <div class="number-font text-left number-slider relative delay1_5">{{$count++}}
                                <figure class="line absolute"></figure>
                            </div>
                            <h1 class="title-font title-slider delay1_5">{{$slide->title}}</h1>
                            <p class="des-font des-slider delay1_5">{{$slide->description}}</p>
                        </div>
                    @endforeach
                </div>
                <!--  -->

                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 slider-home1 space_bot_70 absolute">
                    @foreach($sliders as $slide)
                        <div class="content-slider">
                            <a href="#"><img src="https://ishopsaz.com{{$slide->photo->path}}" class="img-responsive"
                                             alt=""></a>
                        </div>
                    @endforeach

                </div>
                <!--  -->
            </div>
        </div>

        {{--        <div class="slider-home2 container-fluid">--}}

        {{--            @foreach($sliders as $slide)--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">--}}
        {{--                        <div class="text-slider-home2">--}}
        {{--                            <p class="menu-child-font uppercase text-collection text-left delay1_5">{{$slide->short_desc}} </p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 relative">--}}
        {{--                        <div class="info-slider-home2 absolute">--}}

        {{--                            <h1 class="title-font capital title-slider-home2 delay1_5">{{$slide->description}}</h1>--}}
        {{--                        </div>--}}
        {{--                        <a href="#"><img src="{{$slide->photo->path}}"--}}
        {{--                                         class="img-responsive img-slider-main delay1_5" alt=""></a>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            @endforeach--}}
        {{--        </div>--}}


        {{--        <div class="flex fixed right social-fixed delay03">--}}
        {{--            <a href="#" class="delay03"><i class="ti-instagram"></i></a>--}}
        {{--            <a href="#" class="delay03"><i class="ti-facebook"></i></a>--}}
        {{--            <a href="#" class="delay03"><i class="ti-twitter-alt"></i></a>--}}
        {{--            <a href="#" class="delay03"><i class="ti-pinterest"></i></a>--}}
        {{--        </div>--}}

        {{--        <div class="container-fluid section2-home1 margin_bottom_130 margin_top_80">--}}
        {{--            <div class="row">--}}
        {{--                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs img-section over-hidden space_bot_30">--}}
        {{--                    <img src="asset/img/img-section2-home1.png" class="img-responsive right delay03" alt="">--}}
        {{--                </div>--}}
        {{--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left space_top_bot_180 content-section">--}}
        {{--                    <h1 class="title-font"><a href="#" class="title-hover delay03"> سبک راهی است برای گفتن شما بدون اینکه صحبت کنید چه کسی هستید</a></h1>--}}
        {{--                    <p class="des-font space_top_bot_70">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>--}}
        {{--                    <a href="#" class="menu-font uppercase learn_more title-hover delay03">بیشتر بدانید </a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title-font margin_bottom_10 title-bestseller text-center">جدیدترین محصولات</h2>
                    <p class="des-font margin_bottom_50 des-bestseller text-center">محصولات جدید
                        </p>
                    <div class="slick-newarrival">

                        <!-- Product -->
                        @foreach($latestProduct as $product)

                                                        <div class="product">
                                                            <div class="img-product relative">
                                                                @if(!empty($product->photos[0]->path))

                                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif" style="   width: 420px; ">
                                                                    <img src="https://ishopsaz.com{{$product->photos[0]->path}}" style="  width: 90%;
                                height: auto;
                                display: block; "   alt="{{$product->meta_desc}}"></a>

                                                                @else
                                                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif" style="   width: 420px; ">
                                                                        <img src="https://ishopsaz.com/images/email/noimage.png" style="  width: 90%;
                                height: auto;
                                display: block; "   alt="{{$product->meta_desc}}"></a>

                                                                @endif
                                                                <div class="product-icon text-center absolute">


                                                                    <a href="{{route('product.single',$product->slug)}}"
                                                                       class="engoj_btn_quickview icon-quickview inline-block" title="quickview">
                                                                        <i class="ti-eye"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="info-product text-center">
                                                                <h4 class="des-font capital title-product space_top_20"><a
                                                                            href="@if(!empty($demo)) {{route('demo.product.single',$product->slug)}} @else {{route('product.single',$product->slug)}} @endif">{{str_limit($product->title,30)}}</a>
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
{{--                            <div class="product">--}}
{{--                                <div class="img-product relative">--}}

{{--                                    @if(count($product->photos)>0)--}}
{{--                                    <a href="{{route('product.single',$product['title']['sku'])}}" style=""><img--}}
{{--                                                src="https://ishopsaz.com{{$product->photos[0]->path}}" class="blog"  alt="{{$product->meta_desc}}"></a>--}}
{{--                                        @endif--}}
{{--                                        @if($product->price == 0)--}}
{{--                                    <figure class="absolute uppercase label-new title-font text-center" style="width: 100px;">اتمام موجودی</figure>--}}
{{--                                   @endif--}}
{{--                                    <div class="product-icon text-center absolute">--}}
{{--                                        <a href="{{route('product.single',$product['title']['sku'])}}"--}}
{{--                                           class="engoj_btn_quickview icon-quickview inline-block" title="quickview">--}}
{{--                                            <i class="ti-eye"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="info-product text-center">--}}
{{--                                    <h4 class="des-font capital title-product space_top_20"><a--}}
{{--                                                href="{{route('product.single',$product['title']['sku'])}}">{{str_limit($product->title,30)}}</a>--}}
{{--                                    </h4>--}}
{{--                                    @if($product->price != 0)--}}
{{--                                    <p class="number-font price-product"><span class="price">--}}
{{--                                            @if($product->discount_price)--}}
{{--                                                <div> <del style="color:red">--}}
{{--                                                       <b>{{number_format($product->price)}} تومان</b>--}}
{{--                                               </del></div>--}}
{{--                                                {{number_format($product->discount_price)}} تومان--}}
{{--                                            @else--}}
{{--                                                {{number_format($product->price)}} تومان--}}

{{--                                            @endif--}}
{{--                                        </span>--}}
{{--                                    </p>--}}
{{--                                        @else--}}
{{--                                        اتمام موجودی--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}




                        @endforeach

                    </div>
                    <h2 class="des-font margin_bottom_50 des-bestseller text-center"><a
                                href="@if(!empty($demo)) {{route('demo.frontend.allproduct')}} @else {{route('frontend.allproduct')}} @endif">لیست تمام محصولات</a></h2>

                </div>
            </div>
        </div>
<style>
    img.blog{
        width: 90%;
        max-height: 450px;
        border-radius: 10%;
    }
    .link-default{
        font-size: 14px;
        text-align: center;
    }
</style>
        <div class="container collection_home5 margin_bottom_130">
            <h1 class="title-blog title-font text-center">نوشته های وبلاگ</h1>
            <p class="des-font des-blog text-center space_bot_60">آخرین نوشته ها</p>
            <div class="row">
                @foreach($posts as $post)
                    @if(!empty($post->title))
                <div class="col-md-4" align="center">
                    <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else {{route('frontend.blogs.show',$post->slug)   }} @endif" class="over-hidden inline-block"><img
                                src="https://ishopsaz.com{{$post->photo->path}}"
                                class="img-responsive hover-zoom-out blog" alt=""></a>
                    <div class="" align="center">
                        <h3 class=" margin_bottom_30"><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else {{route('frontend.blogs.show',$post->slug)   }} @endif" class="link-default">{{$post->title}}</a></h3>
                    </div>
                </div>
                    @endif
                @endforeach

                <!--  -->
{{--                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative flex">--}}
{{--                    <a href="{{route('frontend.blogs.show',$posts[1]->slug)   }}"--}}
{{--                       class="over-hidden inline-block midle"><img src="https://ishopsaz.com{{$posts[1]->photo->path}}"--}}
{{--                                                                   class="img-responsive hover-zoom-out" alt=""></a>--}}
{{--                    <div class="absolute" align="center">--}}
{{--                        <h3 class="margin_bottom_30"><a href="{{route('frontend.blogs.show',$posts[1]->slug)   }}"--}}
{{--                                                        class="link-default">{{$posts[1]->title}}</a></h3>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <!--  -->--}}
{{--                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 relative">--}}
{{--                    <a href="{{route('frontend.blogs.show',$posts[2]->slug)   }}" class="over-hidden inline-block"><img--}}
{{--                                src="https://ishopsaz.com{{$posts[2]->photo->path}}"--}}
{{--                                class="img-responsive hover-zoom-out" alt=""></a>--}}
{{--                    <div class="absolute " align="center">--}}
{{--                        <h3 class=" margin_bottom_30"><a href="#" class="link-default">{{$posts[2]->title}}</a></h3>--}}

{{--                    </div>--}}
{{--                </div>--}}
            </div>

        </div>

        {{--        <div class="container blog-home4 space_top_bot_150 margin_bottom_120 BG">--}}
        {{--            <h1 class="title-blog title-font text-center">نوشته های وبلاگ</h1>--}}
        {{--            <p class="des-font des-blog text-center space_bot_60">آخرین نوشته های چرلو</p>--}}

        {{--            <div class="row">--}}

        {{--                @foreach($posts as $post)--}}

        {{--                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 content-blog space_right_10">--}}
        {{--                        <a href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}" class="inline-block over-hidden"><img--}}
        {{--                                    src="https://ishopsaz.com{{$post['photo']}}" class="img-responsive hover-zoom-out" alt=""--}}
        {{--                                    width="100%"></a>--}}
        {{--                        <h2 class="title-font capital title-post"><a--}}
        {{--                                    href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}">{{$post['blog']['title']}}</a></h2>--}}
        {{--                        <p class="des-font day-post">{{\Hekmatinasser\Verta\Verta::instance($post['blog']['created_at'])->format('Y-n-j')}}</p>--}}
        {{--                        <p class="des-font day-post">{!! str_limit($post['blog']['description'],150) !!}</p>--}}
        {{--                        <a href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}" class="menu-font link-more uppercase">بیشتر--}}
        {{--                            ببینید</a>--}}
        {{--                    </div> --}}

        {{--                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 content-blog space_right_10">--}}
        {{--                        <a href="{{route('frontend.blogs.show',$post->slug)   }}" class="inline-block over-hidden"><img--}}
        {{--                                    src="https://ishopsaz.com{{$post->photo->path}}" class="img-responsive hover-zoom-out" alt=""--}}
        {{--                                    width="100%" style="position: relative; height: 300px; width: 100%;" ></a>--}}
        {{--                        <h2 class="des-font capital title-product space_top_20"><a--}}
        {{--                                    href="{{route('frontend.blogs.show',$post->slug)   }}">{{$post->title}}</a></h2>--}}
        {{--                        <p class="title-font day-post">{{\Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y-n-j')}}</p>--}}
        {{--                       {!! str_limit($post->description,350) !!}--}}
        {{--                        <a href="{{route('frontend.blogs.show',$post->slug)   }}" class="menu-font link-more uppercase">بیشتر--}}
        {{--                            ببینید</a>--}}
        {{--                    </div>--}}



        {{--                @endforeach--}}


        {{--            </div>--}}
        {{--        </div>--}}
        {{--    --}}

    </main>
    <style>

    </style>

@endsection
