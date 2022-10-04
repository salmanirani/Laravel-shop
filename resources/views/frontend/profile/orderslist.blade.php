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

                        <div class="kt-portlet">
                            <div class="kt-portlet__head kt-portlet__head--lg">
                                <div class="kt-portlet__head-label">
			<span class="kt-portlet__head-icon">
				<i class="kt-font-brand flaticon2-line-chart"></i>
			</span>
                                    <h3 class="kt-portlet__head-title">
                                        سفارش شماره {{$order->id}}
                                    </h3>
                                </div>

                            </div>
                            @csrf

                            <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable">
                                    <thead>
                                    <tr>
                                        <th>نام محصول</th>
                                        <th>تعداد</th>
                                        @if($order->products[0]->pivot->size_id != '')

                                            <th>سایز و رنگ</th>
                                        @endif
                                        <th>مبلغ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td> {{$product->title}} </td>
                                            <td>{{$product->pivot->qty}} </td>
                                            @if($product->pivot->size_id)

                                                <td>
                                                    @php
                                                        echo App\Http\Controllers\Frontend\OrderController::showText($product->pivot->size_id);
                                                    @endphp
                                                </td>
                                            @endif

                                            <td>

                                                @if($product->discount_price)
                                                    {{number_format($product->discount_price)}} تومان
                                                @else
                                                    {{number_format($product->price)}}تومان

                                                @endif
                                            </td>
                                        </tr>

                                    @endforeach
                                </table>
                                <hr/>
                                <table class="table table-striped- table-bordered table-hover table-checkable">
                                    <thead>
                                    <tr>
                                        <th>نام خریدار</th>
                                        <th>آدرس خریدار</th>
                                        <th>شماره همراه خریدار:</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="kt-portlet__head-title">{{$order->user->name.' '.$order->user->last_name}} </h5>
                                        </td>
                                        <td>
                                            <h5 class="kt-portlet__head-title">
                                                @if(!empty($order->user->addresses[0]))
                                                    {{$order->user->addresses[0]->province->name.' - '.$order->user->addresses[0]->city->name.'-'.$order->user->addresses[0]->address.'- کدپستی:'.$order->user->addresses[0]->post_code}}</h5>
                                            @endif
                                        </td>
                                        <td><h5 class="kt-portlet__head-title">{{$order->user->phone}}</h5></td>
                                    </tr>

                                </table>
                                <hr/>
                                <table class="table table-striped- table-bordered table-hover table-checkable">
                                    <thead>
                                    <tr>
                                        <th>توضیحات خریدار</th>
                                        <th>نحوه ارسال</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="kt-portlet__head-title">{{$order->note}} </h5>
                                        </td>

                                        <td><h5 class="kt-portlet__head-title">
                                                @if(!empty($postal))
                                                    {{$postal->title}}
                                                @endif
                                            </h5></td>
                                    </tr>

                                </table>
                                <hr/>
                                <table class="table table-striped- table-bordered table-hover table-checkable">
                                    <thead>

                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td> ایمیل خریدار: {{$order->user->email}} </td>
                                        <td> کدملی خریدار: {{$order->user->national_code}} </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> مبلغ کل سفارش:<h3 class="kt-portlet__head-title">
                                                {{number_format($order->amount)}}
                                            </h3> تومان
                                        </td>

                                    </tr>

                                </table>


                            </div>

                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-success">  بازگشت</a>
                        <!-- end:: Content -->                    <!-- end:: Content -->
                </div>

                    </section>

                </div>
            </div>

    </main>





@endsection
