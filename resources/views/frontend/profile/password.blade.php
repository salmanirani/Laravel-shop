@extends('frontend.layout.master')
@section('meta')
    <meta name="description" content="تولیدات ملی"/>
    <meta name="keywords" content="تولیدات ملی"/>

@endsection

@section('content')
    <main>

        <div class="banner margin_bottom_50">
            <div class="container">
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li class="active">پروفایل</li>
                </ul>
            </div>
        </div>
        <div class="container blog-page margin_bottom_150 blog-detail-page">
            <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 sidebar-left">

                    <ul class="list-group">

                        <li><a class="list-group-item active" href="@if(!empty($demo))  {{route('demo.user.profile')}}  @else {{route('user.profile')}} @endif"
                               title="">پروفایل</a></li>
                        <li><a class="list-group-item" href="@if(!empty($demo))  {{route('demo.profile.orders')}}  @else {{route('profile.orders')}} @endif"
                               title="">سفارشات</a></li>
                        <li> <a class="list-group-item" href="@if(!empty($demo))  {{route('demo.address.index')}}  @else {{route('address.index')}} @endif" title="">آدرس</a></li>
                        {{--                                <a class="filter__category-item" href="" title="">علاقه مندی ها</a>--}}
                        <li> <a class="list-group-item" href="@if(!empty($demo))  {{route('demo.user.editprofile')}}  @else {{route('user.editprofile')}} @endif" title="">ویرایش
                                پروفایل</a></li>
                        <li><a class="list-group-item" href="@if(!empty($demo))  {{route('demo.profile.showPassword')}}  @else {{route('profile.showPassword')}} @endif" title="">تغییر
                                رمز</a></li>

                    </ul>

                </div>
                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 content-blog-detail">
                    <section class=" des-font day-post well">
                        @if(Session::has('success'))
                            <br/>
                            <div class="alert alert-success">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                            @if(Session::has('danger'))
                            <br/>
                            <div class="alert alert-danger">
                                <p>{{session('danger')}}</p>
                            </div>
                        @endif
                        <form method="post" action="{{route('profile.editPassword')}}" class="login__form">
                            @csrf
                            <div class="col-md-12">
                                <label for="address" class="login__form-label">
                                    رمز فعلی
                                </label>
                                <input id="old_password" type="password" placeholder="رمز فعلی" class="form-control "
                                       name="old_password" required
                                       autofocus>

                            </div>
                            <div class="col-md-12">
                                <label for="address" class="login__form-label">
                                    رمز جدید
                                </label>
                                <input id="new_password" type="password" placeholder="رمز جدید" class="form-control "
                                       name="new_password"
                                       required>
                            </div>


                            <div class="col-md-12">
                                <label for="address" class="login__form-label">
                                    تکرار رمز جدید
                                </label>
                                <input id="re_new_password" type="password" placeholder="تکرار رمز جدید" class="form-control "
                                       name="re_new_password"
                                       required>
                            </div>
                            <div class="login__form-btn">


                                <input type="submit" value="ثبت رمز جدید" class="btn btn-success"/>

                            </div>


                        </form>

                    </section>

                </div>
            </div>

    </main>


@endsection
