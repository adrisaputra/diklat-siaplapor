
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Edit <?php echo e(__('User')); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/'.Request::segment(1).'/edit/'.$user->id)); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
									<?php echo e(csrf_field()); ?>

									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Nama User</label>
											<div class="col-sm-9">
											<?php if($user->group=="2"): ?>
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
											<label class="col-form-label col-sm-3 text-sm-right">Password</label>
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
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/user/edit.blade.php ENDPATH**/ ?>