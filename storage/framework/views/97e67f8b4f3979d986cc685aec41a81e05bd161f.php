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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/upload/logo/sultra.png')); ?>"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

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
                    <center><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo e(asset('/upload/logo/logo.png')); ?>" style="width: 200px;margin-top: -5px;"/></center>
                    </a></li>
                <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-disc font-medium-3" data-ticon="ft-disc"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                
                <li class=" nav-item <?php echo e((request()->is('dashboard*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('/dashboard')); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a></li>
				<?php if(Auth::user()->group == 1 || Auth::user()->group == 2): ?>
                    <li class=" nav-item <?php echo e((request()->is('agenda*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('agenda')); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Agenda</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Usul OPD</span><span id="count_all"></span></a>
                        <ul class="menu-content">
                            <li  class="<?php echo e((request()->is('proposal_income*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_income')); ?>">Masuk<span id="count_request"></span></a></li>
                            <li  class="<?php echo e((request()->is('proposal_process*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_process')); ?>">Diproses<span id="count_process"></span></a></li>
                            <li  class="<?php echo e((request()->is('proposal_done*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_done')); ?>">Selesai</a></li>
                        </ul>
                    </li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Harmonisasi</span><span id="count2_1"></span></a>
                        <ul class="menu-content">
                            <li  class="<?php echo e((request()->is('harmonizations*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonizations')); ?>">Perbaikan<span id="count2_2"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_opd*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_opd')); ?>">Terkirim Ke OPD<span id="count2_3"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_get_document*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_get_document')); ?>">Telah Ambil Berkas<span id="count2_4"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_send_document*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_send_document')); ?>">File perbaikan OPD<span id="count2_5"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_verification*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_verification')); ?>">Verifikasi Dokumen<span id="count2_6"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_done*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_done')); ?>">Selesai</span></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Auth::user()->group == 1): ?>
                    <li class=" nav-item <?php echo e((request()->is('office*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('office')); ?>"><i class="la la-building"></i><span class="menu-title" data-i18n="">OPD</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('user*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('user')); ?>"><i class="ft-user"></i><span class="menu-title" data-i18n="">User</span></a></li>
                <?php endif; ?>
                <?php if(Auth::user()->group == 3): ?>
                    <li class=" nav-item <?php echo e((request()->is('proposal/create*')) ? 'active' : ''); ?>"><a href="<?php echo e(url('proposal/create')); ?>"><i class="ft-plus-square"></i><span class="menu-title" data-i18n="">Buat Pengusulan</span></a></li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Data Pengusulan</span><span id="count_all"></span></a>
                        <ul class="menu-content">
                            <li class="<?php echo e((request()->is('proposal_income*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_income')); ?>">Terkirim<span id="count_request"></span></a></li>
                            <li class="<?php echo e((request()->is('proposal_revision*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_revision')); ?>">Tidak Lengkap<span id="count_fixing"></span></a></li>
                            <li class="<?php echo e((request()->is('proposal_process*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_process')); ?>">Diproses<span id="count_process"></span></a></li>
                            <li  class="<?php echo e((request()->is('proposal_done*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('proposal_done')); ?>">Selesai</a></li>
                        </ul>
                    </li>
                    <li class=" nav-item <?php echo e((request()->is('proposal*')) ? 'active' : ''); ?>"><a href="#"><i class="ft-list"></i><span class="menu-title" data-i18n="">Harmonisasi</span><span id="count2_1"></span></a>
                        <ul class="menu-content">
                            <li  class="<?php echo e((request()->is('harmonization_opd*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_opd')); ?>">Dalam Perbaikian <br>Admin<span id="count2_2"></span></a></li>
                            <li  class="<?php echo e((request()->is('harmonization_get_document*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_get_document')); ?>">Telah Diperbaiki <br>Admin<span id="count2_3"></span></a></li>
                            <li  class="<?php echo e((request()->is('harmonization_get_hardcopy*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_get_hardcopy')); ?>">Telah Ambil Berkas <br>Fisik<span id="count2_4"></span></a></li>
                            <li  class="<?php echo e((request()->is('harmonization_send_document*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_send_document')); ?>">Telah Mengirim File <br>ke Admin<span id="count2_5"></span></a></li>
                            <li  class="<?php echo e((request()->is('harmonization_verification*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_verification')); ?>">Verifikasi Dokumen<span id="count2_6"></span></a>
                            <li  class="<?php echo e((request()->is('harmonization_done*')) ? 'active' : ''); ?>"><a class="menu-item" href="<?php echo e(url('harmonization_done')); ?>">Selesai<span id="count2_7"></span></a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

	<?php echo $__env->yieldContent('konten'); ?>

    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2022</span></div>
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

<script type="text/javascript">
    function cek1(){
        url = "<?php echo e(url('/count/all')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count_all").html( options );
        setTimeout(function(){
            cek1();
        }, 5000);

        });
    }
    cek1();

    function cek2(){
        url = "<?php echo e(url('/count/request')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count_request").html( options );
        setTimeout(function(){
            cek2();
        }, 5000);

        });
    }
    cek2();

    function cek3(){
        url = "<?php echo e(url('/count/fixing')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count_fixing").html( options );
        setTimeout(function(){
            cek3();
        }, 5000);

        });
    }
    cek3();

    function cek4(){
        url = "<?php echo e(url('/count/process')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count_process").html( options );
        setTimeout(function(){
            cek4();
        }, 5000);

        });
    }
    cek4();

    function cek5(){
        url = "<?php echo e(url('/count/done')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count_done").html( options );
        setTimeout(function(){
            cek5();
        }, 5000);

        });
    }
    cek5();

    function cek6(){
        url = "<?php echo e(url('count2/1')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_1").html( options );
        setTimeout(function(){
            cek6();
        }, 5000);

        });
    }
    cek6();

    function cek7(){
        url = "<?php echo e(url('count2/2')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_2").html( options );
        setTimeout(function(){
            cek7();
        }, 5000);

        });
    }
    cek7();

    function cek8(){
        url = "<?php echo e(url('count2/3')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_3").html( options );
        setTimeout(function(){
            cek8();
        }, 5000);

        });
    }
    cek8();

    function cek9(){
        url = "<?php echo e(url('count2/4')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_4").html( options );
        setTimeout(function(){
            cek9();
        }, 5000);

        });
    }
    cek9();

    function cek10(){
        url = "<?php echo e(url('count2/5')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_5").html( options );
        setTimeout(function(){
            cek10();
        }, 5000);

        });
    }
    cek10();

    function cek11(){
        url = "<?php echo e(url('count2/6')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_6").html( options );
        setTimeout(function(){
            cek11();
        }, 5000);

        });
    }
    cek11();

    function cek12(){
        url = "<?php echo e(url('count2/7')); ?>" ;
        $.get(url, function(data, status){
        
        data = JSON.parse(data);
        if( data > 0 )
            options = '<span class="badge badge badge-info badge-pill float-right mr-2">'+data+'</span>';
        else
            options = '';
        $("#count2_7").html( options );
        setTimeout(function(){
            cek12();
        }, 5000);

        });
    }
    cek12();

</script>
</html><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/layout.blade.php ENDPATH**/ ?>