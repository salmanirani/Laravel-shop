@extends('frontend.layout.master')
@section('meta')
{{--    <meta name="description" content="{{$post->meta_description}}"/>--}}
{{--    <meta name="keywords" content="{{$post->meta_keywords}}"/>--}}

@endsection
@section('content')

    <main>
        <div class="banner margin_bottom_150">
            <div class="container">
                <h3 class="title-font ">نوشته ها</h3>
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}}@endif">نوشته ها</a></li>
                    <li class="active">{{$post->title}}</li>
                </ul>
            </div>
        </div>
        <div class="container blog-page margin_bottom_150 blog-detail-page">
            <div class="row flex">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content-blog-detail">
                    <a href="#" class="inline-block over-hidden">
                        @if(!empty($post->photo))
                            <img src="https://www.ishopsaz.com{{$post->photo->path}}" class="full-width hover-zoom-out" alt="">

                        @endif

                    </a>
{{--                    <h1 class="title-font title-post">{{$post[0]['title']}} </h1>--}}
{{--                    <h1 class="title-font title-post">{{$post->title}} </h1>--}}
{{--                    <p class="day-post des-font">{{\Hekmatinasser\Verta\Verta::instance($post[0]['created_at'])->format('Y-n-j')}}</p>--}}



                    <p >
                        {!!  $post->description !!}
                    </p>


                </div>
            </div>
        </div>
        <!--  -->

    </main>

@endsection
