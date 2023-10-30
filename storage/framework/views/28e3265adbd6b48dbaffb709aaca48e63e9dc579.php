

<?php $__env->startSection('table_title','Подписки описание'); ?>
<?php $__env->startSection('breadcrumb','Подписки описание'); ?>

<?php $__env->startSection('page_level_css'); ?>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal-new1 {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-new1-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .modal-new1-close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .modal-new1-close:hover,
    .modal-new1-close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('table'); ?>


        <button id="myBtn">Добавить</button>

        <!-- The Modal -->
        <div id="myModal" class="modal-new1">

            <!-- Modal content -->
            <div class="modal-new1-content">
                <span class="modal-new1-close">&times;</span>
                <form action="/admin/subscription-information" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="text" name="title_kz" placeholder="қазақша описание">
                    <input type="text" name="title_ru" placeholder="описание">
                    <input type="number" name="sort" placeholder="порядок">
                    <button type="submit">Добавить</button>
                </form>
            </div>

        </div>

    <div class="modal-dialog-centered fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin: auto; position: absolute;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg> ... </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text">Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros. Phasellus egestas sit amet velit sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit amet ullamcorper mi. </p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered mb-4">
        <thead>
        <tr style="border: 1px">
            <th>Название ру</th>
            <th>Название кз</th>
            <th>Порядок</th>
            <th>Удалить</th>
            <th>Изменить</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($value->title_ru); ?></td>
                <td><?php echo e($value->title_kz); ?></td>
                <td><?php echo e($value->sort); ?></td>
                <td>
                    <form action="/admin/subscription-information/<?php echo e($value->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('delete'); ?>
                        <button class="btn btn-error" type="submit">удалить</button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-warning" href="/admin/subscription-information/<?php echo e($value->id); ?>/edit">Изменить</a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_level_js'); ?>
<script>
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("modal-new1-close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/information/index.blade.php ENDPATH**/ ?>