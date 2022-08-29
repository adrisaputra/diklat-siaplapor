<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Sipermen Konawe Kepulauan</title>

    <link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="">
    
    <!-- Favicons -->
    <link href="<?php echo e(asset('/upload/logo/konkep.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('/upload/logo/konkep.png')); ?>" rel="apple-touch-icon">

	<!-- PICK ONE OF THE STYLES BELOW -->
	<link href="<?php echo e(asset('/assets/css/classic.css')); ?>" rel="stylesheet">
	<!-- <link href="css/corporate.css" rel="stylesheet"> -->
	<!-- <link href="css/modern.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	
	<!-- END SETTINGS -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-120946860-6');
</script></head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content ">
				<a class="sidebar-brand" href="/">
				  <center><img src="<?php echo e(asset('/upload/logo/logo.png')); ?>" height="50" width="180"></center>
				</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>
					<?php if(Auth::user()->group==1): ?>
					<li class="sidebar-item <?php echo e((request()->is('dashboard*')) ? 'active' : ''); ?>">
						<a href="<?php echo e(url('/dashboard')); ?>" class="sidebar-link">
						  <i class="align-middle" data-feather="home"></i> <span>Beranda</span>
						</a>
					</li>
					<li class="sidebar-item <?php echo e((request()->is('pegawai*')) ? 'active' : ''); ?>">
						<a href="<?php echo e(url('/pegawai')); ?>" class="sidebar-link">
						  <i class="align-middle" data-feather="users"></i> <span>Pegawai</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a href="#pages" data-toggle="collapse" class="sidebar-link collapsed">
							<i class="align-middle" data-feather="list"></i> <span class="align-middle">Arsip</span>
							<span id="datamasuk"></span>
						</a>
						<ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item <?php echo e((request()->is('arsip_biasa*')) ? 'active' : ''); ?>">
								<a href="<?php echo e(url('/arsip_biasa')); ?>" class="sidebar-link">
								<i class="align-middle" data-feather="circle"></i> Arsip Biasa 
									<span id="datamasuk2"></span>
								</a>
							</li>
							<li class="sidebar-item <?php echo e((request()->is('surat_masuk*')) ? 'active' : ''); ?>">
								<a href="<?php echo e(url('/surat_masuk')); ?>" class="sidebar-link">
								<i class="align-middle" data-feather="circle"></i> Surat Masuk
								</a>
							</li>
							<li class="sidebar-item <?php echo e((request()->is('surat_keluar*')) ? 'active' : ''); ?>">
								<a href="<?php echo e(url('/surat_keluar')); ?>" class="sidebar-link">
								<i class="align-middle" data-feather="circle"></i> <span>Surat Keluar</span>
								</a>
							</li>
						</ul>
                    </li>
				<li class="sidebar-header">
					Setting
                    </li>
					<li class="sidebar-item <?php echo e((request()->is('user*')) ? 'active' : ''); ?>">
						<a href="<?php echo e(url('/user')); ?>" class="sidebar-link">
						  <i class="align-middle" data-feather="users"></i> <span>User</span>
						</a>
					</li>
				<?php elseif(Auth::user()->group==2): ?>
                    
					<li class="sidebar-item <?php echo e((request()->is('pegawai*')) ? 'active' : ''); ?>">
						<a href="<?php echo e(url('/pegawai')); ?>" class="sidebar-link">
						  <i class="align-middle" data-feather="users"></i> <span>Pegawai</span>
						</a>
					</li>
					<li class="sidebar-item <?php echo e((request()->is('arsip_digital*')) ? 'active' : ''); ?>">
						<a href="<?php echo e(url('/arsip_digital/1' )); ?>" class="sidebar-link">
						  <i class="align-middle" data-feather="users"></i> <span>Arsip Digital</span>
						</a>
					</li>
					
                	<?php endif; ?>
				<div class="sidebar-bottom d-none d-lg-block">
					<div class="media">
                        <?php if(Auth::user()->foto): ?>
                            <img class="rounded-circle mr-3" src="<?php echo e(asset('upload/foto/'.Auth::user()->foto)); ?>" alt="Chris Wood" width="40" height="40">
                        <?php else: ?> 
                            <img class="rounded-circle mr-3" src="<?php echo e(asset('/assets/img/avatars/avatar.jpg')); ?>" alt="Chris Wood" width="40" height="40">
                        <?php endif; ?>     
						<div class="media-body">
							<h5 class="mb-1"><?php echo e(Auth::user()->name); ?></h5>
							<div>
								<i class="fas fa-circle text-success"></i> Online
							</div>
						</div>
					</div>
				</div>

			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light bg-white">
			<a class="sidebar-toggle d-flex mr-2">
          <i class="hamburger align-self-center"></i>
        </a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                            <?php if(Auth::user()->foto): ?>
                                <img src="<?php echo e(asset('upload/foto/'.Auth::user()->foto)); ?>" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood"> <span class="text-dark"><?php echo e(Auth::user()->name); ?></span>
                            <?php else: ?> 
                                <img src="<?php echo e(asset('/assets/img/avatars/avatar.jpg')); ?>" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood"> <span class="text-dark"><?php echo e(Auth::user()->name); ?></span>
                            <?php endif; ?>     
               
              </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="<?php echo e(url('/user/edit_profil/'.Auth::user()->id)); ?>">Profil</a>
								<a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Log Out')); ?></a>
								<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<?php echo $__env->yieldContent('konten'); ?>

		</div>
	</div>

	<script src="<?php echo e(asset('/assets/js/app.js')); ?>"></script>

	<script>
		$(function() {
			// Select2
			$(".select2").each(function() {
				$(this)
					.wrap("<div class=\"position-relative\"></div>")
					.select2({
						placeholder: "Select value",
						dropdownParent: $(this).parent()
					});
			})
			// Daterangepicker
			$("input[name=\"daterange\"]").daterangepicker({
				opens: "left"
			});
			$("input[name=\"datetimes\"]").daterangepicker({
				timePicker: true,
				opens: "left",
				startDate: moment().startOf("hour"),
				endDate: moment().startOf("hour").add(32, "hour"),
				locale: {
					format: "M/DD hh:mm A"
				}
			});
			$("input[name=\"tanggal_surat\"]").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			$("input[name=\"tanggal_arsip\"]").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			$("input[name=\"tmt_cpns\"]").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			$("input[name=\"tmt_pns\"]").daterangepicker({
				singleDatePicker: true,
				showDropdowns: true
			});
			// Datetimepicker
			$('#datetimepicker-minimum').datetimepicker();
			$('#datetimepicker-view-mode').datetimepicker({
				viewMode: 'years'
			});
			$('#datetimepicker-time').datetimepicker({
				format: 'LT'
			});
			$('#datetimepicker-date').datetimepicker({
				format: 'L'
			});
			var start = moment().subtract(29, "days");
			var end = moment();

			function cb(start, end) {
				$("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
			}
			$("#reportrange").daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					"Today": [moment(), moment()],
					"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
					"Last 7 Days": [moment().subtract(6, "days"), moment()],
					"Last 30 Days": [moment().subtract(29, "days"), moment()],
					"This Month": [moment().startOf("month"), moment().endOf("month")],
					"Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
				}
			}, cb);
			cb(start, end);
		});
	</script>

</body>

</html>

<?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/layout.blade.php ENDPATH**/ ?>