<style>
    .form__button{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn{
        box-shadow:unset !important;
    }
</style>
<?php echo $__env->yieldContent('page_level_css'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">

                            <div class="col-xl-12 col-md-12 col-sm-12 col-10">
                                <div class="form__button">
                                    <h4><?php echo $__env->yieldContent('table_title'); ?></h4>
                                    <?php echo $__env->yieldContent('add_button'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <?php echo $__env->yieldContent('table'); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        jQuery.each(["put", "delete"], function (i, method) {
            jQuery[method] = function (url, data, callback, type) {
                if (jQuery.isFunction(data)) {
                    type = type || callback;
                    callback = data;
                    data = undefined;
                }

                return jQuery.ajax({
                    url: url,
                    type: method,
                    dataType: type,
                    data: data,
                    success: callback
                });
            };
        });

        function remove(ob, id, model) {
            var answ = confirm("Вы действительно хотите удалить?");
            if (answ) {
                $.delete("/admin/" + model + "/" + id, {
                    _token: '<?php echo e(csrf_token()); ?>'
                }, function (result) {
                    if(result.error){
                        alert(result.error);
                    }
                    else {
                        $(ob).closest('tr').remove();
                    }
                });
            }
        }
    </script>
    <?php echo $__env->yieldContent('page_level_js'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/table.blade.php ENDPATH**/ ?>