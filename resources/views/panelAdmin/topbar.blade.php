<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('admin.dashboard')}}">
                <b>
                    <!-- Dark Logo icon -->
                    <img style="width: 84%;position: relative;top: 5px;" src="{{asset('adminpanel/assets/images/users/download.svg')}}" alt="homepage" class="dark-logo">
                    <!-- Light Logo icon -->
                    <img src="{{asset('adminpanel/assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo">
                </b>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
            <!-- toggle and nav items -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)">
                        <i class="mdi mdi-menu"></i>
                    </a>
                </li>
                <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)">
                        <i class="close-right-nav"></i>
                    </a>
                </li>
            </ul>
            <!-- User profile and search -->
            <ul class="navbar-nav my-lg-0">
                <!-- Search -->
{{--                <li class="nav-item search-item2 hidden-sm-down search-box">--}}
{{--                    <a class="search-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)">--}}
{{--                        <i class="top-search"></i>--}}
{{--                    </a>--}}
{{--                    <form class="app-search">--}}
{{--                        <input type="text" class="form-control" placeholder="متن خود را وارد کنید و جستجو را شروع کنید"> <a class="srh-btn"><i class="ti-close"></i></a> --}}
{{--                    </form>--}}
{{--                </li>--}}
                <li class="nav-item nav-link">
                    <a class="btn bg-white btn-rounded" target="_blank" href="https://mashinchi.org">
                        مشاهده سایت
                    </a>

                    <a class="btn bg-white btn-rounded" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        خروج
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
{{--                <li class="nav-item nav-link">--}}
{{--                    <a class="btn bg-white btn-rounded" href="add-advertising.html">--}}
{{--                        ثبت آگهی رایگان--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item nav-link">--}}
{{--                    <a class="btn bg-white btn-rounded" href="expert-form.html">--}}
{{--                        درخواست کارشناسی--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </div>
    </nav>
</header>