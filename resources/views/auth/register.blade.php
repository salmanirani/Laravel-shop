@extends('frontend.layout.master')

@section('content')
    <script type="text/javascript">
        var verifyCallback = function (response) {
            alert(response);
        };
        var widgetId1;
        var widgetId2;
        var onloadCallback = function () {
            // Renders the HTML element with id 'example1' as a reCAPTCHA widget.
            // The id of the reCAPTCHA widget is assigned to 'widgetId1'.
            widgetId1 = grecaptcha.render('example1', {
                'sitekey': '6LflD6IcAAAAAGiivRNLi-gqOhDEsrTNR4u2-dZM',
                'theme': 'light'
            });
            // widgetId2 = grecaptcha.render(document.getElementById('example2'), {
            //     'sitekey' : '6LflD6IcAAAAAGiivRNLi-gqOhDEsrTNR4u2-dZM'
            // });
            // grecaptcha.render('example3', {
            //     'sitekey' : '6LflD6IcAAAAAGiivRNLi-gqOhDEsrTNR4u2-dZM',
            //     'callback' : verifyCallback,
            //     'theme' : 'dark'
            // });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer></script>
    @if($theme == 'theme1')

    <main>
        <br>
        <br>
        <br>
        <div class="banner margin_bottom_50">
            <div class="container">
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li class="active"> ثبت نام کنید</li>
                </ul>
            </div>
        </div>

        <form method="post" class="login__form" action="@if(!empty($demo)) {{route('demo.user.register')}} @else  {{route('user.register')}} @endif">
            @csrf
            <div class="container login_page margin_bottom_50 ">
                <form class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 "></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 well">
                        <h3 class="title-font text-center capital margin_bottom_50">ثبت نام</h3>
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <div>{{session('success')}}</div>
                            </div>
                        @endif
                        @if(count($errors)>0)
                            @include('partials.form-error')
                        @endif
                        <div class="form-customer des-font">
                            <div class="form-group">
                                <label for="exampleInputEmail1">نام</label>
                                <input type="text" class="form-control form-account" name="name"
                                       autofocus
                                       placeholder="نام">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">نام خانوادگی</label>
                                <input type="text" class="form-control form-account" name="last_name"
                                       autofocus
                                       placeholder="نام خانوادگی">
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">کدملی</label>--}}
{{--                                <input type="text" class="form-control form-account" name="national_code"--}}
{{--                                       autofocus--}}
{{--                                       placeholder="کدملی">--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">پست الکترونیک</label>
                                <input type="email" class="form-control form-account" name="email"
                                       autofocus
                                       placeholder="پست الکترونیک">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">تلفن همراه</label>
                                <input type="text" class="form-control form-account" name="phone"
                                       autofocus
                                       placeholder="تلفن همراه">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">رمز عبور</label>
                                <input type="password" class="form-control form-account" name="password"
                                       autofocus
                                       placeholder="رمز عبور">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">تکرار رمز عبور</label>
                                <input type="password" class="form-control form-account" name="password-confirm"
                                       autofocus
                                       placeholder=" تکرار رمز عبور">
                            </div>
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <div id="example1"></div>
                                </div>
                            </div>
                            <input type="hidden" name="rols" value="4" style="height:20px" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-button-group mg-top-30 mg-bottom-15">
                                        <button type="submit" class="btn btn-success">
                                            ثبت نام
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="@if(!empty($demo)) {{route('demo.login')}} @else  {{route('login')}} @endif" title="" class="login__form-register">
                                        اگر حساب کاربری دارید وارد شوید
                                    </a>
                                    <input type="hidden"  name="demo" value="@if(!empty($demo)) {{$demo}}  @endif"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
    </main>

    @elseif($theme == 'theme2')

    @endif
@endsection
@section('script-vuejs')
    <script src="{{asset('admin/js/app.js')}}"></script>
@endsection
