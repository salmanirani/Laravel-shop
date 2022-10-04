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
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">{{$posts->title}}<span>{{$posts->slug}}</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}}  @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}}  @endif">وبلاگ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$posts->title}}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <article class="entry single-entry">
                            <figure class="">
                                @if($posts->photo->extension == 'mp4' || $posts->photo->extension == '')

                                    <img src="https://www.ishopsaz.com{{$posts->photo->path}}" alt="image"
                                         class="" >

                                @else
                                    <video width="100%" oncontextmenu="return false;" id="myVideo"
                                           autoplay controls controlsList="nodownload">
                                        <source src="https://www.ishopsaz.com{{$posts->photo->path}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </figure><!-- End .entry-media -->

                            <div class="entry-body">
                                <div class="entry-meta">
                                        <span class="entry-author">
                                            تاریخ :
                                        </span>
                                    <a href="#">{{\Hekmatinasser\Verta\Verta::instance($posts->created_at)->format('Y-n-j')}}</a>
                                    <span class="meta-separator">|</span>
                                    <a href="#">2 دیدگاه</a>
                                </div><!-- End .entry-meta -->

                                <h2 class="entry-title">
                                    {{$posts->title}}
                                </h2><!-- End .entry-title -->

                                <div class="entry-cats">
                                    <a href="#"> {{$posts->category->title}}</a>،
                                </div><!-- End .entry-cats -->

                                <div class="entry-content editor-content">

                                    <p>{!! $posts->description !!}</p>


                                    <div class="pb-1"></div><!-- End .mb-1 -->


                                </div><!-- End .entry-content -->

                                <div class="entry-footer row no-gutters flex-column flex-md-row">
                                    <div class="col-md">
                                        <div class="entry-tags">
                                            <span>برچسب : </span> <a href="#">{{$posts->category->title}}</a>
                                        </div><!-- End .entry-tags -->
                                    </div><!-- End .col -->

                                    <div class="col-md-auto mt-2 mt-md-0">
                                        <div class="social-icons social-icons-color">
                                            <span class="social-label">اشتراک گذاری این پست : </span>
                                            <a href="#" class="social-icon social-facebook" title="فیسبوک"
                                               target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon social-twitter" title="توییتر"
                                               target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon social-pinterest" title="پینترست"
                                               target="_blank"><i class="icon-pinterest"></i></a>
                                            <a href="#" class="social-icon social-linkedin" title="لینکدین"
                                               target="_blank"><i class="icon-linkedin"></i></a>
                                        </div><!-- End .soial-icons -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .entry-footer row no-gutters -->
                            </div><!-- End .entry-body -->


                        </article><!-- End .entry -->

                        {{--                        <nav class="pager-nav" aria-label="Page navigation">--}}
                        {{--                            <a class="pager-link pager-link-prev" href="#" aria-label="Previous" tabindex="-1">--}}
                        {{--                                پست قبلی--}}
                        {{--                                <span class="pager-link-title">لورم ایپسوم متن ساختگی با تولید سادگی</span>--}}
                        {{--                            </a>--}}

                        {{--                            <a class="pager-link pager-link-next" href="#" aria-label="Next" tabindex="-1">--}}
                        {{--                                پست بعدی--}}
                        {{--                                <span class="pager-link-title">لورم ایپسوم متن ساختگی</span>--}}
                        {{--                            </a>--}}
                        {{--                        </nav><!-- End .pager-nav -->--}}

                        {{--                        <div class="related-posts">--}}
                        {{--                            <h3 class="title">پست های مرتبط</h3><!-- End .title -->--}}

                        {{--                            <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{--}}
                        {{--                                        "nav": false,--}}
                        {{--                                        "dots": true,--}}
                        {{--                                        "margin": 20,--}}
                        {{--                                        "loop": false,--}}
                        {{--                                        "rtl": true,--}}
                        {{--                            "responsive": {--}}
                        {{--                                            "0": {--}}
                        {{--                                                "items":1--}}
                        {{--                                            },--}}
                        {{--                                            "480": {--}}
                        {{--                                                "items":2--}}
                        {{--                                            },--}}
                        {{--                                            "768": {--}}
                        {{--                                                "items":3--}}
                        {{--                                            }--}}
                        {{--                                        }--}}
                        {{--                                    }'>--}}
                        {{--                                <article class="entry entry-grid">--}}
                        {{--                                    <figure class="entry-media">--}}
                        {{--                                        <a href="single.html">--}}
                        {{--                                            <img src="assets/images/blog/grid/3cols/post-1.jpg" alt="توضیحات عکس">--}}
                        {{--                                        </a>--}}
                        {{--                                    </figure><!-- End .entry-media -->--}}

                        {{--                                    <div class="entry-body">--}}
                        {{--                                        <div class="entry-meta justify-content-start">--}}
                        {{--                                            <a href="#">22 فروردین 1401</a>--}}
                        {{--                                            <span class="meta-separator">|</span>--}}
                        {{--                                            <a href="#">2 دیدگاه</a>--}}
                        {{--                                        </div><!-- End .entry-meta -->--}}

                        {{--                                        <h2 class="entry-title">--}}
                        {{--                                            <a href="single.html">لورم ایپسوم متن ساختگی با تولید سادگی</a>--}}
                        {{--                                        </h2><!-- End .entry-title -->--}}

                        {{--                                        <div class="entry-cats">--}}
                        {{--                                            <a href="#">سبک زندگی</a>،--}}
                        {{--                                            <a href="#">فروشگاه</a>--}}
                        {{--                                        </div><!-- End .entry-cats -->--}}
                        {{--                                    </div><!-- End .entry-body -->--}}
                        {{--                                </article><!-- End .entry -->--}}

                        {{--                                <article class="entry entry-grid">--}}
                        {{--                                    <figure class="entry-media">--}}
                        {{--                                        <a href="single.html">--}}
                        {{--                                            <img src="assets/images/blog/grid/3cols/post-2.jpg" alt="توضیحات عکس">--}}
                        {{--                                        </a>--}}
                        {{--                                    </figure><!-- End .entry-media -->--}}

                        {{--                                    <div class="entry-body">--}}
                        {{--                                        <div class="entry-meta justify-content-start">--}}
                        {{--                                            <a href="#">21 فروردین 1401</a>--}}
                        {{--                                            <span class="meta-separator">|</span>--}}
                        {{--                                            <a href="#">0 دیدگاه</a>--}}
                        {{--                                        </div><!-- End .entry-meta -->--}}

                        {{--                                        <h2 class="entry-title">--}}
                        {{--                                            <a href="single.html">لورم ایپسوم متن ساختگی</a>--}}
                        {{--                                        </h2><!-- End .entry-title -->--}}

                        {{--                                        <div class="entry-cats">--}}
                        {{--                                            <a href="#">سبک زندگی</a>--}}
                        {{--                                        </div><!-- End .entry-cats -->--}}
                        {{--                                    </div><!-- End .entry-body -->--}}
                        {{--                                </article><!-- End .entry -->--}}

                        {{--                                <article class="entry entry-grid">--}}
                        {{--                                    <figure class="entry-media">--}}
                        {{--                                        <a href="single.html">--}}
                        {{--                                            <img src="assets/images/blog/grid/3cols/post-3.jpg" alt="توضیحات عکس">--}}
                        {{--                                        </a>--}}
                        {{--                                    </figure><!-- End .entry-media -->--}}

                        {{--                                    <div class="entry-body">--}}
                        {{--                                        <div class="entry-meta justify-content-start">--}}
                        {{--                                            <a href="#">18 فروردین 1401</a>--}}
                        {{--                                            <span class="meta-separator">|</span>--}}
                        {{--                                            <a href="#">3 دیدگاه</a>--}}
                        {{--                                        </div><!-- End .entry-meta -->--}}

                        {{--                                        <h2 class="entry-title">--}}
                        {{--                                            <a href="single.html">لورم ایپسوم متن ساختگی.</a>--}}
                        {{--                                        </h2><!-- End .entry-title -->--}}

                        {{--                                        <div class="entry-cats">--}}
                        {{--                                            <a href="#">مد</a>،--}}
                        {{--                                            <a href="#">سبک زندگی</a>--}}
                        {{--                                        </div><!-- End .entry-cats -->--}}
                        {{--                                    </div><!-- End .entry-body -->--}}
                        {{--                                </article><!-- End .entry -->--}}

                        {{--                                <article class="entry entry-grid">--}}
                        {{--                                    <figure class="entry-media">--}}
                        {{--                                        <a href="single.html">--}}
                        {{--                                            <img src="assets/images/blog/grid/3cols/post-4.jpg" alt="توضیحات عکس">--}}
                        {{--                                        </a>--}}
                        {{--                                    </figure><!-- End .entry-media -->--}}

                        {{--                                    <div class="entry-body">--}}
                        {{--                                        <div class="entry-meta justify-content-start">--}}
                        {{--                                            <a href="#">15 فروردین 1401</a>--}}
                        {{--                                            <span class="meta-separator">|</span>--}}
                        {{--                                            <a href="#">4 دیدگاه</a>--}}
                        {{--                                        </div><!-- End .entry-meta -->--}}

                        {{--                                        <h2 class="entry-title">--}}
                        {{--                                            <a href="single.html">لورم ایپسوم متن ساختگی</a>--}}
                        {{--                                        </h2><!-- End .entry-title -->--}}

                        {{--                                        <div class="entry-cats">--}}
                        {{--                                            <a href="#">سفر</a>--}}
                        {{--                                        </div><!-- End .entry-cats -->--}}
                        {{--                                    </div><!-- End .entry-body -->--}}
                        {{--                                </article><!-- End .entry -->--}}
                        {{--                            </div><!-- End .owl-carousel -->--}}
                        {{--                        </div><!-- End .related-posts -->--}}

                        <div class="comments">
                            {{--                            <h3 class="title">3 دیدگاه</h3><!-- End .title -->--}}

                            <ul>
                                @include('partials.theme2.comments',['comments'=>$posts->comments,'post'=>$posts])


                            </ul>
                        </div><!-- End .comments -->
                        <div class="reply">
                            <div class="heading">
                                <h3 class="title">ارسال یک دیدگاه</h3><!-- End .title -->
                                <p class="title-desc">ایمیل شما منتشر نخواهد شد، فیلد های اجباری با علامت * مشخص
                                    شده اند.</p>
                                @if(Session::has('comments_status'))
                                    <div class="alert alert-success">
                                        <p>{{session('comments_status')}}</p>
                                    </div>
                                @endif
                                @if(count($errors)>0)
                                    @include('partials.form-error')

                                @endif
                            </div><!-- End .heading -->

                            <form action="@if(!empty($demo)) {{route('demo.frontend.comments.store',$posts->id)}} @else  {{route('frontend.comments.store',$posts->id)}}  @endif" method="get">
                                @csrf
                                <label for="reply-message" class="sr-only">دیدگاه</label>
                                <textarea name="description" cols="30" rows="4"
                                          class="form-control" required placeholder="دیدگاه شما *"></textarea>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="reply-name" class="sr-only">نام</label>
                                        <input type="text" class="form-control" id="reply-name" name="reply-name"
                                               required placeholder="نام شما *">
                                    </div><!-- End .col-md-6 -->

                                    <div class="col-md-6">
                                        <label for="reply-email" class="sr-only">ایمیل</label>
                                        <input type="email" class="form-control" id="reply-email" name="reply-email"
                                               required placeholder="ایمیل شما *">
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->

                                <button type="submit" class="btn btn-outline-primary-2 float-right">
                                    <span>ارسال دیدگاه</span>
                                    <i class="icon-long-arrow-left"></i>
                                </button>
                            </form>
                        </div><!-- End .reply -->
                    </div><!-- End .col-lg-9 -->

                    <aside class="col-lg-3">
                        <div class="sidebar">
                            {{--                            <div class="widget widget-search">--}}
                            {{--                                <h3 class="widget-title">جستجو</h3><!-- End .widget-title -->--}}

                            {{--                                <form action="#">--}}
                            {{--                                    <label for="ws" class="sr-only">جستجوی اخبار</label>--}}
                            {{--                                    <input type="search" class="form-control" name="ws" id="ws"--}}
                            {{--                                           placeholder="جستجوی خبر مورد نظر" required>--}}
                            {{--                                    <button type="submit" class="btn"><i class="icon-search"></i><span--}}
                            {{--                                                class="sr-only">جستجو</span></button>--}}
                            {{--                                </form>--}}
                            {{--                            </div><!-- End .widget -->--}}

                            <div class="widget widget-cats">
                                <h3 class="widget-title">دسته بندی ها</h3><!-- End .widget-title -->

                                <ul>
                                    @foreach($categoriesBlog as $blog)

                                        <li>
                                            <a href="{{route('frontend.blogs.blogCat','category='.$blog->id)}}">{{$blog['title']}}</a>
                                        </li>

                                    @endforeach

                                </ul>
                            </div><!-- End .widget -->

                            <div class="widget">
                                <h3 class="widget-title">آخرین مطالب وبلاگ</h3><!-- End .widget-title -->

                                <ul class="posts-list">

                                    @foreach($last as $postLast)

                                        <li>
                                            <figure>
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$postLast->slug)   }} @else  {{route('frontend.blogs.show',$postLast->slug)   }}  @endif">
                                                    <img src="https://www.ishopsaz.com{{$postLast->photo->path}}"
                                                         alt="post">
                                                </a>
                                            </figure>

                                            <div>
                                                <span>{{\Hekmatinasser\Verta\Verta::instance($postLast->created_at)->format('Y-n-j')}}</span>
                                                <h4><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$postLast->slug)   }} @else  {{route('frontend.blogs.show',$postLast->slug)   }}  @endif">{{$postLast->title}}</a></h4>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul><!-- End .posts-list -->
                            </div><!-- End .widget -->

                            {{--                            <div class="widget widget-banner-sidebar">--}}
                            {{--                                <div class="banner-sidebar-title">قسمت تبلیغات 280 در 280</div>--}}
                            {{--                                <!-- End .ad-title -->--}}

                            {{--                                <div class="banner-sidebar banner-overlay">--}}
                            {{--                                    <a href="#">--}}
                            {{--                                        <img src="assets/images/blog/sidebar/banner.jpg" alt="بنر">--}}
                            {{--                                    </a>--}}
                            {{--                                </div><!-- End .banner-ad -->--}}
                            {{--                            </div><!-- End .widget -->--}}

                            <div class="widget">
                                <h3 class="widget-title">برچسب ها</h3><!-- End .widget-title -->

                                <div class="tagcloud">
                                    {{$posts->meta_keywords}}

                                </div><!-- End .tagcloud -->
                            </div><!-- End .widget -->
                            <div class="widget">
                                <h3 class="widget-title">محصولات</h3><!-- End .widget-title -->

                                <ul class="posts-list">

                                    @foreach($relatedProducts as $product)


                                        <li>
                                            <figure>
                                                <a href="@if(!empty($demo)) {{route('demo.product.single',$product->sku)}} @else  {{route('product.single',$product->sku)}}  @endif">
                                                    <img src="https://www.ishopsaz.com{{$product->photos[0]->path}}"
                                                         alt="post">
                                                </a>
                                            </figure>

                                            <div>
                                                <span> @if($product->discount_price)
                                                        <div> <del style="color:red">
                                                       <b>{{number_format($product->price)}} تومان</b>
                                               </del></div>
                                                        {{number_format($product->discount_price)}} تومان
                                                    @else
                                                        {{number_format($product->price)}} تومان

                                                    @endif
                                        </span>
                                                </p>
                                                </span>
                                                <h4><a href="@if(!empty($demo)) {{route('demo.product.single',$product->sku)}} @else  {{route('product.single',$product->sku)}}  @endif">{{$product->title}}</a></h4>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul><!-- End .posts-list -->
                            </div><!-- End .widget -->
                            {{--                            <div class="widget widget-text">--}}
                            {{--                                <h3 class="widget-title">درباره بخش اخبار</h3><!-- End .widget-title -->--}}

                            {{--                                <div class="widget-text-content">--}}
                            {{--                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با--}}
                            {{--                                        تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با لورم ایپسوم متن ساختگی با--}}
                            {{--                                        تولید سادگی نامفهوم</p>--}}
                            {{--                                </div><!-- End .widget-text-content -->--}}
                            {{--                            </div><!-- End .widget -->--}}
                        </div><!-- End .sidebar -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->

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
            /*width: 60%;*/
            /*border-radius: 10%;*/
        }

        figure img {
            width: 60%;
            border-radius: 10%;
            box-shadow: 10px 10px 5px grey;
        }

    </style>
@endsection
