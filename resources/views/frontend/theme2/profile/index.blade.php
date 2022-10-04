@extends('frontend.layout.master')

@section('content')

    <main class="main">
        <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">داشبورد<span>فروشگاه</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif">خانه</a></li>
                    <li class="breadcrumb-item"><a href="#">فروشگاه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content" id="app">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        <aside class="col-md-4 col-lg-3">
                            <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                       href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                       aria-selected="true">داشبورد</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders"
                                       role="tab" aria-controls="tab-orders" aria-selected="false">سفارشات</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address"
                                       role="tab" aria-controls="tab-address" aria-selected="false">آدرس</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-wishlists-link" data-toggle="tab" href="#tab-wishlists"
                                       role="tab" aria-controls="tab-wishlists" aria-selected="false">لیست علاقمندی ها</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                       role="tab" aria-controls="tab-account" aria-selected="false">جزئیات حساب
                                        کاربری</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="@if(!empty($demo))  {{route('demo.logout')}} @else  {{route('logout')}} @endif">خروج از حساب کاربری</a>
                                </li>
                            </ul>
                        </aside><!-- End .col-lg-3 -->

                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel"
                                     aria-labelledby="tab-dashboard-link">
                                    <p>سلام <span
                                                class="font-weight-normal text-dark">{{$user->name.' '.$user->last_name}}</span>
                                        <br>
                                        شما در اینجا میتوانید <a href="#tab-orders"
                                                                 class="tab-trigger-link link-underline">سفارشات خود را
                                            ببینید</a>، وضعیت
                                        <a href="#tab-address" class="tab-trigger-link">
                                            آدرس خود را تغییر دهید</a>، و همچنین <a href="#tab-account"
                                                                                    class="tab-trigger-link">می توانید
                                            رمز عبور یا جزئیات حساب کاربری خود را
                                            ویرایش کنید </a>.
                                    <div class="profile-card__edit" align="left">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <form id="logout-form" action="logout" method="POST">
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
                                    @if(Session::has('danger'))
                                        <br/>
                                        <div class="alert alert-danger">
                                            <p>{{session('danger')}}</p>
                                        </div>
                                        @endif
                                        </p>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-orders" role="tabpanel"
                                     aria-labelledby="tab-orders-link">
                                    <p>

                                    <table class="table table-striped- table-bordered table-hover table-checkable"
                                           id="kt_table_1">
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
                                                <td>
                                                    <a href="@if(!empty($demo))  {{route('demo.profile.orders.lists',['id'=>$order->id])}} @else  {{route('profile.orders.lists',['id'=>$order->id])}} @endif">{{$order->id}}</a>
                                                </td>
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
                                                <td><a href="@if(!empty($demo))  {{route('demo.profile.orders.lists',['id'=>$order->id])}} @else  {{route('profile.orders.lists',['id'=>$order->id])}} @endif"
                                                       class="btn btn-success">فاکتور</a></td>
                                            </tr>

                                        @endforeach


                                    </table>
                                    {{$orders->links('pagination::bootstrap-4')}}


                                    </p>
                                    <a href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif" class="btn btn-outline-primary-2"><span>رفتن به
                                                فروشگاه</span><i class="icon-long-arrow-left"></i></a>
                                </div><!-- .End .tab-pane -->
 <div class="tab-pane fade" id="tab-wishlists" role="tabpanel"
                                     aria-labelledby="tab-wishlists-link">
                                    <p>

                                    <table class="table table-striped- table-bordered table-hover table-checkable "
                                           id="kt_table_1">
                                        <thead>
                                        <tr>
                                            <th align="center">شناسه</th>
                                            <th align="center">نام محصول</th>
                                            <th align="center">عکس محصول</th>
                                            <th align="center">امکانات</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($wishlists as $wish)
                                            <tr>
                                                <td align="center">{{$wish->id}}</td>
                                                <td align="center">
                                                    <a href="@if(!empty($demo))  {{route('demo.product.single',$wish->product->slug)}} @else  {{route('product.single',$wish->product->slug)}} @endif">{{$wish->product->title}}</a>

                                                </td>
                                                <td align="center">
                                                    <a href="@if(!empty($demo))  {{route('demo.product.single',$wish->product->slug)}} @else  {{route('product.single',$wish->product->slug)}} @endif">
                                                        <img src="https://ishopsaz.com{{$wish->product->photos[0]->path}}"
                                                             alt="product desc" width="10%">
                                                        </a>

                                                </td>
                                                <td><a href="@if(!empty($demo))  {{route('demo.frontend.removeWishlist',$wish->product->id)}} @else  {{route('frontend.removeWishlist',$wish->product->id)}} @endif" class="btn btn-danger">حذف</a> </td>
                                            </tr>

                                        @endforeach


                                    </table>
                                    {{$wishlists->links('pagination::bootstrap-4')}}


                                    </p>
                                    <a href="@if(!empty($demo))  {{route('demo.home')}} @else  {{route('home')}} @endif" class="btn btn-outline-primary-2"><span>رفتن به
                                                فروشگاه</span><i class="icon-long-arrow-left"></i></a>
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-address" role="tabpanel"
                                     aria-labelledby="tab-address-link">
                                    <p>آدرسی که اینجا ثبت می کنید به صورت پیش فرض برای ارسال محصولات به شما استفاده
                                        می شود.</p>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card card-dashboard">
                                                <div class="card-body">
                                                    <h3 class="card-title">آدرس جدید</h3><!-- End .card-title -->

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
                                                    <form method="post" action="@if(!empty($demo))  {{route('demo.address.store')}} @else  {{route('address.store')}} @endif"
                                                          class="login__form">
                                                        @csrf
                                                        <label for="address" class="login__form-label">
                                                            آدرس خود را وارد کنید
                                                        </label>
                                                        <input id="address" type="text"
                                                               placeholder="آدرس خود را وارد کنید" class="form-control "
                                                               name="address" required autofocus>
                                                        <label for="postal_code" class="login__form-label">
                                                            کدپستی خود را وارد کنید
                                                        </label>
                                                        <input id="post_code" type="text"
                                                               placeholder="کدپستی را وارد نمایید" class="form-control"
                                                               name="post_code" required>
                                                        <label for="postal_code" class="login__form-label">
                                                            نام شرکت را وارد کنید
                                                        </label>
                                                        <input id="company" type="text" placeholder="توضیحات"
                                                               class="form-control" name="company">

                                                        <select-city-component-frontend></select-city-component-frontend>

                                                        <div class="login__form-btn">


                                                            <input type="submit" value=" ثبت آدرس"
                                                                   class="btn btn-success"/>

                                                        </div>


                                                    </form>
                                                    @if(!empty($addresses[0]->address))
                                                        <br/>
                                                        <br/>
                                                        <hr/>
                                                        <h3 class="card-title">لیست آدرس های شما</h3>
                                                        <!-- End .card-title -->

                                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                                               id="kt_table_1">
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
                                                                    <td>
                                                                        <a href="@if(!empty($demo))  {{route('demo.profile.orders.lists',['id'=>$address->id])}} @else  {{route('profile.orders.lists',['id'=>$address->id])}} @endif">{{$address->id}}</a>
                                                                    </td>
                                                                    <td> {{$address->user->addresses[0]->province->name}} </td>
                                                                    <td> {{$address->user->addresses[0]->city->name}} </td>
                                                                    <td>{{$address->address}} </td>

                                                                    <td>{{\Hekmatinasser\Verta\Verta::instance($address->created_at)}}</td>
                                                                    <td>
                                                                        <form class="kt-form" method="post"
                                                                              action="{{route('address.destroy',$address->id)}}">
                                                                            @csrf
                                                                            <input type="hidden" name="_method"
                                                                                   value="DELETE">
                                                                            <button type="submit"
                                                                                    class="btn btn-danger ">حذف
                                                                            </button>

                                                                        </form>
                                                                    </td>


                                                                </tr>

                                                            @endforeach


                                                        </table>

                                                    @endif
                                                </div><!-- End .card-body -->
                                            </div><!-- End .card-dashboard -->
                                        </div><!-- End .col-lg-12 -->
                                    </div><!-- End .row -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                     aria-labelledby="tab-account-link">
                                    @if(Session::has('success'))
                                        <br/>
                                        <div class="alert alert-success">
                                            <p>{{session('success')}}</p>
                                        </div>
                                    @endif
                                    <form method="post" action="@if(!empty($demo))  {{route('demo.profile.updateProfile',['id'=>$user->id])}} @else  {{route('profile.updateProfile',['id'=>$user->id])}} @endif" class="login__form">
                                        @csrf                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>نام *</label>
                                                <input type="text" placeholder="نام" value="{{$user->name}}" class="form-control " name="name">
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>نام خانوادگی *</label>
                                                <input type="text" class="form-control" value="{{$user->last_name}}" class="form-control "
                                                       name="last_name" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <label>شماره همراه</label>
                                        <input type="text" class="form-control" name="phone" required placeholder="شماره همراه"  value="{{$user->phone}}" >

<div align="right">
                                        <label>ایمیل </label>
                                        {{$user->email}}
</div>
                                        <button type="submit" class="btn btn-outline-primary-2 float-right">
                                            <span>ویرایش تغییرات</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>
                                    </form>
                                        <br/>
                                        <br/>
                                        @if(Session::has('danger'))
                                            <br/>
                                            <div class="alert alert-danger">
                                                <p>{{session('danger')}}</p>
                                            </div>
                                        @endif
                                        <form method="post" action="@if(!empty($demo))  {{route('demo.profile.editPassword')}} @else  {{route('profile.editPassword')}} @endif" class="login__form">
                                            @csrf
                                        <label>پسورد فعلی</label>
                                        <input type="password" name="old_password" class="form-control">

                                        <label>پسورد جدید</label>
                                        <input type="password" name="new_password" class="form-control">

                                        <label>تکرار پسورد جدید</label>
                                        <input type="password" name="re_new_password" class="form-control mb-2">

                                        <button type="submit" class="btn btn-outline-primary-2 float-right">
                                            <span>ذخیره تغییرات</span>
                                            <i class="icon-long-arrow-left"></i>
                                        </button>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->





@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
