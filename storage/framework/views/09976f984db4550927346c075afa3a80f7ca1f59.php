
<?php $__env->startSection('konten'); ?>
        <main class="content">
				<div class="container-fluid p-0">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h3><?php echo e(__('USER')); ?></h3>
								</div>
								<div class="card-body">
									<form action="<?php echo e(url('/user/search')); ?>" method="GET">
									<div class="row">
										<div class="col-md-9">
											<a href="<?php echo e(url('/user/create')); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
											<a href="<?php echo e(url('/user')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
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
													<th>Nama User</th>
													<th>Email</th>
													<th>Group</th>
													<th style="width: 20%">#aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e(($user ->currentpage()-1) * $user ->perpage() + $loop->index + 1); ?></td>
													<td><?php echo e($v->name); ?></td>
													<td><?php echo e($v->email); ?></td>
													<td>
														<?php if($v->group==1): ?>
															<span class="label label-danger">Administrator</span>
														<?php elseif($v->group==2): ?>
															<span class="label label-warning">Pegawai</span>
														<?php endif; ?>
													</td>
													<td>
														<a href="<?php echo e(url('/user/edit/'.$v->id )); ?>" class="btn btn-xs btn-flat btn-warning">Edit</a>
														<?php if($v->id!=1): ?>
															<a href="<?php echo e(url('/user/hapus/'.$v->id )); ?>" class="btn btn-xs btn-flat btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
														<?php endif; ?>
													</td>
												</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</tbody>
										</table>
									</div><br>
									<div align="right"><?php echo e($user->appends(Request::only('search'))->links()); ?></div>
								</div>
							</div>
						</div>
					</div>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				</div>
			</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/user/index.blade.php ENDPATH**/ ?>