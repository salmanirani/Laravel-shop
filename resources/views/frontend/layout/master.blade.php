@if($theme == 'theme1')
    @include('partials.menuHeaderSite')
    @yield('content')
    @include('partials.footerSite')
@elseif($theme == 'theme2')
    @include('partials.theme2.menuHeaderSite')
    @yield('content')
    @include('partials.theme2.footerSite')
@endif
@yield('script-vuejs')
@yield('script')


