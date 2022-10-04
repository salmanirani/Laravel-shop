@extends('frontend.layout.master')

@section('content')




    <div class="container">
        <div class="row p30">
            <div class="col-lg-6 col-md-7 cat-filter-sidebar">
                <aside class="filter filter--cat-one">
                    <div class="filter__category">
                        <form class="margin_bottom_70 relative" action="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}} @endif">
                            @csrf
                            <div class="filter__category-search">
                                <input type="text" name="title" class="form-control control-search des-font"/>
                                <button class="button_search" type="submit"><i class="ti-search"></i></button>
                            </div>
                        </form>

                        {{--            <form method="get" action="search/">--}}
                        {{--                @csrf--}}
                        {{--                        <div class="filter__category-search">--}}
                        {{--                            <input type="text" name="title" placeholder="جستجو بین مطالب ">--}}
                        {{--                          <button type="submit"> <i class="icon-search"></i></button>--}}
                        {{--                        </div>--}}
                        {{--            </form>--}}
                        <div class="filter__category-content">
                            <h2>دسته بندی مطالب</h2>
                            <div class="filter__category-items" style="height: 216px;">

                                @include('partials.blogCategoryMenu',['categories'=>$categories])

                            </div>
                            <span class="filter__category-more">
                <i class="icon-pluse"></i>
                <span>مشاهده بیشتر</span>
            </span>
                        </div>

                    </div>
                </aside>
                <i class="icon-close close"></i>
            </div>

            <div class="col-lg-18 col-md-17">

                @foreach($posts as $post)
                    <div class="product-info">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 pl39">
                                    <div class="product-info__image">
                                        <div class="swiper-container ">
                                            <div class="swiper-wrapper">
                                                @if($post->photo_id)
                                                    @if($post->photo->extension == 'mp4' || $post->photo->extension == '')
                                                        <video width="100%" oncontextmenu="return false;" id="myVideo"
                                                               autoplay controls controlsList="nodownload">
                                                            <source src="{{$post->photo->path}}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <div class="swiper-slide">
                                                            <figure>
                                                                <img src="{{$post->photo->path}}" alt="blog">
                                                            </figure>
                                                        </div>
                                                    @endif


                                                @else
                                                    <div class="swiper-slide">
                                                        <figure>
                                                            <img src="assets/media/users/nopic.jpg" alt="product">
                                                        </figure>
                                                    </div>

                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-16 col-md-12  pr11">
                                    <div class="product-info__information">
                                        <div class="product-info__information-header">
                                            <div class="product-info__information-name">
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif"
                                                   title="">{{$post->slug}}</a>
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif">
                                                    <h2>{{$post->title}}</h2></a>
                                            </div>
                                            <div class="product-info__information-share">
                                                <div class="share">
                                                    <i class="icon-share"></i>
                                                    <div class="share__social">
                                                        <a href="#" title="">
                                                            <i class="icon-telegram"></i>
                                                        </a>
                                                        <a href="#" title="">
                                                            <i class="icon-whats-app"></i>
                                                        </a>
                                                        <a href="#" title="">
                                                            <i class="icon-facebook"></i>
                                                        </a>
                                                        <a href="#" title="">
                                                            <i class="icon-mail"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div accesskey="heart">
                                                    <i class="icon-heart"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="product-info__information-properties">

                                            <div class="description">
                                                <p>
                                                    {{str_limit($post->description,150)}}
                                                </p>
                                                <br>
                                                <br>
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif"
                                                   class="btn btn-primary">ادامه مطلب</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            {{$posts->links()}}
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
