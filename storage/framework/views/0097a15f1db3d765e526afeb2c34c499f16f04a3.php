
<?php $__env->startSection('konten'); ?>
    
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">

                
            </div>
            <div class="content-body">
                <!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                     <p class="animate fadeUp " style="font-size:28px;font-weight:bold;color:white;margin-top: -20px;margin-bottom: 10px;">Selamat Datang di Siprokumda (Sistem Infromasi Produk Hukum Daerah) </p>
                    </div>
                </div>
                <div class="row">
                <?php if(Auth::user()->group == 1 || Auth::user()->group == 2): ?>
                    <div class="col-lg-3 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card pull-up bg-gradient-directional-blue">
                                    <div class="card-header bg-hexagons-blue">
                                        <h4 class="card-title white">Jumlah Agenda</h4>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons-blue">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-right mt-1">
                                                    <h3 class="font-large-2 white"><?php echo e($agenda); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card pull-up bg-gradient-directional-success">
                                    <div class="card-header bg-hexagons-success">
                                        <h4 class="card-title white">Jumlah Usul OPD</h4>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons-success">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-right mt-1">
                                                    <h3 class="font-large-2 white"><?php echo e($proposal); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card pull-up bg-gradient-directional-yellow">
                                    <div class="card-header bg-hexagons-yellow">
                                        <h4 class="card-title white">Jumlah OPD</h4>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons-yellow">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-right mt-1">
                                                    <h3 class="font-large-2 white"><?php echo e($office); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card pull-up bg-gradient-directional-red">
                                    <div class="card-header bg-hexagons-red">
                                        <h4 class="card-title white">Jumlah User</h4>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons-red">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-right mt-1">
                                                    <h3 class="font-large-2 white"><?php echo e($user); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php elseif(Auth::user()->group == 3): ?>

                    <div class="col-lg-3 col-md-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card pull-up bg-gradient-directional-success">
                                    <div class="card-header bg-hexagons-success">
                                        <h4 class="card-title white">Jumlah Usul OPD</h4>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons-success">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-right mt-1">
                                                    <h3 class="font-large-2 white"><?php echo e($proposal); ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php endif; ?> 
                <!--/ Revenue, Hit Rate & Deals -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-siaplapor\resources\views/admin/beranda.blade.php ENDPATH**/ ?>