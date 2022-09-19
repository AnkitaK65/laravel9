<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="about" class="{{ (request()->is('about')) ? 'active' : '' }}">About</a></li>
                <!-- <li><a href="/login">Login</a></li> -->
                @if (Route::has('login'))
                <!-- <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block"> -->
                @auth
                <li>
                    <a href="{{ url('dashboard') }}"  class="{{ (request()->is('dashboard')) ? 'active' : '' }}">Dashboard</a>
                </li>
                @else
                <li>
                    <a href="{{ route('login') }}"  class="{{ (request()->is('login')) ? 'active' : '' }}">Log in</a>
                </li>
                @if (Route::has('register'))
                <li>
                    <a href="{{ route('register') }}"  class="{{ (request()->is('register')) ? 'active' : '' }}">Register</a>
                </li>
                @endif
                @endauth
                <!-- </div> -->
                @endif
                <li><a href="/">Contact Us</a></li>
                <li><a href="courses"  class="{{ (request()->is('courses')) ? 'active' : '' }}">Courses</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="#" class="get-started-btn">Get Started</a>

    </div>
</header><!-- End Header -->