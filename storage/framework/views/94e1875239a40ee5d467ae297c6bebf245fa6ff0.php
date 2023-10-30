<p class="fs-32 discount-price">
    <?php echo e($book->getPrice($type)); ?>₸
    <?php if($sale_percentage>0): ?>
        <span class="old-price"><?php echo e($price?$price.' ₸':''); ?></span>
    <?php endif; ?>
</p>
<p class="fs-15">
    <small class="text-grey"><?php echo e(trans('book.discount_info', ['percent' => $sale_percentage])); ?></small>
</p>
<?php if($type=='paper'): ?>
    <p class="fs-15 text-grey">
        <a target="_blank" href="/page/6"><?php echo app('translator')->get('book.delivery_info_title'); ?></a>
    </p>
<?php elseif($type=='ebook'): ?>
    <b><?php echo app('translator')->get('book.ebook_warning_info'); ?></b>
<?php elseif($type=='audio'): ?>
    <b><?php echo app('translator')->get('book.audio_warning_info'); ?></b></p>
<?php endif; ?>

<?php if($type=='paper'): ?>
    <?php if($book->available): ?>
        <div class="btn__box d-flex align-items-center justify-content-center">
            <button onclick="buynow('paper',<?php echo e($book->book_id); ?>)" class="btn btn-blue" type="button"><?php echo app('translator')->get('book.buy_now'); ?></button>
            <button onclick="buy('paper',<?php echo e($book->book_id); ?>)" class="btn btn-border-blue" type="button">
                <i class="icons ic-basket"></i><?php echo app('translator')->get('book.to_cart'); ?></button>
            <a class="fav__box d-flex align-items-center justify-content-center" onclick="addToSelected(<?php echo e($book->book_id); ?>)">
                <i id="heart" class="<?php if(\Auth::user() && \App\Models\UserSelected::where([['user_id',\Auth::user()->user_id],['book_id',$book->book_id]])->first()): ?> selected <?php endif; ?> fas fa-heart"></i>
            </a>
        </div>
    <?php else: ?>
        <h3 style="color: red"><b><?php echo app('translator')->get('book.not_available'); ?></b></h3>
    <?php endif; ?>
<?php elseif($type=='ebook'): ?>

    <?php if(Auth::guest()): ?>
        <?php if($book->free): ?>
            <a class="btn btn-blue" type="button" target="_blank" href="/readbook/<?php echo e($book_id); ?>">
                <?php echo app('translator')->get('book.read'); ?>
            </a>
        <?php else: ?>
            <div class="d-flex">
                <?php if($book->subscribable): ?>
                    <a class="btn btn-blue" type="button" href="/buy-subscription">Купить подписку</a>

                <?php endif; ?>
                <button onclick="buynow('ebook',<?php echo e($book_id); ?>)" class="btn btn-blue" type="button">
                    <?php echo app('translator')->get('book.buy_now'); ?>
                </button>
            </div>
            <div class="d-flex">
                <a class="btn btn-border-blue" type="button" href="/giftpage/<?php echo e($book_id); ?>">
                    <i class="icons ic-pod"></i><?php echo app('translator')->get('book.podarit'); ?>
                </a>
                <button onclick="buy('ebook',<?php echo e($book->book_id); ?>)" class="btn btn-border-blue" type="button">
                    <i class="icons ic-basket"></i><?php echo app('translator')->get('book.to_cart'); ?>
                </button>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if(check_access(\Auth::user(),$book_id)['success']): ?>
            <button class="btn btn-blue" type="button"  title="Тек мобильді қосымшада оқи аласыздар" onclick="readbook_clicked_on_browser()">
                <?php echo app('translator')->get('book.read'); ?>
            </button>
            <a class="btn btn-border-blue" type="button" href="/giftpage/<?php echo e($book_id); ?>">
                <i class="icons ic-pod"></i><?php echo app('translator')->get('book.podarit'); ?>
            </a>
        <?php else: ?>
            <?php if($book->subscribable): ?>
                <a class="btn btn-blue" type="button" href="/buy-subscription">Купить подписку</a>
            <?php endif; ?>
            <button onclick="buynow('ebook',<?php echo e($book_id); ?>)" class="btn btn-blue" type="button">
                <?php echo app('translator')->get('book.buy_now'); ?>
            </button>
            <a class="btn btn-border-blue" type="button" href="/giftpage/<?php echo e($book_id); ?>">
                <i class="icons ic-pod"></i><?php echo app('translator')->get('book.podarit'); ?>
            </a>
            <button onclick="buy('ebook',<?php echo e($book->book_id); ?>)" class="btn btn-border-blue" type="button">
                <i class="icons ic-basket"></i><?php echo app('translator')->get('book.to_cart'); ?>
            </button>
        <?php endif; ?>
    <?php endif; ?>
<?php elseif($type=='audio'): ?>
    <?php if(isset($audio) && $audio): ?>
        <?php echo app('translator')->get('book.audio_bought'); ?>
    <?php else: ?>
        <button onclick="buynow('audio',<?php echo e($book_id); ?>)" class="btn btn-blue" type="button"><?php echo app('translator')->get('book.buy_now'); ?></button>
        <button onclick="buy('audio',<?php echo e($book_id); ?>)" class="btn btn-border-blue" type="button">
            <i class="icons ic-basket"></i><?php echo app('translator')->get('book.to_cart'); ?>
        </button>
    <?php endif; ?>
<?php endif; ?>
<?php echo $__env->make('includes.paymentinfo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/includes/bookinfo.blade.php ENDPATH**/ ?>