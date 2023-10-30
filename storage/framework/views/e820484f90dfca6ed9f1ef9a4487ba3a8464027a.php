<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('auth.login'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(isset($error)): ?>
        <script>
            Swal.fire(
                '<?php echo app('translator')->get('status.error'); ?>',
                '<?php echo e($error); ?>',
                'error'
            );
        </script>
    <?php endif; ?>
    <div class="content">
        <div class="container">
            <div class="row section-row">
                <div class="col-md-offset-4 col-md-4">
                    <p class="fs-24 mb-25"><b><?php echo app('translator')->get('auth.login'); ?></b></p>
                    <div class="input-prof login-input mb-25">
                        <form method="POST" action="/login">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <div class="formItem <?php if($errors->has('email')): ?> errorBox <?php endif; ?>">
                                <input style="font-size: 16px;"
                                       class="form-control input-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email"
                                       placeholder="<?php echo e(__('E-Mail')); ?>" name="email" value="<?php echo e(old('email')); ?>"
                                       required autocomplete="email" autofocus>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="formItem <?php if($errors->has('password')): ?> errorBox <?php endif; ?>">
                                <input name="password" required autocomplete="current-password"
                                       class="form-control input-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       type="password"
                                       placeholder="<?php echo app('translator')->get('auth.password'); ?>">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <p class="text-right"><a class="text-green" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('auth.forgot')); ?></a></p>
                            <button class="btn btn-lg btn-block btn-blue" type="submit"><?php echo app('translator')->get('auth.login'); ?></button>
                            <a href="/register" class="btn btn-lg btn-block btn-border-blue"
                               type="button"><?php echo app('translator')->get('auth.register'); ?></a>
                            <div class="log_icon_text_box">
                                <p>Войти через социальные сети</p>
                            <div class="log_icon_block d-flex">
                                <a href="/login/google" class="btn btn-lg btn-block btn-border-blue log__icon"
                                   type="button"><span class="log__icon"><img src="img/icons/icons8-google-48.png" alt=""></span></a>
                                <a href="/login/facebook" class="btn btn-lg btn-block btn-border-blue log__icon"
                                   type="button"><span class="log__icon"><i class="fab fa-facebook-f"></i></span></a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/auth/login.blade.php ENDPATH**/ ?>