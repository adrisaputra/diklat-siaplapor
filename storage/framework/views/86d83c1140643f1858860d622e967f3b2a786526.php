
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
						  	<form action="<?php echo e(url('/agenda/search')); ?>" method="GET">
							<div class="row">
								<div class="col-md-9">
									<a href="<?php echo e(url('/agenda/create')); ?>" class="btn btn-success btn-flat" title="Tambah Data">Tambah</a>
									<a href="<?php echo e(url('/agenda')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
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
								<div class="alert alert-success mb-2" role="alert">
									<?php echo e($message); ?>

								</div>
							<?php endif; ?>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-info white">
                                                <tr>
                                                    <th style="width: 60px">No</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Tanggal Surat</th>
                                                    <th>No. Surat</th>
                                                    <th>Asal Surat</th>
                                                    <th>Tentang</th>
                                                    <th>Diproses</th>
                                                    <th style="width: 20%">#aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
								   	 	<?php $__currentLoopData = $agenda; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e(($agenda ->currentpage()-1) * $agenda ->perpage() + $loop->index + 1); ?></td>
											<td><?php echo e(date('d-m-Y', strtotime($v->date_of_entry))); ?></td>
											<td><?php echo e(date('d-m-Y', strtotime($v->letter_date))); ?></td>
											<td><?php echo e($v->letter_number); ?></td>
											<td><?php echo e($v->letter_from); ?></td>
											<td><?php echo e($v->about); ?></td>
											<td><?php echo e($v->on_process); ?></td>
											<td>
												<a href="<?php echo e(url('agenda/edit/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-warning">Edit</a>
												<a href="<?php echo e(url('agenda/hapus/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-danger" onclick="return confirm('Anda Yakin ?');">Hapus</a>
											</td>
										</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
								<div align="right"><?php echo e($agenda->appends(Request::only('search'))->links()); ?></div>
                                    </div>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/agenda/index.blade.php ENDPATH**/ ?>