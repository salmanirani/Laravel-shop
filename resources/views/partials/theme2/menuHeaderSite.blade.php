<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if(!empty($product['data']['title']))
        <title>{{$setting[0]['title'].'-'.$product['data']['title']}}</title>

    @else
        <title>{{$setting[0]['title']}}</title>

    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$setting[0]['title']}}">
    <meta name="description" content="{{$setting[0]['title']}}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.ishopsaz.com{{$logo}}">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.ishopsaz.com{{$logo}}">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.ishopsaz.com{{$logo}}">
    <link rel="manifest" href="{{asset('theme/theme2/assets/images/icons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('theme/theme2/assets/images/icons/safari-pinned-tab.svg')}}" color="#666666">
    <link rel="shortcut icon" href="{{asset('theme/theme2/assets/images/icons/favicon.ico')}}">
    <meta name="apple-mobile-web-app-title" content="{{$setting[0]['title']}}">
    <meta name="application-name" content="{{$setting[0]['title']}}">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{asset('theme/theme2/assets/images/icons/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet"
          href="{{asset('theme/theme2/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/plugins/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/skins/skin-demo-6.css')}}">
    <link rel="stylesheet" href="{{asset('theme/theme2/assets/css/demos/demo-6.css')}}">
    @php
        echo $setting[0]['goftino'];
    @endphp
    <meta name="google-site-verification" content="ZwuyDAjPN0fkpZzgJNTLktMoKCI4hq8YpZYikG1662A"/>
</head>

<body>
<div class="page-wrapper">
    <header class="header header-6">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <ul class="top-menu top-link-menu d-none d-md-block">
                        <li>
                            <a href="#">لینک ها</a>
                            <ul>
                                <li><a href="tel://{{$shopTable['phone']}}"><i class="icon-phone"></i>تلفن تماس
                                        : {{$shopTable['phone']}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-left -->

                <div class="header-right">
                    <div class="social-icons social-icons-color">
                        @if(!empty($setting[0]['facebook']))
                            <a href="{{$setting[0]['facebook']}}" class="social-icon social-facebook" title="فیسبوک"
                               target="_blank"><i
                                        class="icon-facebook-f"></i></a>
                        @endif
                        @if(!empty($setting[0]['twitter']))

                            <a href="{{$setting[0]['twitter']}}" class="social-icon social-twitter" title="توییتر"
                               target="_blank"><i
                                        class="icon-twitter"></i></a>
                        @endif
                        @if(!empty($setting[0]['youtube']))

                            <a href="{{$setting[0]['youtube']}}" class="social-icon social-pinterest" title="یوتیوب"
                               target="_blank"><i
                                        class="icon-youtube"></i></a>
                        @endif

                        @if(!empty($setting[0]['instagram']))

                            <a href="{{$setting[0]['instagram']}}" class="social-icon social-instagram"
                               title="اینستاگرام" target="_blank"><i
                                        class="icon-instagram"></i></a>
                        @endif

                    </div><!-- End .soial-icons -->
                    <ul class="top-menu top-link-menu">
                        <li>
                            <a href="#">لینک ها</a>
                            <ul>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <li><a href="@if(!empty($demo))  {{route('demo.user.profile')}} @else  {{route('user.profile')}} @endif"><i class="icon-user"></i>پروفایل</a>
                                    </li>
                                @else

                                    <li><a href="@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif"><i class="icon-user"></i>ورود</a>
                                    </li>
                                @endif

                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->


                </div><!-- End .header-right -->
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>


                        <form action="@if(!empty($demo))  {{route('demo.frontend.search')}} @else  {{route('frontend.search')}} @endif" method="get" id="searchform" >
                        @csrf

                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">جستجو</label>
                            <button class="btn btn-primary" type="submit" id="searchsubmit"><i class="icon-search"></i>
                            </button>
                            <input type="search" class="form-control" name="q" id="q"
                                   placeholder="جستجوی محصول ..." required>
                        </div><!-- End .header-search-wrapper -->
                        </form>
                    </div><!-- End .header-search -->
                </div>
                <div class="header-center">
                    <a href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif" class="logo">
                        <img src="https://www.ishopsaz.com{{$logo}}" alt="Molla Logo" width="82" height="20">
                    </a>
                </div><!-- End .header-left -->


                <div class="header-right">

                            <a href="@if(!empty($demo))  {{route('demo.user.profile')}} @else  {{route('user.profile')}} @endif" class="wishlist-link">
                                            <i class="icon-heart-o"></i>
                                            <span class="wishlist-count">{{App\Http\Controllers\Backend\WishlistController::getWishLists()}}</span>
                                            <span class="wishlist-txt">علاقه مندی</span>
                                        </a>

                    <div class="dropdown cart-dropdown">
                        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{App\Http\Controllers\Frontend\Carts2Controller::getBasketCount()}}</span>
                            <span class="cart-txt">سبد خرید</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">

                               {{App\Http\Controllers\Frontend\Carts2Controller::showBasket();}}




                            <div class="dropdown-cart-action">
                                <a href="@if(!empty($demo))  {{route('demo.cart.cart')}} @else  {{route('cart.cart')}} @endif"
                                   class="btn btn-primary">مشاهده سبد خرید</a>
                                <a href="@if(!empty($demo))  {{route('demo.cart.cart')}} @else  {{route('cart.cart')}} @endif"
                                   class="btn btn-outline-primary-2"><span>پرداخت</span><i
                                            class="icon-long-arrow-left"></i></a>
                            </div><!-- End .dropdown-cart-total -->
                        </div><!-- End .dropdown-menu -->
                    </div><!-- End .cart-dropdown -->
                </div>
            </div><!-- End .container -->
        </div><!-- End .header-middle -->

        <div class="header-bottom sticky-header">
            <div class="container">
                <div class="header-left">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">

                            <li>
                                <a href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست </a>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">محصولات </a>

                                <ul>
                                    @foreach($mtcategories as $category)
                                        <li class="level3 menu-child-font"><a
                                                    href="@if(!empty($demo))  {{route('demo.category.index',$category['id'])}} @else  {{route('category.index',$category['id'])}} @endif">{{$category['name']}}</a>
                                        </li>
                                    @endforeach
                                    <li><a
                                                href="@if(!empty($demo))  {{route('demo.frontend.allproduct')}} @else  {{route('frontend.allproduct')}} @endif">تمام محصولات</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">بلاگ </a>

                                <ul>
                                    <li><a
                                                href="@if(!empty($demo))  {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}} @endif">آخرین نوشته ها</a>
                                    </li>
                                    @foreach($categoriesBlog as $cat)

                                        <li class="level3 capital menu-child-font"><a
                                                    href="@if(!empty($demo))  {{route('demo.frontend.blogs.blogCat',$cat->id)}} @else  {{route('frontend.blogs.blogCat',$cat->id)}} @endif">{{$cat->title}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li>
                                <a href="#" class="sf-with-ul">صفحات </a>

                                <ul>
                                    @foreach($pages as $page)
                                        <li class="level3 capital menu-child-font"><a
                                                    href="@if(!empty($demo))  {{route('demo.frontend.pages.show',$page['id'])}} @else  {{route('frontend.pages.show',$page['id'])}} @endif">{{$page['title']}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>


                        </ul><!-- End .menu -->
                    </nav><!-- End .main-nav -->

                    <button class="mobile-menu-toggler">
                        <span class="sr-only">فهرست</span>
                        <i class="icon-bars"></i>
                    </button>
                </div><!-- End .header-left -->

                <div class="header-right">
                    <i class="la la-lightbulb-o"></i>
                    <p> {{$setting[0]['description']}}</span></p>
                </div>
            </div><!-- End .container -->
        </div><!-- End .header-bottom -->
    </header><!-- End .header -->
