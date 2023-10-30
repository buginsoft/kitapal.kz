
<div id="city_wrapper" class="col-sm-6">
    <select id="city" class="form-control" name="city">
        <?php $__currentLoopData = \App\Models\City::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option <?php if(!empty($address)&& ($address->city == $item->id)): ?>
                    selected
                    <?php endif; ?>  value="<?php echo e($item->id); ?>">
                <?php echo e($item['text_'.App::getLocale()]); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="naselenny_punkt" class="form-control" type="text"
               name="naselenny_punkt"
               placeholder="<?php echo app('translator')->get('Profile.naselenny_punkt'); ?>"
               value="<?php echo e((!empty($address))?$address->naselenny_punkt:''); ?>">
    </div>
</div>
<div class="col-sm-6">
    <div id="street_wrapper" class="formItem">
        <input class="form-control" type="text" id="street" name="street"
               placeholder="<?php echo app('translator')->get('Profile.street'); ?>"
               value="<?php echo e((!empty($address))?$address->street:''); ?>">
        <?php $__errorArgs = ['street'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback" role="alert">
                                                        <strong>* <?php echo e($message); ?></strong>
                                                    </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="col-sm-6">
    <div id="home_wrapper" class="formItem">
        <input class="form-control" type="text" id="home" name="home"
               placeholder="<?php echo app('translator')->get('Profile.home'); ?>"
               value="<?php echo e((!empty($address))?$address->home:''); ?>">
        <?php $__errorArgs = ['home'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback" role="alert">
                                                        <strong>* <?php echo e($message); ?></strong>
                                                    </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="podezd" class="form-control" type="text" name="podezd"
               placeholder="<?php echo app('translator')->get('Profile.podezd'); ?>"
               value="<?php echo e((!empty($address))?$address->podezd:''); ?>">
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="kvartira" class="form-control" type="text"
               name="kvartira"
               placeholder="<?php echo app('translator')->get('Profile.kvartira'); ?>"
               value="<?php echo e((!empty($address))?$address->kvartira:''); ?>">
    </div>
</div>
<div class="col-sm-6">
    <div class="formItem">
        <input id="post_index" class="form-control" type="text"
               name="post_index"
               placeholder="<?php echo app('translator')->get('Profile.post_index'); ?>"
               value="<?php echo e((!empty($address))?$address->post_index:''); ?>">
        <?php $__errorArgs = ['post_index'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <span class="invalid-feedback" role="alert">
                                                        <strong>* <?php echo e($message); ?></strong>
                                                    </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/checkout/includes/address_change_form.blade.php ENDPATH**/ ?>