
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
						  	<form action="<?php echo e(url('/proposal/search')); ?>" method="GET">
							<div class="row">
								<div class="col-md-9">
									<a href="<?php echo e(url('/proposal')); ?>" class="btn btn-warning btn-flat" title="Refresh halaman">Refresh</a>
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
                                                    <th style="width: 20%">#aksi</th>
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
											<td><?php echo e($v->status); ?></td>
											<td>
												<a href="#" class="btn btn-sm btn-flat btn-info" data-toggle="modal" data-target="#default">Detail</a>
                                                <?php if(Auth::user()->group == 3): ?>
												    <a href="<?php echo e(url('proposal/edit/'.$v->id )); ?>" class="btn btn-sm btn-flat btn-warning">Edit</a>
                                                <?php endif; ?>
											</td>
										</tr>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel1" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="basicModalLabel1">Detail</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Tanggal Usul</label>
                                                            <label class="col-form-label col-sm-8"> : <?php echo e(date('d-m-Y', strtotime($v->date))); ?></label>
                                                        </div>
    
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Jenis Usul</label>
                                                            <label class="col-form-label col-sm-8"> : <?php echo e($v->type); ?></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Tentang</label>
                                                            <label class="col-form-label col-sm-8"> : <?php echo e($v->about); ?></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Surat Pengantar</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="<?php echo e(asset('upload/cover_letter/'.$v->cover_letter )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Telaah Staf</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="<?php echo e(asset('upload/review_staff/'.$v->review_staff )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Nota Dinas</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="<?php echo e(asset('upload/official_memo/'.$v->official_memo )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Konsep Persetujuan Naskah Dinas</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="<?php echo e(asset('upload/approval_concept/'.$v->approval_concept )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right"> Draf SK/Pergub/Perda</label>
                                                            <label class="col-form-label col-sm-8"> : <a href="<?php echo e(asset('upload/draft/'.$v->draft )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></label>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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