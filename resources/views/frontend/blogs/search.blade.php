
@extends('frontend.layout.master')

@section('content')
    <main>

        <div class="container blog-page margin_bottom_150">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 sidebar-left">
{{--                    {!! Form::open((['method'=>'GET','action'=>'Frontend\PostController@serachPosts','class'=>'margin_bottom_70 relative'])) !!}--}}
{{--                    <div class="filter__category-search">--}}
{{--                        {!! Form::text('title',null,['class'=>'form-control control-search des-font','placeholder'=>'جستجو']) !!}--}}
{{--                        <button class="button_search" type="submit"><i class="ti-search"></i></button>--}}


{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
                    <form class="margin_bottom_70 relative" action="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}} @endif">
                        @csrf
                        <div class="filter__category-search">
                            <input type="text" name="title" class="form-control control-search des-font"/>
                            <button class="button_search" type="submit"><i class="ti-search"></i></button>
                        </div>
                    </form>


                    <ul class="category margin_bottom_70">

                        <li>
                            <h3 class="title-font ">دسته بندیها</h3>
                        </li>
                        @include('partials.blogCategoryMenu',['categories'=>$categories])


                    </ul>
                    <ul class="post margin_bottom_70">
                        <li>
                            <h1 class="title-font title">نوشته های اخیر</h1>
                        </li>
                        @foreach($last as $post)

                        <li class="clearfix margin_bottom_20">
                            <div class="column-40 left">
                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif" class="inline-block over-hidden">
                                    @if($post->photo->id)
                                        <img  src="https://www.ishopsaz.com{{$post->photo->path}}" class="img-responsive hover-zoom-out" width="100px" alt="">
                                    @else
                                        <img src="asset/img/post-sidebar1.jpg" class="img-responsive hover-zoom-out" alt="">
                                    @endif

                                   </a>
                            </div>
                            <div class="column-60 left">
                                <h4 class="menu-font post-name"><a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif" class="link-default">{{$post->title}}</a></h4>
                                <p class="des-font post-day">{{\Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y-n-j')}}</p>
                            </div>
                        </li>
                       @endforeach
                    </ul>


                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content-blog">
                    <div class="row">
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 space_right_10 ">
                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif" class="inline-block over-hidden"><img  src="https://www.ishopsaz.com{{$post->photo->path}}" class="img-responsive hover-zoom-out" width="150px" alt=""></a>
                                <p class="des-font des-post">
                                    <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.show',$post->slug)   }} @else  {{route('frontend.blogs.show',$post->slug)   }} @endif" > {{$post->title}}</a>
                                </p>
                            </div>
                        @endforeach


                    </div>

                    <!--  -->
                    <div class="row">
                        <div class="col-md-12">
                            {{$posts->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
<style>
    img{
        width: 80%;
        max-height: 300px;
        border-radius: 10%;
    }

</style>

@endsection
