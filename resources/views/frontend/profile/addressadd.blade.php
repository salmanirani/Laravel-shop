@extends('frontend.layout.master')
@section('content')

    <div>

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
        <div class=" " id="app">
            <div class="row p30">

                <div class="col-md-6">
                    @if(count($errors)>0)
                        @include('partials.form-error')
                    @endif
                        @if(Session::has('delete'))
                            <br/>
                            <div class="alert alert-danger">
                                <p>{{session('delete')}}</p>
                            </div>
                        @endif
                        @if(Session::has('success'))
                            <br/>
                            <div class="alert alert-success">
                                <p>{{session('success')}}</p>
                            </div>
                        @endif
                    <form method="post" action="@if(!empty($demo)) {{route('demo.address.store')}} @else  {{route('address.store')}} @endif" class="login__form">
                        @csrf
                        <label for="address" class="login__form-label">
                            آدرس خود را وارد کنید
                        </label>
                        <input id="address" type="text" placeholder="آدرس خود را وارد کنید" class="form-control " name="address"  required  autofocus>
                        <label for="postal_code" class="login__form-label">
                            کدپستی خود را وارد کنید
                        </label>
                        <input id="post_code" type="text"  placeholder="کدپستی را وارد نمایید"  class="form-control" name="post_code" required >
                        <label for="postal_code" class="login__form-label">
                            نام شرکت را وارد کنید
                        </label>
                        <input id="company" type="text"  placeholder="توضیحات"  class="form-control" name="company"  >

                        <select-city-component-frontend></select-city-component-frontend>

                        <div class="login__form-btn">


                            <input type="submit"  value=" ثبت آدرس" class="btn btn-success"/>

                        </div>


                    </form>


                </div>

            </div>
        </div>


</section></div>
    </div>







    </div>
    </div>
    </div>

@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
