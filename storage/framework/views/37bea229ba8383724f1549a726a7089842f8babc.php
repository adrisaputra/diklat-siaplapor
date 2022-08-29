
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3><?php echo e(__($title)); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/surat_keluar/search')); ?>" method="GET">
									<div class="row">
										<div class="col-md-6">
											<a href="<?php echo e(url('/surat_keluar/create')); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#defaultModalPrimary">Print</button>
																			
											<a href="<?php echo e(url('/surat_keluar')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>										
										</div>
										<div class="col-sm-3">
											<select class="form-control <?php if($errors->has('klasifikasi_id')): ?> is-invalid <?php endif; ?> " name="klasifikasi_id" id="klasifikasi_id">
												<option value="">- Pilih Kode-</option>
												<?php $__currentLoopData = $klasifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($v->id); ?>"  <?php if(Request::get('klasifikasi_id')==$v->id): ?> selected <?php endif; ?>><?php echo e($v->nama); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
										<div class="col-md-3">
											<div class="input-group">
												<input type="text" class="form-control" name="search" placeholder="Cari Data" value="<?php echo e(Request::get('search')); ?>">
												<span class="input-group-btn">
													<input type="submit" name="submit" class="btn btn-info btn-flat" value="Cari">
												</span>
											</div>
										</div>
									</div>
									</form><br>

									<div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
									<form action="<?php echo e(url('/surat_keluar/report_excel')); ?>" method="GET">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Cetak Surat Keluar</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body m-3">
													<div class="form-group">
														<label class="form-label">Masukkan Tanggal</label>
														<input class="form-control" type="text" name="daterange" value="<?php echo e(date('m/d/Y')); ?> - <?php echo e(date('m/d/Y')); ?>" required>
													</div>
													<div class="form-group">
														<select class="form-control <?php if($errors->has('klasifikasi_id')): ?> is-invalid <?php endif; ?> " name="klasifikasi_id">
															<option value="">- Pilih Kode-</option>
															<?php $__currentLoopData = $klasifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																<option value="<?php echo e($v->id); ?>"  <?php if(Request::get('klasifikasi_id')==$v->id): ?> selected <?php endif; ?>><?php echo e($v->nama); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
														</select>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Print</button>
												</div>
											</div>
										</div>
									</form>
									</div>

									<?php if($message = Session::get('status')): ?>
									  <div class="alert alert-primary alert-dismissible" role="alert">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<div class="alert-message">
												<?php echo e($message); ?>

											</div>
										</div>
									<?php endif; ?>
									<div class="table-responsive table-bordered">
										<table class="table mb-0">
											<thead>
											<tr style="background-color: gray;color:white">
												<th>No</th>
												<th>Tanggal Surat</th>
												<th style="width: 20%">Perihal</th>
												<th>No. Surat</th>
												<th>Tujuan Surat</th>
												<th>Jenis Surat</th>
												<th style="width: 16%">Aksi</th>
											</tr>
											</thead>
											<tbody>
											<?php $__currentLoopData = $surat_keluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e(($surat_keluar ->currentpage()-1) * $surat_keluar ->perpage() + $loop->index + 1); ?></td>
												<td><?php echo e(date('d-m-Y', strtotime($v->tanggal_surat))); ?></td>
												<td><?php echo e($v->perihal); ?></td>
												<td><?php echo e($v->nomor_surat); ?></td>
												<td><?php echo e($v->tujuan); ?></td>
												<td><?php echo e($v->klasifikasi->nama); ?></td>
												<td>
													<a href="<?php echo e(url('/surat_keluar/edit/'.$v->id )); ?>" class="btn btn-xs btn-warning">Edit</a>
													<a href="<?php echo e(url('/surat_keluar/hapus/'.$v->id )); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div><br>
									<div align="right"><?php echo e($surat_keluar->appends(Request::only('search','klasifikasi_id'))->links()); ?></div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/surat_keluar/index.blade.php ENDPATH**/ ?>