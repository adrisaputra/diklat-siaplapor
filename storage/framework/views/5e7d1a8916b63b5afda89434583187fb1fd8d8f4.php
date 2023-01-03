
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
						  	<form action="<?php echo e(url('/'.Request::segment(1).'/search')); ?>" method="GET">
							<div class="row">
								<div class="col-md-9">
									<a href="<?php echo e(url('/'.Request::segment(1))); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
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
                                                    <th>Tanggal Usul</th>
                                                    <th>Jenis Usul</th>
                                                    <th>Tentang</th>
                                                    <?php if(Auth::user()->group == 1): ?>
                                                        <td>OPD</td>
                                                    <?php endif; ?>
                                                    <th>Status</th>
                                                    <?php if(Request::segment(1)!="proposal_done"): ?>
                                                        <th style="width: 20%">#aksi</th>
                                                    <?php endif; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
								   	 	<?php $__currentLoopData = $proposal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e(($proposal ->currentpage()-1) * $proposal ->perpage() + $loop->index + 1); ?></td>
											<td><?php echo e(date('d-m-Y', strtotime($v->date))); ?></td>
											<td><?php echo e($v->type); ?></td>
											<td><?php echo e($v->about); ?></td>
                                            <?php if(Auth::user()->group == 1): ?>
											    <td><?php echo e($v->office->name); ?></td>
                                            <?php endif; ?>
											<td>
                                                <?php if(Auth::user()->group == 1): ?>
                                                    
                                                    <?php if($v->status=="Masuk"): ?>
                                                        <div class="badge badge-success">Usulan Masuk</div>
                                                    <?php endif; ?>
                                                    <?php if(Request::segment(1)=="proposal_process"): ?>
                                                        <div class="badge badge-warning">Sedang Diproses</div>
                                                    <?php endif; ?>
                                                    <?php if($v->status=="Selesai"): ?>
                                                        <div class="badge badge-success">Telah Diverifikasi dan Menunggu Perbaikan Admin</div>
                                                    <?php endif; ?>
                                                <?php elseif(Auth::user()->group == 3): ?>
                                                    <?php if($v->status=="Masuk"): ?>
                                                        <div class="badge badge-success">Telah Dikirim Ke Admin</div>
                                                    <?php endif; ?>
                                                    <?php if(Request::segment(1)=="proposal_process"): ?>
                                                        <div class="badge badge-warning">Sedang Diproses Oleh Admin</div>
                                                    <?php endif; ?>
                                                    <?php if(Request::segment(1)=="proposal_revision"): ?>
                                                        <div class="badge badge-danger">Usul Tidak Lengkap</div>
                                                    <?php endif; ?>
                                                    <?php if($v->status=="Selesai"): ?>
                                                        <div class="badge badge-success">Telah Diverifikasi dan Menunggu Perbaikan Admin</div>
                                                    <?php endif; ?>
                                                <?php endif; ?>    
                                            </td>
                                            
                                            <?php if($v->status!="Selesai"): ?>
											<td>
                                                <?php if(Auth::user()->group == 1): ?>
                                                    <?php if($v->status=="Masuk"): ?>
												        <a href="<?php echo e(url(Request::segment(1).'/control_sheet/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-success">Verifikasi</a>
                                                    <?php elseif($v->status=="Proses"): ?>
												        <a href="<?php echo e(url(Request::segment(1).'/disposition_sheet/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-primary btn-block">Cetak Disposisi</a>
												        <a href="<?php echo e(url(Request::segment(1).'/disposition/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-success btn-block">Proses Disposisi</a>
                                                    <?php endif; ?>
                                                <?php elseif(Auth::user()->group == 3): ?>
                                                    <?php if($v->status=="Perbaiki"): ?>
												        <a href="<?php echo e(url(Request::segment(1).'/edit/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-warning">Perbaiki</a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(url(Request::segment(1).'/detail/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-info">Detail</a>
                                                    <?php endif; ?>
                                                <?php endif; ?>
											</td>
                                            <?php endif; ?>
										</tr>
                                        
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
								        <div align="right"><?php echo e($proposal->appends(Request::only('search'))->links()); ?></div>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/proposal/index.blade.php ENDPATH**/ ?>