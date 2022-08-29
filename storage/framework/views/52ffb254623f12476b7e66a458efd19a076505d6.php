
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12 col-xl-12">
							<div class="card">
								<div class="card-header">
									<h3>Tambah Pegawai</h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/pegawai')); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
										<?php echo e(csrf_field()); ?>

										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> NIP <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-10">
												<input type="text" name="nip" class="form-control <?php if($errors->has('nip')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('nip')); ?>">
												<?php if($errors->has('nip')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('nip')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Nama Pegawai <span class="required" style="color: #dd4b39;">*</span></label>
											<div class="col-sm-10">
												<input type="text" name="nama_pegawai" class="form-control <?php if($errors->has('nama_pegawai')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('nama_pegawai')); ?>">
												<?php if($errors->has('nama_pegawai')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('nama_pegawai')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Tempat Lahir</label>
											<div class="col-sm-10">
												<input type="text" name="tempat_lahir" class="form-control <?php if($errors->has('tempat_lahir')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('tempat_lahir')); ?>">
												<?php if($errors->has('tempat_lahir')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tempat_lahir')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Tanggal Lahir</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tanggal_lahir">
												<?php if($errors->has('tanggal_lahir')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tanggal_lahir')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Jenis Kelamin</label>
											<div class="col-sm-10">
												<select  class="form-control" name="jenis_kelamin">
													<option value=""> -Pilih Jenis Kelamin-</option>
													<option value="Pria" <?php if(old('jenis_kelamin')=="Pria"): ?> selected <?php endif; ?>> Pria</option>
													<option value="Wanita" <?php if(old('jenis_kelamin')=="Wanita"): ?> selected <?php endif; ?>> Wanita</option>
												</select>
												<?php if($errors->has('jenis_kelamin')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('jenis_kelamin')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Alamat</label>
											<div class="col-sm-10">
												<textarea name="alamat" class="form-control <?php if($errors->has('alamat')): ?> is-invalid <?php endif; ?> "><?php echo e(old('alamat')); ?></textarea>
												<?php if($errors->has('alamat')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('alamat')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Agama</label>
											<div class="col-sm-10">
												<select  class="form-control" name="agama">
													<option value=""> -Pilih Agama-</option>
													<option value="Islam" <?php if(old('agama')=="Islam"): ?> selected <?php endif; ?>> Islam</option>
													<option value="Katolik" <?php if(old('agama')=="Katolik"): ?> selected <?php endif; ?>> Katolik</option>
													<option value="Hindu" <?php if(old('agama')=="Hindu"): ?> selected <?php endif; ?>> Hindu</option>
													<option value="Budha" <?php if(old('agama')=="Budha"): ?> selected <?php endif; ?>> Budha</option>
													<option value="Sinto" <?php if(old('agama')=="Sinto"): ?> selected <?php endif; ?>> Sinto</option>
													<option value="Konghucu" <?php if(old('agama')=="Konghucu"): ?> selected <?php endif; ?>> Konghucu</option>
													<option value="Protestan" <?php if(old('agama')=="Protestan"): ?> selected <?php endif; ?>> Protestan</option>
												</select>
												<?php if($errors->has('agama')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('agama')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Gol. Darah</label>
											<div class="col-sm-10">
												<select  class="form-control" name="gol_darah">
													<option value=""> -Pilih Gol. Darah-</option>
													<option value="A" <?php if(old('gol_darah')=="A"): ?> selected <?php endif; ?>> A</option>
													<option value="B" <?php if(old('gol_darah')=="B"): ?> selected <?php endif; ?>> B</option>
													<option value="AB" <?php if(old('gol_darah')=="AB"): ?> selected <?php endif; ?>> AB</option>
													<option value="O" <?php if(old('gol_darah')=="O"): ?> selected <?php endif; ?>> O</option>
												</select>
												<?php if($errors->has('gol_darah')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('gol_darah')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> Email</label>
											<div class="col-sm-10">
												<input type="email" name="email" class="form-control <?php if($errors->has('email')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('email')); ?>">
												<?php if($errors->has('email')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('email')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Telepon</label>
											<div class="col-sm-10">
												<input type="text" name="telp" class="form-control <?php if($errors->has('telp')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('telp')); ?>">
												<?php if($errors->has('telp')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('telp')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">No. KTP</label>
											<div class="col-sm-10">
												<input type="text" name="no_ktp" class="form-control <?php if($errors->has('no_ktp')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('no_ktp')); ?>">
												<?php if($errors->has('no_ktp')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('no_ktp')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. BPJS</label>
											<div class="col-sm-10">
												<input type="text" name="no_bpjs" class="form-control <?php if($errors->has('no_bpjs')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('no_bpjs')); ?>">
												<?php if($errors->has('no_bpjs')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('no_bpjs')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. NPWP</label>
											<div class="col-sm-10">
												<input type="text" name="no_npwp" class="form-control <?php if($errors->has('no_npwp')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('no_npwp')); ?>">
												<?php if($errors->has('no_npwp')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('no_npwp')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Karpeg</label>
											<div class="col-sm-10">
												<input type="text" name="no_karpeg" class="form-control <?php if($errors->has('no_karpeg')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('no_karpeg')); ?>">
												<?php if($errors->has('no_karpeg')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('no_karpeg')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> No. Karsu/Karis</label>
											<div class="col-sm-10">
												<input type="text" name="'no_karsu'" class="form-control <?php if($errors->has('no_karsu')): ?> is-invalid <?php endif; ?> " value="<?php echo e(old('no_karsu')); ?>">
												<?php if($errors->has('no_karsu')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('no_karsu')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> TMT CPNS</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tmt_cpns">
												<?php if($errors->has('tmt_cpns')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tmt_cpns')); ?></label><?php endif; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right"> TMT PNS</label>
											<div class="col-sm-10">
												<input class="form-control" type="text" name="tmt_pns">
												<?php if($errors->has('tmt_pns')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('tmt_pns')); ?></label><?php endif; ?>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Foto</label>
											<div class="col-sm-10">
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span><br>
												<input type="file" name="foto" >
												<?php if($errors->has('foto')): ?> <label id="validation-email-error" class="error jquery-validation-error small form-text invalid-feedback" for="validation-email"><?php echo e($errors->first('foto')); ?></label><?php endif; ?>
											</div>
										</div>
										<br><br>
										<div class="form-group row">
											<div class="col-sm-10 ml-sm-auto">
												<button type="submit" class="btn btn-success">Simpan</button>
												<button type="reset" class="btn btn-danger">Reset</button>
												<a href="<?php echo e(url('/pegawai')); ?>" class="btn btn-warning">kembali</a>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/pegawai/create.blade.php ENDPATH**/ ?>