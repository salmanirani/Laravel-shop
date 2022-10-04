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
            widgetId1 = grecaptcha.render('googleAut', {
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
                        <li class="active">وارد شوید یا ثبت نام کنید</li>
                    </ul>
                </div>
            </div>
            <form method="POST" action="@if(!empty($demo)) {{route('demo.user.login')}} @else  {{route('login')}} @endif" class="login__form">
                @csrf
                <div class="container login_page margin_bottom_50 ">
                    <form class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 "></div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 well">
                            <h3 class="title-font text-center capital margin_bottom_50">ورود به حساب</h3>
                            @if(Session::has('warning'))

                                <div class="alert alert-success">
                                    <p>{{session('warning')}}</p>
                                </div>
                            @elseif(Session::has('danger'))

                                <div class="alert alert-danger">
                                    <p>{{session('danger')}}</p>
                                </div>
                            @endif
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
                                    <label for="exampleInputEmail1">ایمیل*</label>
                                    <input type="email" class="form-control form-account" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="آدرس ایمیل*">
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">رمز عبور*</label>
                                    <input type="password" class="form-control form-account" name="password" required
                                           autocomplete="current-password" placeholder="رمز عبور*">
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <div id="example1"></div>
                                    </div>
                                </div>
                                <div class="flex space_top_bot_30">
                                    @if (Route::has('password.request'))
                                        <a href="@if(!empty($demo)) {{ route('demo.password.request') }} @else  {{ route('password.request') }} @endif" title="" id="RecoverPassword"
                                           class="login__form-remember">رمز عبورم را فراموش کرده‌ام !</a>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-button-group mg-top-30 mg-bottom-15">
                                            <button type="submit" class="btn btn-success">
                                                ورود به حساب
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="@if(!empty($demo))  {{route('demo.register')}}  @else {{route('register')}} @endif" title="" class="login__form-register">
                                            اگر حساب کاربری ندارید
                                            <span class="btn btn-primary">ثبت نام</span>
                                            کنید
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>


                </div>
                </div>


        </main>
    @elseif($theme == 'theme2')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                        <li class="breadcrumb-item"><a href="#">صفحات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ورود / ثبت نام</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
                 style="background-image: url({{asset('theme/theme2/assets/images/backgrounds/login-bg.jpg')}})">
                <div class="container">
                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab-2" data-toggle="tab" href="#signin-2"
                                       role="tab"
                                       aria-controls="signin-2" aria-selected="true">ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="register-tab-2" data-toggle="tab" href="#register-2"
                                       role="tab" aria-controls="register-2" aria-selected="false">ثبت نام</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="signin-2" role="tabpanel"
                                     aria-labelledby="signin-tab-2">
                                    @if(Session::has('warning'))

                                        <div class="alert alert-success" align="center">
                                            <p>{{session('warning')}}</p>
                                        </div>
                                    @elseif(Session::has('danger'))

                                        <div class="alert alert-danger" align="center">
                                            <p>{{session('danger')}}</p>
                                        </div>
                                    @endif
                                    @if(Session::has('success'))
                                        <div class="alert alert-success" align="center">
                                            <div>{{session('success')}}</div>
                                        </div>
                                    @endif
                                    @if(count($errors)>0)
                                        @include('partials.form-error')
                                    @endif
                                    <form method="POST" action="{{ route('login') }}" class="login__form" >
                                        @csrf

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="form-group">
                                            <label for="singin-email-2">نام کاربری یا آدرس ایمیل *</label>
                                            <input type="text" class="form-control" id="singin-email-2"
                                                   name="email"
                                                   value="{{ old('email') }}" required>
                                        </div><!-- End .form-group -->
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                        <div class="form-group">
                                            <label for="singin-password-2">رمز عبور *</label>
                                            <input type="password" class="form-control" id="singin-password-2"
                                                   name="password" required>
                                        </div><!-- End .form-group -->
                                        <div class="row">
                                            <div class="col-md-12" align="center">
                                                <div id="example1"></div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ورود</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="signin-remember-2">
                                                <label class="custom-control-label" for="signin-remember-2">مرا به خاطر
                                                    بسپار</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="{{ route('password.request') }}" class="forgot-link">رمز عبور خود
                                                را فراموش کرده اید؟</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    {{--                                    <div class="form-choice">--}}
                                    {{--                                        <p class="text-center">یا ورود با </p>--}}
                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-sm-6">--}}
                                    {{--                                                <a href="#" class="btn btn-login btn-g">--}}
                                    {{--                                                    <i class="icon-google"></i>--}}
                                    {{--                                                    حساب کاربری گوگل--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div><!-- End .col-6 -->--}}
                                    {{--                                            <div class="col-sm-6">--}}
                                    {{--                                                <a href="#" class="btn btn-login btn-f">--}}
                                    {{--                                                    <i class="icon-facebook-f"></i>--}}
                                    {{--                                                    حساب کاربری فیسبوک--}}
                                    {{--                                                </a>--}}
                                    {{--                                            </div><!-- End .col-6 -->--}}
                                    {{--                                        </div><!-- End .row -->--}}
                                    {{--                                    </div><!-- End .form-choice -->--}}
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade " id="register-2" role="tabpanel"
                                     aria-labelledby="register-tab-2">
                                    <form method="post" class="login__form" action="{{ route('user.register') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="register-email-2">نام *</label>
                                            <input type="text" class="form-control" value="{{old('name')}}" id="register-email-2"
                                                   name="name" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email-2">نام خانوادگی *</label>
                                            <input type="text" class="form-control" value="{{old('last_name')}}" id="register-email-2"
                                                   name="last_name" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email-2">کدملی(اختیاری) </label>
                                            <input type="text" class="form-control" value="{{old('national_code')}}" id="register-email-2"
                                                   name="national_code" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email-2">پست الکترونیک *</label>
                                            <input type="email" class="form-control" value="{{old('email')}}" id="register-email-2"
                                                   name="email" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email-2">تلفن همراه *</label>
                                            <input type="text" class="form-control"  value="{{old('phone')}}"id="register-email-2"
                                                   name="phone" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password-2">رمز عبور *</label>
                                            <input type="password" class="form-control" id="register-password-2"
                                                   name="password" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-password-2">تکرار رمز عبور *</label>
                                            <input type="password" class="form-control" id="register-password-2"
                                                   name="password-confirm" required>
                                        </div><!-- End .form-group -->
                                        <div class="row">
                                            <div class="col-md-12" align="center">
                                                <div id="googleAut"></div>
                                            </div>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ثبت نام</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="register-policy-2" required>
                                                <label class="custom-control-label" for="register-policy-2">من با <a
                                                            href="#">قوانین و مقررات</a> موافقم *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
{{--                                    <div class="form-choice">--}}
{{--                                        <p class="text-center">یا ورود با </p>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-sm-6">--}}
{{--                                                <a href="#" class="btn btn-login btn-g">--}}
{{--                                                    <i class="icon-google"></i>--}}
{{--                                                    حساب کاربری گوگل--}}
{{--                                                </a>--}}
{{--                                            </div><!-- End .col-6 -->--}}
{{--                                            <div class="col-sm-6">--}}
{{--                                                <a href="#" class="btn btn-login  btn-f">--}}
{{--                                                    <i class="icon-facebook-f"></i>--}}
{{--                                                    حساب کاربری فیسبوک--}}
{{--                                                </a>--}}
{{--                                            </div><!-- End .col-6 -->--}}
{{--                                        </div><!-- End .row -->--}}
{{--                                    </div><!-- End .form-choice -->--}}
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->

    @endif

@endsection
