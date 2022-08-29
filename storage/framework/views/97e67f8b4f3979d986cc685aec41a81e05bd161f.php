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
    <link rel="apple-touch-icon" href="<?php echo e(asset('/upload/logo/sultra.png')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/upload/logo/sultra.png')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/vendors.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/selects/select2.min.css')); ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/bootstrap-extended.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/colors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/components.css')); ?>">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/core/colors/palette-gradient.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/core/colors/palette-gradient.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/pages/chat-application.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/pages/dashboard-analytics.css')); ?>">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
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
						<?php if(Auth::user()->foto): ?>
							<img src="<?php echo e(asset('upload/foto/'.Auth::user()->foto)); ?>" alt="avatar">
						<?php else: ?> 
							<img src="<?php echo e(asset('app-assets/images/portrait/small/avatar-s-19.png')); ?>" alt="avatar">
						<?php endif; ?>   
					<i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#">
							<span class="avatar avatar-online">
								<?php if(Auth::user()->foto): ?>
									<img src="<?php echo e(asset('upload/foto/'.Auth::user()->foto)); ?>" alt="avatar">
								<?php else: ?> 
									<img src="<?php echo e(asset('app-assets/images/portrait/small/avatar-s-19.png')); ?>" alt="avatar">
								<?php endif; ?>   
							<span class="user-name text-bold-700 ml-1"><?php echo e(Auth::user()->name); ?></span></span></a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo e(url('/user/edit_profil/'.Auth::user()->id)); ?>"><i class="ft-user"></i> Edit Profile</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ft-power"></i> <?php echo e(__('Logout')); ?></a>
                                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                            <?php echo csrf_field(); ?>
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
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true" data-img="<?php echo e(asset('app-assets/images/backgrounds/08.jpg')); ?>">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row position-relative">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                    <center><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo e(asset('/upload/logo/logo.png')); ?>" style="width: 144px;margin-top: -5px;"/></center>
                    </a></li>
                <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-disc font-medium-3" data-ticon="ft-disc"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                <li class=" nav-item <?php echo e((request()->is('dashboard*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/dashboard')); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
				<?php if(Auth::user()->group == 1): ?>
                    <li class=" nav-item <?php echo e((request()->is('agenda*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('agenda')); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Agenda</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('proposal')); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Usul OPD</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('office*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('office')); ?>"><i class="la la-building"></i><span class="menu-title" data-i18n="">OPD</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('user*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('user')); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="">User</span></a></li>
                <?php elseif(Auth::user()->group == 3): ?>
                    <li class=" nav-item <?php echo e((request()->is('proposal/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('proposal/create')); ?>"><i class="ft-plus-square"></i><span class="menu-title" data-i18n="">Buat Pengusulan</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('proposal')); ?>"><i class="ft-list"></i><span class="menu-title" data-i18n="">List Pengusulan</span></a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

	<?php echo $__env->yieldContent('konten'); ?>

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
    <script src="<?php echo e(asset('app-assets/vendors/js/vendors.min.js')); ?>" type="text/javascript"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo e(asset('app-assets/js/core/app-menu.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets/js/core/app.js')); ?>" type="text/javascript"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo e(asset('app-assets/js/scripts/forms/select/form-select2.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/forms/tags/form-field.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/forms/custom-file-input.js')); ?>"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/layout.blade.php ENDPATH**/ ?>