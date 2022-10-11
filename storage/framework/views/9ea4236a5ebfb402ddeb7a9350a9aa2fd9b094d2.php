
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
                                    <h4 class="card-title">Detail <?php echo e(__($title)); ?></h4>
                                </div>
                                <p><center style="font-size:20px;"> LAMBAR KONTROL</center></p>
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> OPD/BIRO </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo e($proposal->office->name); ?>" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> NO. AGENDA REGISTRASI </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> TANGGAL MASUK SK </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo e(date('d-m-Y', strtotime($proposal->date))); ?>" readonly>
									</div>
								</div>
	
                                <div class="form-group row">
									<label class="col-form-label col-sm-3 text-sm-right"> TENTANG</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo e($proposal->about); ?>" readonly>
									</div>
								</div>

                                <table class="table">
                                    <thead class="bg-info white">
                                        <tr>
                                            <th>NO</th>
                                            <th>KELENGKAPAN PELAYANAN</th>
                                            <th>ADA</th>
                                            <th>TIDAK</th>
                                            <th>KETERANGAN</th>
                                        <tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td> Surat Pengantar</td>
                                            <td><a href="<?php echo e(asset('upload/cover_letter/'.$proposal->cover_letter )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                <?php if($proposal->status1=="Tidak Lengkap"): ?>
                                                    Tidak Lengkap
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($proposal->status1=="Tidak Lengkap"): ?>
                                                    $proposal->desc1
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Telaah Staf</td>
                                            <td><a href="<?php echo e(asset('upload/review_staff/'.$proposal->review_staff )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                <?php if($proposal->status2=="Tidak Lengkap"): ?>
                                                    Tidak Lengkap
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($proposal->status2=="Tidak Lengkap"): ?>
                                                    $proposal->desc2
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Nota Dinas</td>
                                            <td><a href="<?php echo e(asset('upload/official_memo/'.$proposal->official_memo )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                <?php if($proposal->status3=="Tidak Lengkap"): ?>
                                                    Tidak Lengkap
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($proposal->status3=="Tidak Lengkap"): ?>
                                                    $proposal->desc3
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Konsep Persetujuan Naskah Dinas</td>
                                            <td><a href="<?php echo e(asset('upload/approval_concept/'.$proposal->approval_concept )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                <?php if($proposal->status4=="Tidak Lengkap"): ?>
                                                    Tidak Lengkap
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($proposal->status4=="Tidak Lengkap"): ?>
                                                    $proposal->desc4
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Draft SK/Pergub/Perda</td>
                                            <td><a href="<?php echo e(asset('upload/draft/'.$proposal->draft )); ?>" target="blank" class="btn btn-sm btn-flat btn-info">Lihat File</a></td>
                                            <td>
                                                <?php if($proposal->status5=="Tidak Lengkap"): ?>
                                                    Tidak Lengkap
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($proposal->status5=="Tidak Lengkap"): ?>
                                                    $proposal->desc5
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr>
                                
                                

                                <hr>
                                
                                    <p><center style="font-size:20px;"> RIWAYAT HARMONISASI</center></p>

                                        <table class="table">
                                            <thead class="bg-info white">
                                                <tr>
                                                    <th>NAMA/NOMOR HP</th>
                                                    <th>TANGGAL PENGAMBILAN</th>
                                                    <th>TANGGAL PENGEMBALIAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php if($v->taker_name): ?>
                                                        <?php echo e($v->taker_name); ?>

                                                    <?php else: ?>
                                                        <?php echo e($v->depositor_name); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php if($v->taker_date!=NULL): ?> <?php echo e(date('d-m-Y', strtotime($v->taker_date))); ?> <?php endif; ?></td>
                                                <td><?php if($v->depositor_date!=NULL): ?> <?php echo e(date('d-m-Y', strtotime($v->depositor_date))); ?> <?php endif; ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>

                                
								<br><br>
								<div class="form-group row">
									<div class="col-sm-12 ml-sm-auto">
										<a href="<?php echo e(url('/'.Request::segment(1).'/print/'.$proposal->id)); ?>" class="btn btn-primary">Cetak</a>
										<a href="<?php echo e(url('/'.Request::segment(1))); ?>" class="btn btn-warning">Kembali</a>
									</div>
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/harmonization/detail.blade.php ENDPATH**/ ?>