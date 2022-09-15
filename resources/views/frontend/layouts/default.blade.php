@include('frontend.layouts.header')

@include('frontend.layouts.nav')

@include('message.flash-message')

@yield('content')

@include('frontend.layouts.footer')