<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Sipermen Konawe Kepulauan</title>
    <link href="<?php echo e(asset('/upload/logo/konkep.png')); ?>" rel="icon">
	<link href="<?php echo e(asset('/assets/css/classic.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('/assets/css/custom.css')); ?>" rel="stylesheet">
	
</head>

<body style="background-image: url(upload/background/6081374.jpg);background-size: cover;">
	<main class="main d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						<?php echo $__env->yieldContent('content'); ?>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="<?php echo e(asset('//assets/js/app.js')); ?>"></script>

</body>

</html><?php /**PATH E:\workspace\diklat-sipermen\resources\views/layouts/app.blade.php ENDPATH**/ ?>