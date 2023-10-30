<?php $__env->startSection('css'); ?>
    <style>
        .book_photo{
            width: 65px;
            height: 85px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table_title','Книги'); ?>
<?php $__env->startSection('breadcrumb','Книги'); ?>
<?php $__env->startSection('add_button'); ?>
    <div class="d-flex py-3 px-2">

        <form action="/discount-to-all-books" method="post" class="form-input-sale-percent">
            <?php echo csrf_field(); ?>
            <input name="percentage" type="number" placeholder="Процент скидки">
            <button type="submit" id="form-input-submit-sale" title="Отправить">
                <svg width="18" height="18"  viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5625 16.3125L17.4375 9L0.5625 1.6875V7.3125L11.8125 9L0.5625 10.6875V16.3125Z" fill="white"/>
                </svg>
            </button>
        </form>

        <form action="/import" method="post" enctype="multipart/form-data" class="form-input-file-book">
            <?php echo csrf_field(); ?>
            <input name="books" type="file" id="file-input-book" style="">
            <label class="book-file-attach" for="file-input-book" title="Прикрепить файл">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="20" fill="#3875EB"/>
                    <path d="M28.4471 11.552C27.4502 10.5581 26.0999 10 24.6921 10C23.2844 10 21.9341 10.5581 20.9371 11.552L14.919 17.5717C14.6094 17.8794 14.3639 18.2456 14.1969 18.6489C14.0299 19.0522 13.9446 19.4847 13.946 19.9212C13.946 20.357 14.0319 20.7885 14.1988 21.191C14.3657 21.5936 14.6103 21.9593 14.9186 22.2672C15.2269 22.5752 15.5929 22.8193 15.9956 22.9857C16.3984 23.1521 16.8299 23.2375 17.2657 23.237C18.1152 23.237 18.9634 22.9158 19.6111 22.268L22.4277 19.4526C22.9247 18.9544 23.2038 18.2794 23.2038 17.5757C23.2038 16.872 22.9247 16.197 22.4277 15.6988L17.7342 20.3911C17.6096 20.5157 17.4406 20.5857 17.2644 20.5857C17.0881 20.5857 16.9191 20.5157 16.7945 20.3911C16.6699 20.2665 16.5999 20.0974 16.5999 19.9212C16.5999 19.7449 16.6699 19.5759 16.7945 19.4513L22.8139 13.429C23.3129 12.9324 23.9882 12.6536 24.6921 12.6536C25.396 12.6536 26.0713 12.9324 26.5703 13.429C27.067 13.9273 27.3459 14.6023 27.3459 15.3059C27.3459 16.0095 27.067 16.6844 26.5703 17.1828L20.5482 23.2051L17.1834 26.57C16.6851 27.0668 16.0102 27.3457 15.3066 27.3457C14.603 27.3457 13.928 27.0668 13.4297 26.57C12.9324 26.072 12.653 25.397 12.653 24.6931C12.653 23.9893 12.9324 23.3142 13.4297 22.8162L13.5558 22.6888C12.9506 21.8729 12.6239 20.884 12.624 19.8681L11.5529 20.9393C10.5585 21.9355 10 23.2856 10 24.6931C10 26.1007 10.5585 27.4508 11.5529 28.447C12.5868 29.481 13.9474 30 15.3066 30C16.6657 30 18.0263 29.481 19.0602 28.447L28.4471 19.0597C29.4415 18.0635 30 16.7135 30 15.3059C30 13.8983 29.4415 12.5482 28.4471 11.552V11.552Z" fill="white"/>
                </svg>
                <div id="file-input-name"></div>
            </label>
            <i class="fa fa-times-circle remove"></i>
            <button type="submit" id="form-input-submit-book">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.5 1.5L8.25 9.75L16.5 1.5ZM16.5 1.5L11.25 16.5L8.25 9.75L1.5 6.75L16.5 1.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </form>

        <a href="/admin/book/create" class="align-self-center text-right mr-2" title="Добавить">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40 20C40 25.3043 37.8929 30.3914 34.1421 34.1421C30.3914 37.8929 25.3043 40 20 40C14.6957 40 9.60859 37.8929 5.85786 34.1421C2.10714 30.3914 0 25.3043 0 20C0 14.6957 2.10714 9.60859 5.85786 5.85786C9.60859 2.10714 14.6957 0 20 0C25.3043 0 30.3914 2.10714 34.1421 5.85786C37.8929 9.60859 40 14.6957 40 20V20ZM10 20C10 20.3315 10.1317 20.6495 10.3661 20.8839C10.6005 21.1183 10.9185 21.25 11.25 21.25H18.75V28.75C18.75 29.0815 18.8817 29.3995 19.1161 29.6339C19.3505 29.8683 19.6685 30 20 30C20.3315 30 20.6495 29.8683 20.8839 29.6339C21.1183 29.3995 21.25 29.0815 21.25 28.75V21.25H28.75C29.0815 21.25 29.3995 21.1183 29.6339 20.8839C29.8683 20.6495 30 20.3315 30 20C30 19.6685 29.8683 19.3505 29.6339 19.1161C29.3995 18.8817 29.0815 18.75 28.75 18.75H21.25V11.25C21.25 10.9185 21.1183 10.6005 20.8839 10.3661C20.6495 10.1317 20.3315 10 20 10C19.6685 10 19.3505 10.1317 19.1161 10.3661C18.8817 10.6005 18.75 10.9185 18.75 11.25V18.75H11.25C10.9185 18.75 10.6005 18.8817 10.3661 19.1161C10.1317 19.3505 10 19.6685 10 20Z" fill="#8DBF42"/>
            </svg>
        </a>

        <a href="/admin/export/book" title="Экспорт">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" fill="white"/>
                <circle cx="20" cy="20" r="20" fill="#21A366"/>
                <g clip-path="url(#clip0_957_17)">
                    <path d="M29.1458 20.3521H25.1699V18.3641H29.1458V20.3521ZM29.1458 21.488H25.1699V23.476H29.1458V21.488ZM29.1458 12.1162H25.1699V14.1042H29.1458V12.1163V12.1162ZM29.1458 15.2401H25.1699V17.2281H29.1458V15.2401ZM29.1458 24.6119H25.1699V26.5999H29.1458V24.6119V24.6119ZM31.892 28.5311C31.7785 29.1218 31.0685 29.1359 30.5942 29.1559H21.762V31.7118H19.9984L7 29.4398V9.56314L20.0751 7.28833H21.762V9.55176H30.2903C30.7703 9.57163 31.2985 9.53755 31.716 9.82437C32.0085 10.2447 31.9801 10.7786 32 11.2614L31.9886 26.0461C31.9745 26.8725 32.0653 27.716 31.892 28.5311V28.5311ZM17.414 24.0752C16.6302 22.4849 15.8322 20.9058 15.0512 19.3154C15.8237 17.7677 16.5848 16.2143 17.3431 14.6608C16.6984 14.692 16.0537 14.7318 15.4119 14.7772C14.9319 15.9444 14.3725 17.0804 13.9976 18.2874C13.6483 17.1486 13.1854 16.0523 12.7623 14.9419C12.1375 14.976 11.5126 15.0129 10.8879 15.0499C11.5467 16.504 12.2482 17.938 12.8872 19.4006C12.1346 20.8206 11.4303 22.2605 10.7004 23.689C11.3224 23.7145 11.9443 23.7401 12.5663 23.7486C13.0093 22.6183 13.5603 21.5306 13.9465 20.3776C14.293 21.6158 14.8808 22.7603 15.3636 23.9445C16.048 23.9929 16.7296 24.0355 17.4141 24.0752H17.414ZM30.6455 10.9005H21.762V12.1162H24.034V14.1042H21.762V15.2401H24.034V17.2281H21.762V18.3641H24.034V20.3521H21.762V21.488H24.034V23.476H21.762V24.6119H24.034V26.5999H21.762V27.9132H30.6455V10.9005Z" fill="white"/>
                </g>
                <defs>
                    <clipPath id="clip0_957_17">
                        <rect width="25" height="25" fill="white" transform="translate(7 7)"/>
                    </clipPath>
                </defs>
            </svg>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table'); ?>
    <?php echo $__env->make('admin.includes.search',['base_url'=>'/admin/book'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <table id="showed" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th style="width: 30px">ID</th>
            <th>Картинка</th>
            <th>Название</th>
            <th>Жанр</th>
            <th>Скидка</th>
            <th></th>
            <th>В архиве</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($value->book_id); ?></td>
                <td><img class="book_photo" src="<?php echo e($value->main_image()?$value->main_image()->path:''); ?>" alt=""></td>
                <td><?php echo e($value->book_name); ?></td>
                <td>
                    <?php $__currentLoopData = $value->genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$genres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-green">
                                <a href="/catalog/<?php echo e($genres->genre_id); ?>"><?php echo e($genres['genre_name_'.app()->getLocale()]); ?> <?php if(!$loop->last): ?>,<?php endif; ?></a><br>
                            </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td>
                    <form action="/admin/change-percentage/<?php echo e($value->book_id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <input  class="form-control" style="max-width:60px;" name="percentage" value="<?php echo e($value->sale_percentage); ?>">
                    </form>
                </td>
                <td>
                    <a href="/admin/book/<?php echo e($value->book_id); ?>/edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                </td>
                <td>
                    <form method="post" action="/admin/archive-status">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="book_id" value="<?php echo e($value->book_id); ?>">
                        <input type="checkbox" name="status" value="1" <?php echo e($value->in_archive?'checked':''); ?> onChange="this.form.submit()">
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($book->links()); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/book/book.blade.php ENDPATH**/ ?>