
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
											<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="tanggal_surat" value="<?php echo e(old('tanggal_surat')); ?>">
												<?php if($errors->has('tanggal_surat')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tanggal_surat')); ?></label><?php endif; ?>
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
											<label class="col-form-label col-sm-3 text-sm-right"> <?php echo e(__('Klasifikasi')); ?></label>
											<div class="col-sm-9">
												<select class="form-control <?php if($errors->has('klasifikasi_id')): ?> is-invalid <?php endif; ?> " name="klasifikasi_id" id="klasifikasi_id" onChange="Tampil()">
													<option value="">- Pilih -</option>
													<?php $__currentLoopData = $klasifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<option value="<?php echo e($v->kode); ?>"><?php echo e($v->nama); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</select>
												<?php if($errors->has('klasifikasi_id')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('klasifikasi_id')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat Terakhir</label>
											<div class="col-sm-9">
											<input type="text" id="no_surat_terakhir" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nomor_surat" id="nomor_surat" class="form-control <?php if($errors->has('nomor_surat')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('nomor_surat')); ?>">
												<?php if($errors->has('nomor_surat')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('nomor_surat')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tujuan Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="tujuan" class="form-control <?php if($errors->has('tujuan')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('tujuan')); ?>">
												<?php if($errors->has('tujuan')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tujuan')); ?></label><?php endif; ?>
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
<script>
	function Tampil() {
		klasifikasi_id = document.getElementById("klasifikasi_id").value;
		// document.getElementById("nomor_surat").value = "W.2.IMI.IMI.1-"+klasifikasi_id+".01.01-";
		url = "<?php echo e(url('/get_klasifikasi')); ?>"
		$.ajax({
			url:""+url+"/"+klasifikasi_id+"",
			success: function(response){
				document.getElementById("no_surat_terakhir").value = response;
			}
		});
		return false;
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/surat_keluar/create.blade.php ENDPATH**/ ?>