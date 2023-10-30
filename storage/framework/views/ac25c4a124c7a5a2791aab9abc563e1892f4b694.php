<?php $__env->startSection('table_title','Количество покупок книг'); ?>
<?php $__env->startSection('breadcrumb','Статистика'); ?>
<?php $__env->startSection('page_level_css'); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('table'); ?>
    <form>
        <input type="hidden" name="type" value="<?php echo e(request()->type); ?>">
        <div class="input-group">
            <input type="text" placeholder="название" name="book_name" value="<?php echo e(request()->book_name); ?>">
            <input type="text" class="form-control" id="reportrange" name="date" autocomplete="off" />
        </div>
        <input type="hidden" id="start_date" name="from" value="<?php echo e(request()->from); ?>">
        <input type="hidden" id="end_date" name="to"  value="<?php echo e(request()->to); ?>">

        <button  type="submit">Показать</button>
    </form>
    <table id="showed" class="table table-bordered table-striped">
        <thead>
        <tr style="border: 1px">
            <th style="width: 30px">№</th>
            <th>Название</th>
            <th>Количество</th>
            <th>Средняя цена чека</th>
            <th>Нынешняя цена</th>
            <th>Общая цена</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($value->book_name); ?></td>
                <td><?php echo e($value->total); ?></td>
                <td><?php echo e($value->total_sum/$value->total); ?></td>
                <?php if(request()->type == 'paper'): ?>
                    <td><?php echo e($value->paperbook_price); ?></td>
                <?php elseif(request()->type == 'ebook'): ?>
                    <td><?php echo e($value->ebook_price); ?></td>
                <?php else: ?>
                    <td><?php echo e($value->audio_price); ?></td>
                <?php endif; ?>
                <td><?php echo e($value->total_sum); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo e($books->appends(request()->input())->links()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page_level_js'); ?>
    <script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {

            <?php if(isset(request()->from)): ?>
            var start = moment("<?php echo e(request()->from); ?>", 'YYYY-MM-DD');
            <?php else: ?>
            var start = moment().subtract(29, 'days');
            <?php endif; ?>

            <?php if(isset(request()->to)): ?>
            var end = moment("<?php echo e(request()->to); ?>", 'YYYY-MM-DD');
            <?php else: ?>
            var end = moment();
            <?php endif; ?>

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                autoApply: true,
                startDate: start,
                endDate: end,
                ranges: {
                    'Сегодня': [moment(), moment()],
                    'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                    'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                    'Этот месяц': [moment().startOf('month'), moment().endOf('month')],
                    'Прошедший месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                locale: {
                    "applyLabel": "Применить",
                    "cancelLabel": "Отмена",
                    "customRangeLabel": "Другой",
                    "daysOfWeek": [
                        "Вс",
                        "По",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ]
                },
            }, cb);

            cb(start, end);

            $(document).ready(function() {
                $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    var drp = $('#reportrange').data('daterangepicker');
                    $('#start_date').val(drp.startDate.format('YYYY-MM-DD'));
                    $('#end_date').val(drp.endDate.format('YYYY-MM-DD'));
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/statistics.blade.php ENDPATH**/ ?>