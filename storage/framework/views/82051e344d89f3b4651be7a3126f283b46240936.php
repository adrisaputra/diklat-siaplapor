
<?php $__env->startSection('konten'); ?>
        
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"><?php echo e(__('User')); ?></h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo e(url('user')); ?>"><?php echo e(__('User')); ?></a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-4 col-12 d-block d-md-none"><a class="btn btn-warning btn-min-width float-md-right box-shadow-4 mr-1 mb-1" href="chat-application.html"><i class="ft-mail"></i> Email</a></div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
							
                                <div class="card-header">
                                    <h4 class="card-title"><?php echo e(__('Edit Profil')); ?></h4>
                                </div>
						  <form action="<?php echo e(url('/'.Request::segment(1).'/edit_profil/'.$user->id)); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="_method" value="PUT">
								<div class="form-group row">
								<label class="col-form-label col-sm-3 text-sm-right"> Nama User</label>
									<div class="col-sm-9">
										<?php if(Auth::user()->group==2): ?>
											<input type="text" class="form-control" placeholder="Nama User" value="<?php echo e($user->name); ?>" disabled>
											<input type="hidden" class="form-control" placeholder="Nama User" name="name" value="<?php echo e($user->name); ?>" >
										<?php else: ?>
											<input type="text" class="form-control" placeholder="Nama User" name="name" value="<?php echo e($user->name); ?>" >
										<?php endif; ?>
										<input type="hidden" class="form-control" placeholder="Nama User" name="name2" value="<?php echo e($user->name); ?>" >
										<?php if($errors->has('name')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('name')); ?></label><?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right">Email</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo e($user->email); ?>" >
										<?php if($errors->has('email')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('email')); ?></label><?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right">Foto User <span class="required" style="color: #dd4b39;">*</span></label>
									<div class="col-sm-9">
										<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png,pdf)</i></span><br>
										<input type="file" name="foto"  class="form-control <?php if($errors->has('foto')): ?> is-invalid <?php endif; ?> ">
										<?php if($errors->has('foto')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('arsip_non_litigasi')); ?></label><?php endif; ?>
										<?php if($user->foto): ?>
											<br>
											<img src="<?php echo e(asset('upload/foto/'.$user->foto)); ?>" width="150px" height="150px">
										<?php endif; ?>
									</div>
								</div>
								
								<hr style="border-top: 1px solid #d4d8e0;">

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right">Password Lama</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" placeholder="Password" name="current-password" >
										<?php if($errors->has('current-password')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('current-password')); ?></label><?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right">Password Baru</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" placeholder="Password" name="password" >
										<?php if($errors->has('password')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('password')); ?></label><?php endif; ?>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right">Konfirmasi Password</label>
									<div class="col-sm-9">
										<input type="password" class="form-control" placeholder="Konfirmasi Password" name="password_confirmation" >
										<?php if($errors->has('password_confirmation')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('password_confirmation')); ?></label><?php endif; ?>
									</div>
								</div>
								<br><br>
								<div class="form-group row">
									<div class="col-sm-10 ml-sm-auto">
										<button type="submit" class="btn btn-success">Simpan</button>
										<button type="reset" class="btn btn-danger">Reset</button>
										<a href="<?php echo e(url('/'.Request::segment(1))); ?>" class="btn btn-warning">kembali</a>
									</div>
								</div>
							</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/user/profil.blade.php ENDPATH**/ ?>