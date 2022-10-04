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
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                            <tr>
                                <th>شناسه</th>
                                <th>مبلغ</th>
                                <th>وضعیت پرداخت</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت سفارش</th>
                                <th>فاکتور</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{route('profile.orders.lists',['id'=>$order->id])}}">{{$order->id}}</a> </td>
                                    <td>
                                        <div class="kt-widget kt-widget--user-profile-1">
                                            <div class="kt-widget__head">

                                                <div class="kt-widget__content">
                                                    <div class="kt-widget__section">

                                                        {{$order->amount}}


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td>  @if($order->status == 0)
                                            <span class="kt-badge kt-badge--danger kt-badge--inline">پرداخت نشده</span>
                                        @else

                                            <span
                                                class="kt-badge kt-badge--success kt-badge--inline">پرداخت شده</span>
                                        @endif</td>

                                    <td>{{\Hekmatinasser\Verta\Verta::instance($order->created_at)->format('Y/m/d')}}</td>
                                    <td>@if(empty($order->status_orders))
                                            درحال بررسی
                                        @else
                                            {{$order->status_orders }}
                                        @endif</td>
                                    <td><a href="{{route('profile.orders.lists',['id'=>$order->id])}}" class="btn btn-success">فاکتور</a> </td>
                                </tr>

                            @endforeach


                        </table>
{{$orders->links()}}

                    </section>

                </div>
            </div>

    </main>


@endsection
