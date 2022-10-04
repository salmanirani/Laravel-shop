<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="widget widget-about">
                        <h4 class="widget-title">{{$setting[0]['title']}}</h4><!-- End .widget-title -->
                        <p>{{$setting[0]['description']}} </p>

                        <div class="social-icons">
                            @if(!empty($setting[0]['facebook']))
                                <a href="{{$setting[0]['facebook']}}" class="social-icon" target="_blank" title="فیسبوک"><i class="icon-facebook-f"></i></a>
                            @endif
                            @if(!empty($setting[0]['twitter']))

                                <a href="{{$setting[0]['twitter']}}" class="social-icon" target="_blank" title="توییتر"><i class="icon-twitter"></i></a>
                            @endif
                            @if(!empty($setting[0]['youtube']))
                                <a href="{{$setting[0]['youtube']}}" class="social-icon" target="_blank" title="یوتیوب"><i class="icon-youtube"></i></a>
                            @endif
                            @if(!empty($setting[0]['instagram']))
                                <a href="{{$setting[0]['instagram']}}" class="social-icon" target="_blank" title="اینستاگرام"><i class="icon-instagram"></i></a>
                            @endif
                        </div><!-- End .soial-icons -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->

                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">صفحات دیگر</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            @foreach($pages as $page)
                                <li ><a  href="@if(!empty($demo))  {{route('frontend.pages.show',$page['id'])}} @else  {{route('frontend.pages.show',$page['id'])}} @endif">{{$page['title']}}</a> </li>
                            @endforeach
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">حساب کاربری</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif">ورود</a></li>
                            <li><a href="@if(!empty($demo))  {{route('demo.cart.cart')}} @else  {{route('cart.cart')}} @endif">سبد خرید</a></li>
                            <li><a href="#">لیست علاقه مندی ها</a></li>
                            <li><a href="@if(!empty($demo))  {{route('demo.user.profile')}} @else  {{route('user.profile')}} @endif">پیگیری سفارشات</a></li>
                            <li><a href="#">راهنما</a></li>

                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->
                <div class="col-sm-6 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">مجوزها</h4><!-- End .widget-title -->

                        @php
                             echo $setting[0]['enamad'];
                        @endphp
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-6 col-lg-3 -->


            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="footer-bottom">
        <div class="container">
            <img src="https://www.ishopsaz.com{{$logo}}" alt="{{$setting[0]['title']}}" width="82" height="25">
            <p class="footer-copyright">کلیه حقوق متعلق به {{$setting[0]['title']}} میباشد.
                طراحی و پشتیبانی توسط
                <a href="https://www.ishopsaz.com">آی شاپ ساز</a></p>
            <!-- End .footer-copyright -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer><!-- End .footer -->
</div><!-- End .page-wrapper -->
<button id="scroll-top" title="بازگشت به بالا"><i class="icon-arrow-up"></i></button>

<!-- Mobile Menu -->
<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>
        <form role="search" method="get" id="searchform"class="mobile-search"
              action="@if(!empty($demo))  {{route('demo.frontend.search')}} @else  {{route('frontend.search')}} @endif">
            @csrf
            <label for="mobile-search" class="sr-only">جستجو</label>
            <input type="search" class="form-control" name="q" id="mobile-search"
                   placeholder="جستجو در ..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                   role="tab" aria-controls="mobile-menu-tab" aria-selected="true">منو</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                   aria-controls="mobile-cats-tab" aria-selected="false">دسته بندی ها</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                 aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="@if(!empty($demo))  {{route('home')}} @else  {{route('home')}} @endif">صفحه نخست</a>
                        </li>
                        <li>
                            <a href="#">محصولات</a>
                            <ul>
                                @foreach($mtcategories as $category)
                                    <li class="level3 menu-child-font"><a
                                                href="@if(!empty($demo))  {{route('demo.category.index',$category['id'])}} @else  {{route('category.index',$category['id'])}} @endif">{{$category['name']}}</a>
                                    </li>
                                @endforeach
                                <li><a
                                            href="@if(!empty($demo))  {{route('frontend.allproduct')}} @else  {{route('frontend.allproduct')}} @endif">تمام محصولات</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">وبلاگ</a>
                            <ul>
                                <li><a
                                            href="@if(!empty($demo))  {{route('demo.frontend.blogs.search')}} @else  {{route('frontend.blogs.search')}} @endif">آخرین نوشته ها</a>
                                </li>
                                @foreach($categoriesBlog as $cat)

                                    <li class="level3 capital menu-child-font"><a
                                                href="@if(!empty($demo))  {{route('demo.frontend.blogs.blogCat','category='.$cat->id)}} @else  {{route('frontend.blogs.blogCat','category='.$cat->id)}} @endif">{{$cat->title}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
<li>
                            <a href="#">صفحات</a>
                            <ul>
                                @foreach($pages as $page)
                                    <li class="level3 capital menu-child-font"><a
                                                href="@if(!empty($demo))  {{route('demo.frontend.pages.show',$page['id'])}} @else  {{route('frontend.pages.show',$page['id'])}} @endif">{{$page['title']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        <li class="">
                            <a href="@if(!empty($demo))  {{route('demo.login')}} @else  {{route('login')}} @endif">ورود | ثبت نام</a>
                        </li>


                        </li>

                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        @foreach($mtcategories as $category)

                            <li><a class="mobile-cats-lead"
                                   href="@if(!empty($demo))  {{route('demo.category.index',$category['id'])}} @else  {{route('category.index',$category['id'])}} @endif">{{$category['name']}}</a></li>

                        @endforeach
                        <li><a class="mobile-cats-lead" href="@if(!empty($demo)) {{route('demo.frontend.allproduct')}} @else {{route('frontend.allproduct')}} @endif">تمام محصولات</a></li>

                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            @if(!empty($setting[0]['facebook']))
                <a href="{{$setting[0]['facebook']}}" class="social-icon" target="_blank" title="فیسبوک"><i class="icon-facebook-f"></i></a>
            @endif
            @if(!empty($setting[0]['twitter']))

                    <a href="{{$setting[0]['twitter']}}" class="social-icon" target="_blank" title="توییتر"><i class="icon-twitter"></i></a>
                @endif
            @if(!empty($setting[0]['youtube']))
                    <a href="{{$setting[0]['youtube']}}" class="social-icon" target="_blank" title="یوتیوب"><i class="icon-youtube"></i></a>
                @endif
            @if(!empty($setting[0]['instagram']))
                    <a href="{{$setting[0]['instagram']}}" class="social-icon" target="_blank" title="اینستاگرام"><i class="icon-instagram"></i></a>
                @endif
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->

<!-- Plugins JS File -->
<script src="{{asset('theme/theme2/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/jquery.hoverIntent.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/superfish.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/jquery.plugin.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/jquery.countdown.min.js')}}"></script>
<!-- Main JS File -->
<script src="{{asset('theme/theme2/assets/js/main.js')}}"></script>
<script src="{{asset('theme/theme2/assets/js/demos/demo-6.js')}}"></script>





</body>

</html>
