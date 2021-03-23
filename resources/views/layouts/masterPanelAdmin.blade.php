<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title', 'پنل مدیریت ماشین چی')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('adminpanel/assets/images/favicon.png')}}">
    <link href="{{asset('adminpanel/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
     <link href="{{asset('adminpanel/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('adminpanel/assets/css/colors/blue.css')}}" id="theme" rel="stylesheet">
    @yield('customCss')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
    <svg class="circular" viewbox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle> </svg>
</div>
<!-- Main wrapper -->
<div id="main-wrapper">
    <!-- Topbar header -->
    @if(!in_array(Route::current()->getName(),['login','register']))
        @include('panelAdmin.topbar')
        @include('panelAdmin.sidebar')
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">سلام @if (auth()->user()->name != null) {{auth()->user()->name}} @else کاربر @endif عزیز، به پنل مدیریت ماشینچی خوش آمدید</h3>
                </div>
{{--                <div class="col-md-7 align-self-center">--}}
{{--                    <ol class="breadcrumb">--}}
{{--                        <li class="breadcrumb-item"><a href="javascript:void(0)">خانه</a></li>--}}
{{--                        <li class="breadcrumb-item active">داشبورد</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
            </div>
    @endif
            @include('panelAdmin.alert')
    @yield('content')

    @if(!in_array(Route::current()->getName(),['login','register']))
        <footer class="footer"> تمام حقوق برای ماشین چی محفوظ می باشد. </footer>
    @endif

</div>
<!-- End Page wrapper  -->
@include('panelAdmin.footer')
