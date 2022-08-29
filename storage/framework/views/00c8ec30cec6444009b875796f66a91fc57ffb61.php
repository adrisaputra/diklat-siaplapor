
<?php $__env->startSection('konten'); ?>
    <main class="content">
        <div class="container-fluid p-0">
            
            <div class="row">
                <div class="col-12 col-sm-12 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="mb-2">
                                        Selamat Datang Di Sistem E-Nomor<br>
                                        Kantor Imigrasi Kendari
                                    </h3>
                                    <div class="mb-0">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-primary" data-feather="mail"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2"><?php echo e($surat_masuk); ?></h3>
                                    <div class="mb-0">Jumlah Surat Masuk</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-warning" data-feather="mail"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2"><?php echo e($surat_keluar); ?></h3>
                                    <div class="mb-0">Jumlah Surat keluar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl d-flex">
                    <div class="card flex-fill">
                        <div class="card-body py-4">
                            <div class="media">
                                <div class="d-inline-block mt-2 mr-3">
                                    <i class="feather-lg text-danger" data-feather="user"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="mb-2"><?php echo e($user); ?></h3>
                                    <div class="mb-0">Jumlah User</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\e-nomor\resources\views/admin/beranda.blade.php ENDPATH**/ ?>