
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
									<form action="<?php echo e(url('/'.Request::segment(1).'/search/'.$pegawai[0]->id)); ?>" method="GET">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label >NIP</label>
												<input type="text" class="form-control" placeholder="NIP" value="<?php echo e($pegawai[0]->nip); ?>" disabled>
											</div>

										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label >Nama Pegawai</label>
												<input type="text" class="form-control" placeholder="Nama Pegawai" value="<?php echo e($pegawai[0]->nama_pegawai); ?>" disabled>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-9">
											<a href="<?php echo e(url('/'.Request::segment(1).'/create/'.$pegawai[0]->id)); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<a href="<?php echo e(url('/'.Request::segment(1).'/'.$pegawai[0]->id)); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>    
											<a href="<?php echo e(url('/pegawai')); ?>" class="btn btn-danger btn-flat" title="Kembali">Kembali</a>  
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
												<th>Nama Arsip</th>
												<th>Arsip</th>
												<th style="width: 20%">#aksi</th>
											</tr>
											</thead>
											<tbody>
											<?php $__currentLoopData = $arsip_digital; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<td><?php echo e(($arsip_digital ->currentpage()-1) * $arsip_digital ->perpage() + $loop->index + 1); ?></td>
												<td><?php echo e($v->nama_arsip); ?></td>
												<td>
													<?php if($v->arsip_digital): ?>
														<a href="<?php echo e(asset('upload/arsip_digital/'.$v->arsip_digital)); ?>" class="btn btn-sm btn-primary" >Download File</a>
													<?php endif; ?>
												</td>
												<td>
													<a href="<?php echo e(url('/'.Request::segment(1).'/edit/'.$pegawai[0]->id.'/'.$v->id )); ?>" class="btn btn-xs btn-flat btn-warning">Edit</a>
													<a href="<?php echo e(url('/'.Request::segment(1).'/hapus/'.$pegawai[0]->id.'/'.$v->id )); ?>" class="btn btn-xs btn-flat btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
												</td>
											</tr>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div><br>
									<div align="right"><?php echo e($arsip_digital->appends(Request::only('search'))->links()); ?></div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/admin/arsip_digital/index.blade.php ENDPATH**/ ?>