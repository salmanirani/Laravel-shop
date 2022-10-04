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
    <main>
        <br>
        <br>
        <br>
        <div class="banner margin_bottom_50">
            <div class="container">
                <ul class="breadcrumb des-font">
                    <li><a href="@if(!empty($demo)) {{route('demo.home')}} @else  {{route('home')}} @endif">صفحه نخست</a></li>
                    <li class="active">بازیابی رمز عبور</li>
                </ul>
            </div>
        </div>

        <form method="POST"  action="@if(!empty($demo)) {{route('demo.user.reset')}} @else  {{ route('user.reset') }} @endif" class="login__form">
            @csrf

            <div class="container login_page margin_bottom_50 ">

                <form class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 "></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 well">
                        <h3 class="title-font text-center capital margin_bottom_50">بازیابی رمز عبور</h3>
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                <div>{{session('success')}}</div>
                            </div>
                        @endif
                        @if(Session::has('warning'))

                            <div class="alert alert-success">
                                <p>{{session('warning')}}</p>
                            </div>
                        @elseif(Session::has('danger'))

                            <div class="alert alert-danger">
                                <p>{{session('danger')}}</p>
                            </div>
                        @endif
                        @if(count($errors)>0)
                            @include('partials.form-error')
                        @endif
                        <div class="form-customer des-font">
                            <div class="form-group">
                                <label for="exampleInputEmail1">ایمیل خود را وارد نمایید*</label>
                                <input id="number" type="email" placeholder="ایمیل را وارد نمایید" class="form-control form-account" name="email"
                                       value="{{ old('number') }}" required autocomplete="email" autofocus
                                      >
                            </div>
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <div id="example1"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('ارسال رمز جدید') }}
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>


            </div>
            </div>


    </main>

@endsection
