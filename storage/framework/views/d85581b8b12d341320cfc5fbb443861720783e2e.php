
<?php $__env->startSection('konten'); ?>
        
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block"><?php echo e(__($title)); ?></h3>
                    <div class="breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo e(url('agenda')); ?>"><?php echo e(__($title)); ?></a>
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
                                    <h4 class="card-title">Tambah <?php echo e(__($title)); ?></h4>
                                </div>
						  	<form action="<?php echo e(url('/'.Request::segment(1))); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
								<?php echo e(csrf_field()); ?>

                                
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_of_entry" class="form-control <?php if($errors->has('date_of_entry')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('date_of_entry')); ?>">
										<?php if($errors->has('date_of_entry')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date_of_entry')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Surat <span class="required" style="color: #dd4b39;">*</span></label>
									<div class="col-sm-9">
										<input type="date" name="letter_date" class="form-control <?php if($errors->has('letter_date')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('letter_date')); ?>">
										<?php if($errors->has('letter_date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('letter_date')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> No. Surat <span class="required" style="color: #dd4b39;">*</span></label>
									<div class="col-sm-9">
										<input type="text" name="letter_number" class="form-control <?php if($errors->has('letter_number')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('letter_number')); ?>">
										<?php if($errors->has('letter_number')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('letter_number')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Asal Surat </label>
									<div class="col-sm-9">
										<input type="text" name="letter_from" class="form-control <?php if($errors->has('letter_from')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('letter_from')); ?>">
										<?php if($errors->has('letter_from')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('letter_from')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tentang</label>
									<div class="col-sm-9">
										<input type="text" name="about" class="form-control <?php if($errors->has('about')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('about')); ?>">
										<?php if($errors->has('about')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('about')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Diproses</label>
									<div class="col-sm-9">
										<input type="text" name="on_process" class="form-control <?php if($errors->has('on_process')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('on_process')); ?>">
										<?php if($errors->has('on_process')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('on_process')); ?></label><?php endif; ?>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/agenda/create.blade.php ENDPATH**/ ?>