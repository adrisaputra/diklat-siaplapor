
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Tambah <?php echo e(__('User')); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/'.Request::segment(1))); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
										<?php echo e(csrf_field()); ?>

										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Nama User</label>
											<div class="col-sm-9">
												<input type="text" name="name" class="form-control <?php if($errors->has('name')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('name')); ?>">
												<?php if($errors->has('name')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('name')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Email</label>
											<div class="col-sm-9">
												<input type="text" name="email" class="form-control <?php if($errors->has('email')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('email')); ?>">
												<?php if($errors->has('email')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('email')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Password</label>
											<div class="col-sm-9">
												<input type="password" name="password" class="form-control <?php if($errors->has('password')): ?> is-invalid <?php endif; ?> ">
												<?php if($errors->has('password')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('password')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Konfirmasi Password</label>
											<div class="col-sm-9">
												<input type="password" name="password_confirmation" class="form-control <?php if($errors->has('password_confirmation')): ?> is-invalid <?php endif; ?> "">
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
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/user/create.blade.php ENDPATH**/ ?>