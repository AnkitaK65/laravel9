@include('backend.layouts.header')

@include('backend.layouts.nav')

@include('backend.layouts.sidebar')

@include('message.flash-message')

@yield('content')

@include('backend.layouts.footer')