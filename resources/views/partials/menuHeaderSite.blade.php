<!DOCTYPE html>
<html>
<head>
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="icon" href="https://www.ishopsaz.com{{$logo}}" type="image/x-icon" />
    <link rel=" stylesheet
    " type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/zoa-font.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/font-family.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/style-main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('asset/css/responsive.css')}}">
   @if(!empty($setting[0]['title']))


    @if(!empty($product['data']['title']))
        <title>{{$setting[0]['title'].'-'.$product['data']['title']}}</title>

    @else
        <title>{{$setting[0]['title']}}</title>
    @endif

    @endif
    <meta name="description" content="@if(empty($setting[0]['title']))
   No setting set
       @else{{$setting[0]['title']}} @endif"/>
    <meta name="keywords" content="@if(empty($setting[0]['title']))
   No setting set
       @else{{$setting[0]['title']}}@endif"/>
    @if(!empty($setting[0]['goftino']))
        @php
            echo $setting[0]['goftino'];
        @endphp
    @endif

    <meta name="google-site-verification" content="ZwuyDAjPN0fkpZzgJNTLktMoKCI4hq8YpZYikG1662A"/>
</head>

<body>
<!-- push menu-->
<div class="pushmenu menu-home5">
    <div class="menu-push">
        <span class="close-left js-close"><i class="ti-close"></i></span>
        <div class="clearfix"></div>
        <form  method="get" id="searchform" class="searchform title-font"
              action="@if(!empty($demo)) {{route('demo.frontend.search')}} @else {{route('frontend.search')}} @endif">
            @csrf

            <div>
                <label class="screen-reader-text" for="q"></label>
                <input type="text" placeholder="جستجو در میان محصولات ..." value="" name="q" id="q" autocomplete="off">
                <button type="submit" id="searchsubmit"><i class="ti-search"></i></button>
            </div>
        </form>
        <ul class="nav-home5 js-menubar clear-space menu-font">
            <li class="level1 active ">
                <a href="@if(!empty($demo)) {{route('demo.home')}} @else {{route('home')}} @endif" class="uppercase">صفحه نخست</a>

            </li>
            <li class="level1 active dropdown"><a href="#" class="uppercase">دسته بندی</a>
                <span class="icon-sub-menu"></span>
                <div class="menu-level1 js-open-menu">
                    <ul class="level1">
                        <li class="level2">
                            <ul class="menu-level-2 clear-space">

                                @foreach($mtcategories as $category)
                                    <li class="level3 menu-child-font"><a
                                                href="@if(!empty($demo)) {{route('demo.category.index',$category['id'])}} @else {{route('category.index',$category['id'])}} @endif">{{$category['name']}}</a>
                                    </li>
                                @endforeach
                                <li class="level3 menu-child-font"><a
                                            href="@if(!empty($demo)) {{route('demo.frontend.allproduct')}} @else {{route('frontend.allproduct')}} @endif">تمام محصولات</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>
            </li>
            <li class="level1 active dropdown">
                <a href="#" class="uppercase">صفحات</a>
                <span class="icon-sub-menu"></span>
                <div class="menu-level1 js-open-menu">
                    <ul class="level1">
                        <li class="level2">
                            <ul class="menu-level-2 clear-space">

                                @foreach($pages as $page)
                                    <li class="level3 capital menu-child-font"><a
                                                href="@if(!empty($demo)) {{route('demo.frontend.pages.show',$page['id'])}} @else {{route('frontend.pages.show',$page['id'])}} @endif">{{$page['title']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="level1 active dropdown">
                <a href="#" class="uppercase">بلاگ</a>
                <span class="icon-sub-menu"></span>
                <div class="menu-level1 js-open-menu">
                    <ul class="level1">
                        <li class="level2">
                            <ul class="menu-level-2 clear-space">
                                <li class="level3 capital menu-child-font"><a
                                            href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else {{route('frontend.blogs.search')}} @endif">آخرین نوشته ها</a>
                                </li>
                                @foreach($categoriesBlog as $cat)

                                    <li class="level3 capital menu-child-font"><a
                                                href="@if(!empty($demo)) {{route('demo.frontend.blogs.blogCat',$cat->id)}} @else {{route('frontend.blogs.blogCat',$cat->id)}} @endif">{{$cat->title}}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>

                    </ul>
                </div>
            </li>


            <li>
                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else {{route('frontend.blogs.search')}} @endif" class="inline-block uppercase">نوشته ها</a>
            </li>
            <li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    <a href="@if(!empty($demo))  {{route('demo.user.profile')}}  @else {{route('user.profile')}} @endif" class="inline-block uppercase"><i
                                class="zoa-icon-user space_right_10"></i>پروفایل کاربری</a>
                @else
                    <a href="@if(!empty($demo))  {{route('demo.login')}}  @else {{route('login')}} @endif" class="inline-block uppercase"><i
                                class="zoa-icon-user space_right_10"></i>ثبت نام | ورود</a>

                @endif
            </li>
        </ul>
    </div>
</div>
<!-- end push menu-->
<header class="">
    <div class="container space_top_bot_55 delay03" id="menu-header">
        <div class="row flex">
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-5">
                <a href="@if(!empty($demo)) {{route('demo.home')}} @else {{route('home')}}  @endif">
                    @if(!empty($setting[0]->shop->photo->path))
                    <img src="https://www.ishopsaz.com{{$setting[0]->shop->photo->path}}"
                                                 alt="" width="100%">
                @endif
                </a>
            </div>
            <div class="col-lg-8 col-md-7 hidden-sm hidden-xs">
                <ul class="nav navbar-nav menu-font menu-main menu-home2">
                    <li class="relative dropdown">
                        <a href="@if(!empty($demo)) {{route('demo.home')}} @else {{route('home')}}  @endif" class="link-menu delay03 uppercase">صفحه نخست</a>
                        <figure class="line active_line absolute delay03"></figure>
                    </li>
                    <li class="relative dropdown">
                        <a href="#" class="link-menu delay03 uppercase">محصولات</a>
                        <figure class="line absolute delay03"></figure>
                        {{--                        <div class="dropdown-menu mega-menu-main absolute space_30 space_top_bot_50 text-left mega-menu-shop">--}}
                        <div class="dropdown-menu mega-menu-main absolute space_30 space_top_bot_50 text-left"
                             style="min-width: 350px !important;">

                            <div class="container_15">
                                <div class="row">
                                    <div class="col-lg-12 col-md-4 ">
                                        <ul class="clear-space capital lv1">
                                            {{--                                            <li class="margin_bottom_20 space_left_20 uppercase">دسته بندی محصولات</li>--}}
                                            <li class="level3 menu-child-font"><a
                                                        href="@if(!empty($demo)) {{route('demo.frontend.allproduct')}} @else {{route('frontend.allproduct')}}  @endif">تمام محصولات</a>
                                            </li>
                                            @foreach($mtcategories as $category)
                                                <li class="level3 menu-child-font"><a
                                                            href="@if(!empty($demo)) {{route('demo.category.index',$category['id'])}} @else {{route('category.index',$category['id'])}} @endif">{{$category['name']}}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>


                                    <!--  -->
                                    <!--  -->

                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="relative dropdown">
                        <a href="#" class="link-menu delay03 uppercase">صفحات</a>
                        <figure class="line absolute delay03"></figure>
                        <div class="dropdown-menu mega-menu-main absolute space_30 space_top_bot_50 text-left"
                             style="min-width: 350px !important;">
                            <div class="container_15">
                                <div class="row">
                                    <div class="col-lg-12 col-md-4 ">
                                        <ul class="clear-space capital lv1">
                                            @foreach($pages as $page)
                                                <li><a class="menu-child-font"
                                                       href="@if(!empty($demo)) {{route('demo.frontend.pages.show',$page['id'])}} @else {{route('frontend.pages.show',$page['id'])}} @endif">{{$page['title']}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="relative dropdown">
                        <a href="#" class="link-menu delay03 uppercase">بلاگ</a>
                        <figure class="line absolute delay03"></figure>
                        <div class="dropdown-menu mega-menu-main absolute space_30 space_top_bot_50 text-left"
                             style="min-width: 350px !important;">
                            <div class="container_15">
                                <div class="row">
                                    <div class="col-lg-12 col-md-4 ">
                                        <ul class="clear-space capital lv1">
                                            <li class="relative">
                                                <a href="@if(!empty($demo)) {{route('demo.frontend.blogs.search')}} @else {{route('frontend.blogs.search')}} @endif" class="menu-child-font">آخرین
                                                    نوشته ها</a>
                                            </li>
                                            @foreach($categoriesBlog as $cat)
                                                <li><a class="menu-child-font"
                                                       href="@if(!empty($demo)) {{route('demo.frontend.blogs.blogCat',$cat->id)}}@else {{route('frontend.blogs.blogCat',$cat->id)}} @endif">{{$cat->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="relative dropdown">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="@if(!empty($demo)) {{route('demo.user.profile')}} @else {{route('user.profile')}} @endif" class="link-menu delay03 uppercase">پروفایل کاربری</a>
                        @else
                            <a href="@if(!empty($demo)) {{route('demo.login')}} @else {{route('login')}} @endif" class="link-menu delay03 uppercase">ثبت نام | ورود</a>

                        @endif



                    </li>

                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-7 text-right icon-main">
                <a href="#" class="link-menu delay03 container_20 inline-block hidden-xs hidden-sm" id="btn-search"><i
                            class="ti-search"></i></a>

                @if(\Illuminate\Support\Facades\Auth::check())
                    <a href="@if(!empty($demo)) {{route('demo.user.profile')}} @else {{route('user.profile')}} @endif"
                       class="link-menu delay03 container_20 inline-block hidden-xs hidden-sm" id="btn-login"><i
                                class="zoa-icon-user"></i></a>
                @else
                    <a href="@if(!empty($demo))  {{route('demo.login')}}  @else {{route('login')}} @endif" class="link-menu delay03 container_20 inline-block hidden-xs hidden-sm"
                       id="btn-login"><i class="zoa-icon-user"></i></a>

                @endif

{{--                <a href="@if(Session::has('cart')) {{route('cart.cart')}} @else {{route('login')}} @endif"--}}
                <a href="@if(App\Http\Controllers\Frontend\Carts2Controller::getBasketCount()>0) @if(!empty($demo)) {{route('demo.cart.cart')}} @else {{route('cart.cart')}} @endif @else @if(!empty($demo))  {{route('demo.home')}}  @else {{route('login')}} @endif @endif"
                   class="link-menu delay03 container_20 relative inline-block text-center" id="btn-login">
                    <i class="ti-bag"></i>
                    <figure class="absolute label-cart number-font">{{App\Http\Controllers\Frontend\Carts2Controller::getBasketCount()}}</figure>
                </a>
                <a href="#" class="link-menu delay03 inline-block hidden-md hidden-lg space_left_10 btn-push-menu">
                    <svg width="26" height="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px"
                         y="0px" viewBox="0 0 66 41" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
							<g>
                                <line class="st0" x1="1.5" y1="1.5" x2="64.5" y2="1.5"></line>
                                <line class="st0" x1="1.5" y1="20.5" x2="64.5" y2="20.5"></line>
                                <line class="st0" x1="1.5" y1="39.5" x2="64.5" y2="39.5"></line>
                            </g>
						</svg>
                </a>
            </div>
        </div>
    </div>
</header>
