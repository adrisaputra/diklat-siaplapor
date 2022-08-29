
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
									<form action="<?php echo e(url('/arsip_biasa/search')); ?>" method="GET">
									<div class="row">
										<div class="col-md-9">
											<a href="<?php echo e(url('/arsip_biasa/create')); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<a href="<?php echo e(url('/arsip_biasa')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>										
										</div>
										<div class="col-md-3">
											<div class="input-group">
												<input type="text" class="form-control" name="search" placeholder="Cari Data">
												<span class="input-group-btn">
													<input type="submit" name="submit" class="btn btn-info btn-flat" value="Cari">
												</span>
											</div>
										</div>
									</div>
									</form><br>
									
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
												<th>No. Surat</th>
												<th style="width: 20%">Perihal</th>
												<th>Tanggal Surat</th>
												<th>Dokumen</th>
												<th style="width: 16%">Aksi</th>
											</tr>
											</thead>
											<tbody>
											<?php $__currentLoopData = $arsip_biasa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e(($arsip_biasa ->currentpage()-1) * $arsip_biasa ->perpage() + $loop->index + 1); ?></td>
												<td><?php echo e($v->nomor_arsip); ?></td>
												<td><?php echo e($v->perihal); ?></td>
												<td><?php echo e(date('d-m-Y', strtotime($v->tanggal_arsip))); ?></td>
												<td>
													<?php if($v->arsip): ?>
														<a href="<?php echo e(asset('upload/arsip/'.$v->arsip)); ?>" class="btn btn-sm btn-primary" >Download File</a>
													<?php endif; ?>
												</td>
												<td>
													<a href="<?php echo e(url('/arsip_biasa/edit/'.$v->id )); ?>" class="btn btn-xs btn-warning">Edit</a>
													<a href="<?php echo e(url('/arsip_biasa/hapus/'.$v->id )); ?>" class="btn btn-xs btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div><br>
									<div align="right"><?php echo e($arsip_biasa->appends(Request::only('search'))->links()); ?></div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/arsip_biasa/index.blade.php ENDPATH**/ ?>