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
                        @if(Session::has('success'))
                            <br/>
                            <div class="alert alert-success">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                        <form method="post" action="{{route('profile.updateProfile',['id'=>$user->id])}}" class="login__form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="address" class="login__form-label">
                                        نام
                                    </label>
                                    <input id="name" type="text" placeholder="نام" value="{{$user->name}}" class="form-control " name="name" required
                                           autofocus>

                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="login__form-label">
                                        نام خانوادگی
                                    </label>
                                    <input id="last_name" type="text" placeholder="نام خانوادگی" value="{{$user->last_name}}" class="form-control "
                                           name="last_name"
                                           required>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <label for="address" class="login__form-label">
                                    شماره همراه
                                </label>
                                <input id="phone" disabled="disabled" type="text" placeholder="شماره همراه"  value="{{$user->phone}}" class="form-control " name="phone"
                                       required>
                            </div>
                            <div class="login__form-btn">


                                <input type="submit" value="ویرایش پروفایل" class="btn btn-success"/>

                            </div>


                        </form>

                    </section>

                </div>
            </div>

    </main>


@endsection
