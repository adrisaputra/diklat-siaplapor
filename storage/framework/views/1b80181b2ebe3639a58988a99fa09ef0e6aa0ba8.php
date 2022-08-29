
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
                                    <h4 class="card-title"><?php echo e(__('Tambah User')); ?></h4>
                                </div>
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
								<div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> Group</label>
									<div class="col-sm-9">
                                        <select class="select2 form-control <?php if($errors->has('group')): ?> is-invalid <?php endif; ?> " id="default-select" name="group" onchange=" if (this.selectedIndex==3){ 
												document.getElementById('office').style.display = 'inline'; 
											} else {
												document.getElementById('office').style.display = 'none'; 
											};">
                                            <option value="">- Pilih Group -</option>
                                            <option value="1" <?php if(old('group')==1): ?> selected <?php endif; ?>>Administrator</option>
                                            <option value="2" <?php if(old('group')==2): ?> selected <?php endif; ?>>Pimpinan</option>
                                            <option value="3" <?php if(old('group')==3): ?> selected <?php endif; ?>>Admin OPD</option>
                                        </select>
										<?php if($errors->has('group')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('group')); ?></label><?php endif; ?>
									</div>
								</div>
                                <?php if(old('group') =="3"): ?>
                                    <span id="office" style="display:inline;">
                                <?php else: ?>
                                    <span id="office" style="display:none;">
                                <?php endif; ?>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-3 text-sm-right"> OPD</label>
                                        <div class="col-sm-9">
                                            <select class="select2 form-control <?php if($errors->has('office_id')): ?> is-invalid <?php endif; ?> " id="default-select" name="office_id">
                                                <option value="">- Pilih OPD -</option>
                                                <?php $__currentLoopData = $office; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($v->id); ?>"><?php echo e($v->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('office_id')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('office_id')); ?></label><?php endif; ?>
                                        </div>
                                    </div>
                                </span>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/user/create.blade.php ENDPATH**/ ?>