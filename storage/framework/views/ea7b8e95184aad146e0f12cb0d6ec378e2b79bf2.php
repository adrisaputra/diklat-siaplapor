
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Edit <?php echo e(__($title)); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/'.Request::segment(1).'/edit/'.$surat_keluar->id)); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
									<?php echo e(csrf_field()); ?>

									<input type="hidden" name="_method" value="PUT">
									<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="nomor_surat" class="form-control <?php if($errors->has('nomor_surat')): ?> is-invalid <?php endif; ?> " value="<?php echo e($surat_keluar->nomor_surat); ?>">
												<?php if($errors->has('nomor_surat')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('nomor_surat')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Perihal <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<textarea name="perihal" class="form-control <?php if($errors->has('perihal')): ?> is-invalid <?php endif; ?> "><?php echo e($surat_keluar->perihal); ?></textarea>
												<?php if($errors->has('perihal')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('perihal')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<?php
													$tgl_surat = substr($surat_keluar->tanggal_surat,8,2);
													$bln_surat = substr($surat_keluar->tanggal_surat,5,2);
													$thn_surat = substr($surat_keluar->tanggal_surat,0,4);
												?>
												<input class="form-control" type="text" name="tanggal_surat" value="<?php echo e($bln_surat); ?>/<?php echo e($tgl_surat); ?>/<?php echo e($thn_surat); ?>">
												<?php if($errors->has('tanggal_surat')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tanggal_surat')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right"> Tujuan Surat <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<input type="text" name="tujuan" class="form-control <?php if($errors->has('tujuan')): ?> is-invalid <?php endif; ?> " value="<?php echo e($surat_keluar->tujuan); ?>">
												<?php if($errors->has('tujuan')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tujuan')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-3 text-sm-right">Dokumen <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-9">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 100 Mb (jpg,jpeg,png,pdf)</i></span><br>
												<input type="file" name="arsip_surat_keluar"  class="form-control <?php if($errors->has('arsip_surat_keluar')): ?> is-invalid <?php endif; ?> ">
												<?php if($errors->has('arsip_surat_keluar')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('arsip_surat_keluar')); ?></label><?php endif; ?>
												<?php if($surat_keluar->arsip_surat_keluar): ?>
													<br>
													<a href="<?php echo e(asset('upload/arsip_surat_keluar/'.$surat_keluar->arsip_surat_keluar)); ?>" target="_blank" class="btn btn-sm btn-primary" >Lihat File</a>
												<?php endif; ?>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/surat_keluar/edit.blade.php ENDPATH**/ ?>