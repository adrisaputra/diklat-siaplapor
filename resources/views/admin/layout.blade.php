<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Siap Lapor</title>
    <link rel="apple-touch-icon" href="{{ asset('/upload/logo/sultra.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/upload/logo/sultra.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/chat-application.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-analytics.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"> </i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> 
					<span class="avatar avatar-online">
						@if(Auth::user()->foto)
							<img src="{{ asset('upload/foto/'.Auth::user()->foto) }}" alt="avatar">
						@else 
							<img src="{{ asset('app-assets/images/portrait/small/avatar-s-19.png') }}" alt="avatar">
						@endif   
					<i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#">
							<span class="avatar avatar-online">
								@if(Auth::user()->foto)
									<img src="{{ asset('upload/foto/'.Auth::user()->foto) }}" alt="avatar">
								@else 
									<img src="{{ asset('app-assets/images/portrait/small/avatar-s-19.png') }}" alt="avatar">
								@endif   
							<span class="user-name text-bold-700 ml-1">{{ Auth::user()->name }}</span></span></a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ url('/user/edit_profil/'.Auth::user()->id) }}"><i class="ft-user"></i> Edit Profile</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ft-power"></i> {{ __('Logout') }}</a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" data-img="{{ asset('app-assets/images/backgrounds/08.jpg') }}">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row position-relative">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                    <center><img class="brand-logo" alt="Chameleon admin logo" src="{{ asset('/upload/logo/logo.png') }}" style="width: 144px;margin-top: -5px;"/></center>
                    </a></li>
                <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-disc font-medium-3" data-ticon="ft-disc"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                <li class=" nav-item {{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
				@if(Auth::user()->group == 1)
                    <li class=" nav-item {{ (request()->is('agenda*')) ? 'active' : '' }}"><a href="{{ url('agenda') }}"><i class="ft-home"></i><span class="menu-title" data-i18n="">Agenda</span></a></li>
                    <li class=" nav-item {{ (request()->is('proposal*')) ? 'active' : '' }}"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Usul OPD</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
                        <ul class="menu-content">
                            <li  class="{{ (request()->is('proposal_income*')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('proposal_income') }}">Masuk</a>
                            </li>
                            <li  class="{{ (request()->is('proposal_process*')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('proposal_process') }}">Diproses</a>
                            </li>
                        </ul>
                    </li>
                    <li class=" nav-item {{ (request()->is('office*')) ? 'active' : '' }}"><a href="{{ url('office') }}"><i class="la la-building"></i><span class="menu-title" data-i18n="">OPD</span></a></li>
                    <li class=" nav-item {{ (request()->is('user*')) ? 'active' : '' }}"><a href="{{ url('user') }}"><i class="ft-user"></i><span class="menu-title" data-i18n="">User</span></a></li>
                @elseif(Auth::user()->group == 3)
                    <li class=" nav-item {{ (request()->is('proposal/create*')) ? 'active' : '' }}"><a href="{{ url('proposal/create') }}"><i class="ft-plus-square"></i><span class="menu-title" data-i18n="">Buat Pengusulan</span></a></li>
                    <li class=" nav-item {{ (request()->is('proposal*')) ? 'active' : '' }}"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">List Pengusulan</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
                        <ul class="menu-content">
                            <li class="{{ (request()->is('proposal_income*')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('proposal_income') }}">Terkirim</a>
                            </li>
                            <li class="{{ (request()->is('proposal_revision*')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('proposal_revision') }}">Tidak Lengkap</a>
                            </li>
                            <li class="{{ (request()->is('proposal_process*')) ? 'active' : '' }}"><a class="menu-item" href="{{ url('proposal_process') }}">Diproses</a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

	@yield('konten')

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2019 &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://themeselection.com" target="_blank">ThemeSelection</a></span>
            <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
                <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/" target="_blank"> More themes</a></li>
                <li class="list-inline-item"><a class="my-1" href="https://themeselection.com/support" target="_blank"> Support</a></li>
            </ul>
        </div>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/tags/form-field.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>