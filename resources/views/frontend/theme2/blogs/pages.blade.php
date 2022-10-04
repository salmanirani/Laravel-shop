@extends('frontend.layout.master')
@section('meta')
{{--    <meta name="description" content="{{$post->meta_description}}"/>--}}
{{--    <meta name="keywords" content="{{$post->meta_keywords}}"/>--}}

@endsection
@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">{{$post->title}}<span>صفحات</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}}  @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}}  @endif">صفحات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$post->title}}</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="about-text text-center mt-3">
                            @if(!empty($post->photo))
                                <img src="https://www.ishopsaz.com{{$post->photo->path}}" class="full-width hover-zoom-out" alt="">

                            @endif
                            <p class="text-center">    {!!  $post->description !!}</p>

                        </div><!-- End .about-text -->
                    </div><!-- End .col-lg-10 offset-1 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-2"></div><!-- End .mb-2 -->


        </div><!-- End .page-content -->
    </main><!-- End .main -->


@endsection
