    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="{{route('dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('users/'.Auth::user()->id)}}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->
            @if(Auth::user()->user_type == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('users.index')}}">
                    <i class="bi bi-card-list"></i>
                    <span>Users</span>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('courses.index')}}">
                    <i class="bi bi-card-list"></i>
                    <span>Courses</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="bi bi-card-list"></i>
                    <span>Cart</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('change-password')}}">
                    <i class="bi bi-gear"></i>
                    <span>Change Password</span>
                </a>
            </li>

            @if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'user')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('enquiries') ? '' : 'collapsed' }}" href="{{url('enquiries')}}">
                    <i class="bi bi-question-circle"></i>
                    <span>Enquiries</span>
                </a>
            </li>
            @endif

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">