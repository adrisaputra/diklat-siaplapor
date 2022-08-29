
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3><?php echo e(__('PEGAWAI')); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/pegawai/search')); ?>" method="GET">
									<div class="row">
										<div class="col-md-9">
											<?php if(Auth::user()->group==1): ?>
												<a href="<?php echo e(url('/pegawai/create')); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
												<a href="<?php echo e(url('/pegawai')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
											<?php else: ?>
												<a href="<?php echo e(url('/pegawai')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>    
											<?php endif; ?>
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
												<th style="width: 60px">No</th>
												<th>NIP</th>
												<th>Nama Pegawai</th>
												<th>Jenis Kelamin</th>
												<th>Foto</th>
												<?php if(Auth::user()->group==1): ?>
													<th style="width: 22%">#aksi</th>
												<?php endif; ?>
											</tr>
											</thead>
											<tbody>
											<?php $__currentLoopData = $pegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e(($pegawai ->currentpage()-1) * $pegawai ->perpage() + $loop->index + 1); ?></td>
												<td><?php echo e($v->nip); ?></td>
												<td><?php echo e($v->nama_pegawai); ?></td>
												<td><?php echo e($v->jenis_kelamin); ?></td>
												
												<td><center>
												<?php if($v->foto): ?>
															<img src="<?php echo e(asset('storage/upload/foto_pegawai/thumbnail/'.$v->foto)); ?>" class="img-circle" alt="User Image"  width="150px" height="150px">
														<?php else: ?>
															<img src="<?php echo e(asset('upload/user/15.jpg')); ?>" class="img-circle" alt="User Image" width="150px" height="150px">
														<?php endif; ?>
												</td>
												<?php if(Auth::user()->group==1): ?>
												<td>
													<a href="<?php echo e(url('/arsip_digital/'.$v->id )); ?>" class="btn btn-xs btn-primary btn-block">Arsip Digital</a>
													<a href="<?php echo e(url('/pegawai/edit/'.$v->id )); ?>" class="btn btn-xs btn-warning btn-block">Edit</a>
													<a href="<?php echo e(url('/pegawai/hapus/'.$v->id )); ?>" class="btn btn-xs btn-danger btn-block" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
												<?php endif; ?>
											</tr>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div><br>
									<div align="right"><?php echo e($pegawai->appends(Request::only('search'))->links()); ?></div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/pegawai/index.blade.php ENDPATH**/ ?>