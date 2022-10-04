
@extends('frontend.layout.master')

@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">وبلاگ ونوشته های سایت<span>بلاگ</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="#">وبلاگ</a></li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <nav aria-label="Page navigation">
                    {{$posts->links('pagination::bootstrap-4')}}

                </nav>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="entry-container max-col-2">
                            @foreach($posts as $post)


                                {{--                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 space_right_10 margin_bottom_70">--}}
                                {{--                                <a href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}" class="inline-block over-hidden"><img  src="https://www.ishopsaz.com{{$post['blog']['photo']['path']}}" class="img-responsive hover-zoom-out" width="150px" alt=""></a>--}}
                                {{--                                <h3 class="title-font capital title-post"><a href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}">{{$post['blog']['title']}}</a></h3>--}}
                                {{--                                <p class="des-font day-post">{{\Hekmatinasser\Verta\Verta::instance($post['blog']['created_at'])->format('Y-n-j')}}</p>--}}
                                {{--                                <p class="des-font des-post">--}}
                                {{--                                    {!! str_limit($post['blog']['description'],150) !!}--}}
                                {{--                                </p>--}}
                                {{--                                <a href="{{route('frontend.blogs.show',$post['blog']['slug'])   }}" class="menu-font link-more uppercase">بیشتر بخوانید</a>--}}
                                {{--                            </div> --}}
                                {{--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 space_right_10 ">--}}
                                {{--                                    <a href="{{route('frontend.blogs.show',$post->slug)   }}" class="inline-block over-hidden"><img  src="https://www.ishopsaz.com{{$post->photo->path}}" class="img-responsive hover-zoom-out" width="150px" alt=""></a>--}}
                                {{--                                    <p class="des-font des-post">--}}
                                {{--                                        <a href="{{route('frontend.blogs.show',$post->slug)   }}" > {{$post->title}}</a>--}}
                                {{--                                    </p>--}}
                                {{--                                </div>--}}

                                <div class="entry-item col-sm-6">
                                    <article class="entry entry-grid text-center">
                                        <figure class="entry-media">
                                            <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif">
                                                <img src="https://www.ishopsaz.com{{$post->photo->path}}"
                                                     alt="{{$post->slug}}">
                                            </a>
                                        </figure><!-- End .entry-media -->

                                        <div class="entry-body">
                                            <div class="entry-meta">
                                                <span class="entry-author">
                                                    نویسنده : <a href="#">مدیر سایت</a>
                                                </span>
                                                <span class="meta-separator">|</span>
                                                <a href="#">{{\Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y-n-j')}}</a>
                                                <span class="meta-separator">|</span>
                                                {{--                                                <a href="#">2 دیدگاه</a>--}}
                                            </div><!-- End .entry-meta -->

                                            <h2 class="entry-title text-center">
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }}  @endif"> {{$post->title}}</a>
                                            </h2><!-- End .entry-title -->

                                            {{--                                            <div class="entry-cats text-center">--}}
                                            {{--                                                <a href="#">سبک زندگی</a>،--}}
                                            {{--                                                <a href="#">فروشگاه</a>--}}
                                            {{--                                            </div><!-- End .entry-cats -->--}}
                                        </div><!-- End .entry-body -->
                                    </article><!-- End .entry -->
                                </div><!-- End .entry-item -->

                            @endforeach



                        </div><!-- End .entry-container -->

                        <nav aria-label="Page navigation">
                            {{$posts->links('pagination::bootstrap-4')}}

                        </nav>
                    </div><!-- End .col-lg-9 -->

                    <aside class="col-lg-3">
                        <div class="sidebar">
                            <div class="widget widget-search">
                                <h3 class="widget-title">جستجو</h3><!-- End .widget-title -->

                                <form action="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}}  @endif" method="get">
                                    @csrf
                                    <label for="ws" class="sr-only">جستجوی بلاگ</label>
                                    <input type="search" class="form-control" name="title" id="ws"
                                           placeholder="جستجوی خبر مورد نظر" required>
                                    <button type="submit" class="btn"><i class="icon-search"></i><span
                                                class="sr-only">جستجو</span></button>
                                </form>
                            </div><!-- End .widget -->

                            <div class="widget widget-cats">
                                <h3 class="widget-title">دسته بندی ها</h3><!-- End .widget-title -->
                                <ul>
                                    @include('partials.blogCategoryMenu',['categories'=>$categories])

                                </ul>
                            </div><!-- End .widget -->

                            <div class="widget">
                                <h3 class="widget-title">آخرین نوشته ها</h3><!-- End .widget-title -->

                                <ul class="posts-list">

                                    @foreach($last as $post)
                                        <li>
                                            <figure>
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }}  @endif">
                                                    @if($post->photo->id)

                                                        <img src="https://www.ishopsaz.com{{$post->photo->path}}" alt="post">
                                                    @else
                                                        <img src="asset/img/post-sidebar1.jpg" class="img-responsive hover-zoom-out" alt="">
                                                    @endif
                                                </a>
                                            </figure>

                                            <div>
                                                <span>{{\Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y-m-j')}}</span>
                                                <h4><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }}  @endif" class="link-default">{{$post->title}}</a></h4>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul><!-- End .posts-list -->
                            </div><!-- End .widget -->



                        </div><!-- End .sidebar -->
                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->


@endsection
