
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
                                <li class="breadcrumb-item"><a href="<?php echo e(url('proposal')); ?>"><?php echo e(__($title)); ?></a>
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
                                    <h4 class="card-title">Lembar Kontrol</h4>
                                </div>
						  	<form action="<?php echo e(url('/'.Request::segment(1).'/verification/'.$proposal->id)); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="_method" value="PUT">
								

                                <div class="form-group row">

									<label class="col-form-label col-sm-3 text-sm-right"> OPD </label>
									<div class="col-sm-9">
                                        <label class="col-form-label col-sm-12">: <?php echo e($proposal->office->name); ?> </label>
									</div>

									<label class="col-form-label col-sm-3 text-sm-right"> No. Agenda Registrasi </label>
									<div class="col-sm-9">
                                        <label class="col-form-label col-sm-12">: </label>
									</div>

									<label class="col-form-label col-sm-3 text-sm-right"> Tanggal Masuk SK </label>
									<div class="col-sm-9">
                                        <label class="col-form-label col-sm-12">: <?php echo e(date('d-m-Y', strtotime($proposal->date))); ?></label>
									</div>

									<label class="col-form-label col-sm-3 text-sm-right"> Tentang </label>
									<div class="col-sm-9">
                                        <label class="col-form-label col-sm-12">: <?php echo e($proposal->about); ?></label>
									</div>

								</div>
	
                                <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-info white">
                                                <tr>
                                                    <th style="width: 60px">No</th>
                                                    <th>Kelengkapan Pelayanan</th>
                                                    <th>File</th>
                                                    <th>Status</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<tr>
											<td>1</td>
											<td>SURAT PENGANTAR</td>
											<td><a href="<?php echo e(asset('upload/cover_letter/'.$proposal->cover_letter )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
											<td>
                                                <select class="select2 form-control <?php if($errors->has('status1')): ?> is-invalid <?php endif; ?> " id="default-select" name="status1">
                                                    <option value="">- Pilih Status -</option>
                                                    <option value="Lengkap" <?php if(old('status1')=="Lengkap"): ?> selected <?php endif; ?>>Lengkap</option>
                                                    <option value="Tidak Lengkap" <?php if(old('status1')=="Tidak Lengkap"): ?> selected <?php endif; ?>>Tidak Lengkap</option>
                                                    </option>
                                                </select>
                                                <?php if($errors->has('status1')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('status1')); ?></label><?php endif; ?>
                                            </td>
											<td>
                                                <input type="text" name="desc1" class="form-control <?php if($errors->has('desc1')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('desc1')); ?>">
                                            </td>
										</tr>
										<tr>
											<td>2</td>
											<td>TELAAHAN STAF</td>
											<td><a href="<?php echo e(asset('upload/review_staff/'.$proposal->review_staff )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
											<td>
                                                <select class="select2 form-control <?php if($errors->has('status2')): ?> is-invalid <?php endif; ?> " id="default-select" name="status2">
                                                    <option value="">- Pilih Status -</option>
                                                    <option value="Lengkap" <?php if(old('status2')=="Lengkap"): ?> selected <?php endif; ?>>Lengkap</option>
                                                    <option value="Tidak Lengkap" <?php if(old('status2')=="Tidak Lengkap"): ?> selected <?php endif; ?>>Tidak Lengkap</option>
                                                    </option>
                                                </select>
                                                <?php if($errors->has('status2')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('status2')); ?></label><?php endif; ?>
                                            </td>
											<td>
                                                <input type="text" name="desc2" class="form-control <?php if($errors->has('desc2')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('desc2')); ?>">
                                            </td>
										</tr>
										<tr>
											<td>3</td>
											<td>NOTA DINAS</td>
											<td><a href="<?php echo e(asset('upload/official_memo/'.$proposal->official_memo )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
											<td>
                                                <select class="select2 form-control <?php if($errors->has('status3')): ?> is-invalid <?php endif; ?> " id="default-select" name="status3">
                                                    <option value="">- Pilih Status -</option>
                                                    <option value="Lengkap" <?php if(old('status3')=="Lengkap"): ?> selected <?php endif; ?>>Lengkap</option>
                                                    <option value="Tidak Lengkap" <?php if(old('status3')=="Tidak Lengkap"): ?> selected <?php endif; ?>>Tidak Lengkap</option>
                                                    </option>
                                                </select>
                                                <?php if($errors->has('status3')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('status3')); ?></label><?php endif; ?>
                                            </td>
											<td>
                                                <input type="text" name="desc3" class="form-control <?php if($errors->has('desc3')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('desc3')); ?>">
                                            </td>
										</tr>
										<tr>
											<td>4</td>
											<td>KONSEP PERSETUJUAN NASKAH DINAS</td>
											<td><a href="<?php echo e(asset('upload/approval_concept/'.$proposal->approval_concept )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
											<td>
                                                <select class="select2 form-control <?php if($errors->has('status4')): ?> is-invalid <?php endif; ?> " id="default-select" name="status4">
                                                    <option value="">- Pilih Status -</option>
                                                    <option value="Lengkap" <?php if(old('status4')=="Lengkap"): ?> selected <?php endif; ?>>Lengkap</option>
                                                    <option value="Tidak Lengkap" <?php if(old('status4')=="Tidak Lengkap"): ?> selected <?php endif; ?>>Tidak Lengkap</option>
                                                    </option>
                                                </select>
                                                <?php if($errors->has('status4')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('status4')); ?></label><?php endif; ?>
                                            </td>
											<td>
                                                <input type="text" name="desc4" class="form-control <?php if($errors->has('desc4')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('desc4')); ?>">
                                            </td>
										</tr>
										<tr>
											<td>4</td>
											<td>SOFTCOPY/HARDCOPY</td>
											<td><a href="<?php echo e(asset('upload/draft/'.$proposal->draft )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
											<td>
                                                <select class="select2 form-control <?php if($errors->has('status5')): ?> is-invalid <?php endif; ?> " id="default-select" name="status5">
                                                    <option value="">- Pilih Status -</option>
                                                    <option value="Lengkap" <?php if(old('status5')=="Lengkap"): ?> selected <?php endif; ?>>Lengkap</option>
                                                    <option value="Tidak Lengkap" <?php if(old('status5')=="Tidak Lengkap"): ?> selected <?php endif; ?>>Tidak Lengkap</option>
                                                    </option>
                                                </select>
                                                <?php if($errors->has('status5')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('status5')); ?></label><?php endif; ?>
                                            </td>
											<td>
                                                <input type="text" name="desc5" class="form-control <?php if($errors->has('desc5')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('desc5')); ?>">
                                            </td>
										</tr>
                                        
                                            </tbody>
                                        </table>
                                    </div>

								<div class="form-group row">
									<div class="col-sm-12 ml-sm-auto">
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/proposal/control_sheet.blade.php ENDPATH**/ ?>