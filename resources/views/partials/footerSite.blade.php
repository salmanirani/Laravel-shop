<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space_bot_40 logo-footer-home2">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left logo-footer clear-space-left">
                    <a href="#" class="inline-block">
                        <img src="https://www.ishopsaz.com{{$logo}}" class="img-responsive" alt="">
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right newsletter clear-space-right">
                </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 space_bot_40 copy-footer-home2">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left copy clear-space">
                    <p class="des-font copy-text space_top_40">
                        @if(!empty($setting[0]->title))
                        کلیه حقوق این سایت متعلق به

                        @if(!empty($setting[0]->title))
                            {{$setting[0]->title}}
                        @else
                            'تنظیمات انجام نشده'
                        @endif
                        میباشد.
                        @endif
                        طراحی و پشتیبانی توسط
                        <a href="https://www.ishopsaz.com">آی شاپ ساز</a>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right social-footer clear-space">
                    <div class="social-home2 space_top_40">
                        {{--                        <a href="#" class="delay03 inline-block space_left_40"><i class="ti-facebook delay03"></i></a>--}}
                        {{--                        <a href="#" class="delay03 inline-block space_left_40"><i class="ti-twitter-alt delay03"></i></a>--}}
                        {{--                        <a href="#" class="delay03 inline-block space_left_40"><i class="ti-pinterest delay03"></i></a>--}}
                        <a href="https://www.instagram.com/cherllo.ir/" target="_blank"
                           class="delay03 inline-block space_left_40"><i class="ti-instagram delay03"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</footer>
<div class="overlay"></div>
<div class="gotop text-center fade"><i class="ti-angle-up"></i></div>
<div class="form-search delay03 text-center">

    <i class="ti-close" id="close-search"></i>
    <h3 class="text-center title-font">بدنبال چه محصولی میگردید؟</h3>
    <form role="search" method="get" id="searchform" role="search"
          action="@if(!empty($demo)) {{route('demo.frontend.search')}} @else {{route('frontend.search')}} @endif">
        @csrf
        <input type="text" class="form-control control-search des-font" value="" autocomplete="off"
               placeholder="نام محصول یا دسته بندی را وارد کنید ..." aria-label="SEARCH" name="q" id="q">
        <button class="button_search title-font" type="submit">جستجو</button>
    </form>

</div>
<div class="form-cart delay03">
    <i class="ti-close" id="close-cart"></i>
    <h3 class="title-font capital">سبد خرید</h3>
    <div class="empty-cart">
        {{--        <p class="des-font">هیچ محصولی در سبد خرید وجود ندارد.</p>--}}
        <a href="@if(!empty($demo)) {{route('demo.cart.cart')}} @else {{route('cart.cart')}} @endif"
           class="capital des-font">ادامه خرید </a>
    </div>
</div>

</body>
<script src="{{asset('asset/js/jquery-3.3.1.min.js')}}" defer=""></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}" defer=""></script>
<script src="{{asset('asset/js/slick.min.js')}}" defer=""></script>
<script src="{{asset('asset/js/function-main.js')}}" defer=""></script>
<style>

    @font-face {
        font-family: "Shabnam";
        src: url({{asset('asset/fonts/Shabnam.woff')}});
    }

    p, a, strong, div, tt, cite {
        font-family: "Shabnam";

    }
</style>

</body>

</html>
