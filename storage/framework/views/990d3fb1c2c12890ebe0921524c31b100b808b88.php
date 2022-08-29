<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-body">
            <div class="m-sm-4">
                <div class="text-center">
                    <img src="<?php echo e(asset('/upload/logo/logo.png')); ?>"class="img-fluid" style="max-width: 60%;height:100px">
                </div>
                <?php if($message = Session::get('status')): ?>
                <br>
                
                  <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-message">
                            <?php echo e($message); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                <form method="POST" action="<?php echo e(url('login_w')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label><?php echo e(__('Nama User')); ?></label>
                        <input type="name" class="form-control form-control-lg" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="email" autofocus placeholder="Masukkan Nama User">
                    </div>
                    <div class="form-group">
                        <label><?php echo e(__('Password')); ?></label>
                        <input type="password" class="form-control form-control-lg" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Masukkan Password">
                        
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg btn-primary"><?php echo e(__('Masuk')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\workspace\diklat-sipermen\resources\views/auth/login.blade.php ENDPATH**/ ?>