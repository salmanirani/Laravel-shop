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
                            <div class="profile-card__avatar"><img src="avatar" alt="" width="20%" align="left"></div>
                            <h2>لیست آدرس ها </h2>
                            <div class="profile-card__email"></div>
                        </header>
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
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>استان</th>
                                <th>شهر</th>
                                <th>آدرس</th>

                                <th>تاریخ ایجاد</th>
                                <th>امکانات</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($addresses as $address)
                                <tr>
                                    <td><a href="{{route('profile.orders.lists',['id'=>$address->id])}}">{{$address->id}}</a> </td>
                                    <td> {{$address->user->addresses[0]->province->name}} </td>
                                    <td> {{$address->user->addresses[0]->city->name}} </td>
                                    <td>{{$address->address}} </td>

                                    <td>{{\Hekmatinasser\Verta\Verta::instance($address->created_at)}}</td>
                                    <td>  <form class="kt-form" method="post" action="{{route('address.destroy',$address->id)}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger ">حذف</button>

                                        </form></td>


                                </tr>

                            @endforeach


                        </table>

                        <a href="@if(!empty($demo)) {{route('demo.address.add')}} @else  {{route('address.add')}} @endif" class="btn btn-success">درج آدرس جدید</a>


                    </section>

                </div>
            </div>

    </main>

@endsection
