@extends('frontend.layout.master')
@section('meta')
    {{--    <meta name="description" content="{{$posts[0]['blog']['meta_description']}}"/>--}}
    {{--    <meta name="keywords" content="{{$posts[0]['blog']['meta_keywords']}}"/>--}}
    <meta name="description" content="{{$posts->meta_description}}"/>
    <meta name="keywords" content="{{$posts->meta_keywords}}"/>


@endsection
@section('meta')
    <meta name="description" content="{{$posts->slug}}"/>
    <meta name="keywords" content="{{$posts->slug}}"/>
@endsection
@section('content')

    <main>
        <div class="banner margin_bottom_150">
            <div class="container">
                <h3 class="title-font ">نوشته ها</h3>
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}}@endif">نوشته ها</a></li>
                    <li class="active">{{$posts->slug}}</li>
                </ul>
            </div>
        </div>
        <!--  -->
        <div class="container blog-page margin_bottom_150 blog-detail-page">
            <div class="row flex">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content-blog-detail">
                    {{--                    <a href="#" class="inline-block over-hidden"><img src="https://www.ishopsaz.com{{$posts[0]['blog']['photo']['path']}}" class="full-width hover-zoom-out" alt=""></a>--}}
                    {{--                    <h1 class="title-font title-post">{{$posts[0]['blog']['title']}} </h1>--}}
                    {{--                    <p class="day-post des-font">{{\Hekmatinasser\Verta\Verta::instance($posts[0]['blog']['created_at'])->format('Y-n-j')}}</p>--}}
                    @if($posts->photo->extension == 'mp4' || $posts->photo->extension == '')

                        <a href="#" class="inline-block over-hidden"><img
                                    src="https://www.ishopsaz.com{{$posts->photo->path}}"
                                    class="full-width hover-zoom-out" alt=""></a>

                    @else
                        <video width="100%" oncontextmenu="return false;" id="myVideo"
                               autoplay controls controlsList="nodownload">
                            <source src="https://www.ishopsaz.com{{$posts->photo->path}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                    <h1 class="title-font title-post">{{$posts->title}} </h1>


                    {{$posts->title}}
                    <p class="des-post des-font">
                        {!! $posts->description !!}
                    </p>
                    <div class="collection-post space_top_bot_20 border-bot">
                        <i class="ti-folder space_right_10"></i>
                        <span class="menu-font">دسته بندی:</span>
                        <a href="#" class="des-font"> {{$posts->category->title}}</a>
                        {{--                        <p class="day-post des-font">{{\Hekmatinasser\Verta\Verta::instance($posts->created_at)->format('Y-n-j')}}</p>--}}

                    </div>

                    <div class="comment-post">
                        <h1 class="title-font title-comment-post">نوشتن یک دیدگاه</h1>
                        @if(Session::has('comments_status'))
                            <div class="alert alert-success">
                                <p>{{session('comments_status')}}</p>
                            </div>
                        @endif
                        @if(count($errors)>0)
                            @include('partials.form-error')

                        @endif

                        <p class="des-font des-comment-post margin_bottom_50">آدرس ایمیل شما منتشر نخواهد شد.</p>
                        <form class="form-group des-font" action="@if(!empty($demo)) {{route('demo.frontend.comments.store',$posts->id)}} @else  {{route('frontend.comments.store',$posts->id)}} @endif"
                              method="get">
                            @csrf
                            <textarea type="text" name="description" class="form-control"
                                      placeholder="دیدگاه"></textarea>
                            {{--                            <input type="text" name="name" class="form-control inline-block" placeholder="نام*">--}}
                            {{--                            <input type="email" name="email" class="form-control right inline-block" placeholder="ایمیل*">--}}
                            {{--                            <input type="text" name="website" class="form-control" placeholder="وب سایت*">--}}
                            <button type="submit" class="menu-font uppercase">ثبت دیدگاه</button>
                        </form>
                        <div class="comments__list">
                            <ul>
                                @include('partials.comments',['comments'=>$posts->comments,'post'=>$posts])
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 sidebar">
                    <ul class="post margin_bottom_70">
                        <li>
                            <h1 class="title-font title">نوشته های اخیر</h1>
                        </li>
                        @foreach($last as $postLast)
                            <li class="clearfix margin_bottom_20">
                                <div class="column-40 left">
                                    <a href="#" class="inline-block over-hidden"><img
                                                src="https://www.ishopsaz.com{{$postLast->photo->path}}"
                                                class="img-responsive hover-zoom-out" alt=""></a>
                                </div>
                                <div class="column-60 left">
                                    <h4 class="menu-font post-name"><a
                                                href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$postLast->slug)   }} @else  {{route('frontend.blogs.show',$postLast->slug)   }} @endif"
                                                class="link-default">{{$postLast->title}}</a></h4>
                                    <p class="des-font post-day">{{\Hekmatinasser\Verta\Verta::instance($postLast->created_at)->format('Y-n-j')}}</p>
                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <ul class="post margin_bottom_70">
                        <li>
                            <h1 class="title-font title">آخرین محصولات</h1>
                        </li>
                        @foreach($relatedProducts as $product)
                            <li class="clearfix margin_bottom_20">
                                <div class="column-40 left">
                                    <a href="@if(!empty($demo)) {{route('demo.product.single',$product->sku)}} @else  {{route('product.single',$product->sku)}} @endif"
                                       class="inline-block over-hidden"><img
                                                src="https://www.ishopsaz.com{{$product->photos[0]->path}}"
                                                class="img-responsive hover-zoom-out" alt=""></a>
                                </div>
                                <div class="column-60 left">
                                    <h4 class="menu-font post-name"><a href="@if(!empty($demo)) {{route('demo.product.single',$product->sku)}}@else  {{route('product.single',$product->sku)}} @endif"
                                                                       class="link-default">{{$product->title}}</a></h4>
                                    <p class="des-font post-day"> @if($product->price != 0)
                                        <p class="number-font price-product"><span class="price">
                                            @if($product->discount_price)
                                                    <div> <del style="color:red">
                                                       <b>{{number_format($product->price)}} تومان</b>
                                               </del></div>
                                                    {{number_format($product->discount_price)}} تومان
                                                @else
                                                    {{number_format($product->price)}} تومان

                                                @endif
                                        </span>
                                        </p>
                                    @else
                                        اتمام موجودی
                                        @endif</p>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <!--  -->

    </main>
    <style>


        strong {
            text-align: justify;
            line-height: 2.7em !important;
            font-size: 14px;
            font-weight: 400;
        }

        h1 {
            font-family: "Shabnam";
            line-height: 1.7em;
            font-size: 17px !important;
            text-shadow: 1px 1px rgba(0, 0, 0, 0.14);
            text-align: justify;


        }

        h4 a {
            font-family: "Shabnam";
            line-height: 1.7em;
            font-size: 15px !important;
            text-shadow: 1px 1px rgba(0, 0, 0, 0.14);
            text-align: justify;


        }

        h4 {
            font-family: "Shabnam";
            line-height: 2.7em;
            font-size: 14px !important;
            text-align: justify;


        }

        img {
            width: 60%;
            border-radius: 10%;
        }

        figure img {
            width: 60%;
            border-radius: 10%;
            box-shadow: 10px 10px 5px grey;
        }

    </style>
@endsection
