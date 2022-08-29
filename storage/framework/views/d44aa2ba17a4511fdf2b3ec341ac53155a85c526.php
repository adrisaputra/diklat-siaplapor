
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Tambah <?php echo e(__($title)); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/'.Request::segment(1))); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
										<?php echo e(csrf_field()); ?>

										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Arsip <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nomor_arsip" class="form-control <?php if($errors->has('nomor_arsip')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('nomor_arsip')); ?>">
												<?php if($errors->has('nomor_arsip')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('nomor_arsip')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Perihal <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<textarea name="perihal" class="form-control <?php if($errors->has('perihal')): ?> is-invalid <?php endif; ?> "><?php echo e(old('perihal')); ?></textarea>
												<?php if($errors->has('perihal')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('perihal')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="tanggal_arsip" value="<?php echo e(old('tanggal_arsip')); ?>">
												<?php if($errors->has('tanggal_arsip')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tanggal_arsip')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right">Dokumen <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 100 Mb (jpg,jpeg,png,pdf)</i></span><br>
												<input type="file" name="arsip"  class="form-control <?php if($errors->has('arsip')): ?> is-invalid <?php endif; ?> ">
												<?php if($errors->has('arsip')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('arsip')); ?></label><?php endif; ?>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/arsip_biasa/create.blade.php ENDPATH**/ ?>