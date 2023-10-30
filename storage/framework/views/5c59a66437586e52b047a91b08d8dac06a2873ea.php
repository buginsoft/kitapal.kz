<?php $__env->startSection('breadcrumb','Книги пользователя'); ?>
<?php $__env->startSection('page_level_css'); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2{
            width: 100% !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table_title','Книги пользователя'); ?>

<?php $__env->startSection('table'); ?>
    <div class="page-wrapper" style="min-height: 319px;">
        <div class="container-fluid">
            <div class="row white-bg">
                <div class="col-lg-12 col-md-12">

                    <input type="hidden" name="_token" value="ujW0BcLSH5irKyD6kS1P8Vwc8I4N6m2UsDRvwmKh">
                    <div class="form-group col-lg-4">

                        <div class="form-group">
                            <label>Книги</label>
                            <select id="ebook" class="js-example-basic-single" name="ebook" >
                                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option  value="<?php echo e($item->book_id); ?>"><?php echo e($item->book_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" onclick="addBook(1,'add')">Сохранить</button>
                        </div>
                    </div>

                    <table id="showed" class="table table-bordered table-striped">
                        <thead>
                        <tr style="border: 1px">
                            <th>Название</th>
                            <th>Удалить</th>
                        </thead>

                        <tbody id="tbody">
                        <?php $__currentLoopData = $userebooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->book_name); ?> </td>
                                <td><button onclick="addBook(<?php echo e($value->book_id); ?>,'delete')">Удалить</button></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        function addBook(book_id,action){
            if(action=='add'){
                var bookid =$('#ebook').val();
            }
            else if(action=='delete'){
                var bookid =book_id;
            }
            $.ajax({
                method: "POST",
                url: "/admin/add",
                data:{
                    'user_id':'<?php echo e($user_id); ?>',
                    'book_id': bookid,
                    'action':action
                },
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                let text='';
                msq.forEach((element) => {
                    text=text+' <tr><td>'+element.book_name+'</td> <td><button onclick="addBook('+element.book_id+',\'delete\')">Удалить</button></td></tr>'
                });
                $("#tbody").html(text);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/users/user_ebooks.blade.php ENDPATH**/ ?>