<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                @if(Auth::user()->image)
                <img src="{{ asset('images/users/'.Auth::user()->id.'/'.Auth::user()->image) }}" alt="Profile" class="rounded-circle">
                @else
                <img src="{{ asset('images/users/user.png') }}" alt="Profile" class="rounded-circle">
                @endif
                <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>{{ Auth::user()->name }}</h6>
                    <span>{{ Auth::user()->email }}</span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{route('change-password')}}">
                        <i class="bi bi-gear"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </form>
                </li>

            </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

    </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->