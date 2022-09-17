
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
                                <li class="breadcrumb-item"><a href="<?php echo e(url('office')); ?>"><?php echo e(__($title)); ?></a>
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
                                    <h4 class="card-title">Tanggal <?php echo e(__($title)); ?></h4>
                                </div>
						  	<form action="<?php echo e(url('/'.Request::segment(1).'/edit/'.$proposal->id)); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="_method" value="PUT">
                            
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk di Ruang Kepala Biro <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_disposition1" class="form-control <?php if($errors->has('date')): ?> is-invalid <?php endif; ?> " value="<?php echo e($proposal->date_disposition1); ?>">
										<?php if($errors->has('date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Keluar di Ruang Kepala Biro <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_disposition2" class="form-control <?php if($errors->has('date')): ?> is-invalid <?php endif; ?> " value="<?php echo e($proposal->date_disposition2); ?>">
										<?php if($errors->has('date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk di Ruang Kepala Bagian <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_disposition3" class="form-control <?php if($errors->has('date')): ?> is-invalid <?php endif; ?> " value="<?php echo e($proposal->date_disposition3); ?>">
										<?php if($errors->has('date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Keluar di Ruang Kepala Bagian <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_disposition4" class="form-control <?php if($errors->has('date')): ?> is-invalid <?php endif; ?> " value="<?php echo e($proposal->date_disposition4); ?>">
										<?php if($errors->has('date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date')); ?></label><?php endif; ?>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk di Admin Biro Hukum <span class="required" style="color: #dd4b39;">*</span> </label>
									<div class="col-sm-9">
										<input type="date" name="date_disposition5" class="form-control <?php if($errors->has('date')): ?> is-invalid <?php endif; ?> " value="<?php echo e($proposal->date_disposition5); ?>">
										<?php if($errors->has('date')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('date')); ?></label><?php endif; ?>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/proposal/disposisi.blade.php ENDPATH**/ ?>