@extends('frontend.layout.master')

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
                        <header class="cat-one-exclusive__header">
                            <div class=""><img src="avatar" alt="" width="20%" align="left"></div>
                            <h2>{{$user->name.' '.$user->last_name}}</h2>

                            <div class="profile-card__email">نام کاربری : {{$user->email}}</div>
                            <div class="address-card__row">
                                <div class="address-card__row-title">موبایل : {{$user->phone}}</div>
                        </header>


                        <div class="profile-card__edit" align="left">
                            <div class="row">
                                <div class="col-md-2">
                                    <form id="logout-form" action="@if(!empty($demo))  {{route('demo.logout')}}  @else {{route('logout')}} @endif" method="POST">
                                        @csrf
                                        <input type="submit" value="خروج" class="btn btn-danger"/>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if(Session::has('success'))
                            <br/>
                            <div class="alert alert-success">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                    </section>

            </div>
        </div>

    </main>





@endsection
