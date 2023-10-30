<?php $__env->startSection('css'); ?>
    <style>
        .citystrong{
            font-weight: bold;
        }
        thead tr th{
            font-size:14px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb','Заказы'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Заказы</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <form class="form-inline" action="/admin/orders" method="get">
                            <div class="form-group">
                                <select name="delivery_type" class="form-control">
                                    <option value="all">Все</option>
                                    <option <?php echo e((isset($_GET['delivery_type']) && $_GET['delivery_type']=='courier')?'selected':''); ?> value="courier">Курьер</option>
                                    <option <?php echo e((isset($_GET['delivery_type']) && $_GET['delivery_type']=='pickup')?'selected':''); ?> value="pickup">Самовывоз</option>
                                    <option <?php echo e((isset($_GET['delivery_type']) && $_GET['delivery_type']=='post')?'selected':''); ?> value="post">Почта</option>
                                    <option <?php echo e((isset($_GET['delivery_type']) && $_GET['delivery_type']=='null')?'selected':''); ?> value="null">Электронная книга</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control btn btn-primary ml-2" type="submit" value="Показать">
                            </div>
                        </form>

                        <form class="form-inline" action="/admin/orders" method="get">
                            <div class="form-group">
                                <input class="form-control" type="number" name="order_id" value="<?php echo e((isset($_GET['order_id'])?$_GET['order_id']:'')); ?>" placeholder="Поиск по номеру заказа">
                            </div>
                            <div class="form-group">
                                <input class="form-control btn btn-primary ml-2" type="submit" value="Показать">
                            </div>

                            <a  class="form-control btn btn-primary ml-2" href="/admin/orders">Очистить</a>
                        </form>
                    </div>


                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4" >
                                <thead>
                                <tr>
                                    <th>Номер</th>
                                    <th>Имя</th>
                                    <th>Способ доставки</th>
                                    <th>Книги</th>
                                    <th>Цена книги</th>
                                    <th>Доставка</th>
                                    <th>Итог</th>
                                    <th>Дата</th>
                                    <th>Телефон</th>
                                    <th>Статус</th>
                                    <th>Адрес</th>
                                    <th>Промокод</th>
                                    <th>Действие</th>
                                    <th>Комментарий</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="padding:0px"><?php echo e($value->order_id); ?></td>
                                        <td>
                                            <?php if($value->user_id && $value->user): ?>
                                                <?php echo e($value->user["user_name"]); ?>

                                            <?php else: ?>
                                                <?php echo e($value->user_name); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($value->delivery_type=='pickup'): ?>
                                                самовывоз
                                            <?php elseif($value->delivery_type=='courier'): ?>
                                                курьер
                                            <?php elseif($value->delivery_type=='post'): ?>
                                                почта
                                            <?php else: ?>
                                                электронная книга
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $value->books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php echo e($book->book_name.' - '.$value->order_product($book)->quantity.' шт ('.__('book.'.$book->pivot->type).') -'.$value->order_product($book)->unitprice.' тг'); ?>


                                                <?php echo $loop->last ? '' : ',<br>'; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td><?php echo e($value->total); ?>тг</td>
                                        <td><?php echo e(($value->deliveryprice)?$value->deliveryprice:0); ?>тг</td>
                                        <td>
                                            <?php echo e($value->total+$value->deliveryprice); ?>тг
                                            <?php if($value->promocode_id): ?>
                                                Итог с промокодом
                                                <?php echo e($value->price_with_promocode+$value->deliveryprice); ?>тг
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($value->created_at->format('d/m/Y H:i:s')); ?></td>
                                        <td>
                                            <?php if($value->user_id && $value->user): ?>
                                                <?php echo e($value->user["phone"]); ?>

                                            <?php else: ?>
                                                <?php echo e($value->user_phone); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($value->status?$value->status['text']:''); ?></td>
                                        <td>
                                            <?php if($value->delivery_type && $value->delivery_type!='pickup'): ?>
                                                <?php if($value->user): ?>
                                                    <?php if($value->address_id): ?>

                                                        <span class="citystrong">Город:</span>
                                                        <?php if($value->address->citytitle): ?>
                                                            <?php echo e($value->address->citytitle['text_ru']); ?>

                                                        <?php endif; ?>
                                                        <br>
                                                        <?php if($value->address["street"]): ?>
                                                            <span class="citystrong">Улица:</span><?php echo e($value->address["street"]); ?><br>
                                                        <?php endif; ?>
                                                        <span class="citystrong">Дом:</span><?php echo e($value->address["home"]); ?><br>
                                                        <span class="citystrong">Подезд:</span><?php echo e($value->address["podezd"]); ?><br>
                                                        <span class="citystrong">Квартира:</span><?php echo e($value->address["kvartira"]); ?><br>
                                                        <span class="citystrong">Нас пункт:</span><?php echo e($value->address["naselenny_punkt"]); ?><br>
                                                        <span class="citystrong">Индекс:</span><?php echo e($value->address["post_index"]); ?>


                                                    <?php else: ?>
                                                        <span class="citystrong">Город:</span>
                                                        <?php if($value->user && $value->user->address && $value->user->address->citytitle): ?>
                                                            <?php echo e($value->user->address->citytitle['text_ru']); ?>

                                                        <?php endif; ?>
                                                        <br>
                                                        <?php if($value->user && $value->user->address["street"]): ?>
                                                            <span class="citystrong">Улица:</span><?php echo e($value->user->address["street"]); ?><br>
                                                        <?php endif; ?>
                                                        <span class="citystrong">Дом:</span><?php echo e($value->user->address["home"]); ?><br>
                                                        <span class="citystrong">Подезд:</span><?php echo e($value->user->address["podezd"]); ?><br>
                                                        <span class="citystrong">Квартира:</span><?php echo e($value->user->address["kvartira"]); ?><br>
                                                        <span class="citystrong">Нас пункт:</span><?php echo e($value->user->address["naselenny_punkt"]); ?><br>
                                                        <span class="citystrong">Индекс:</span><?php echo e($value->user->address["post_index"]); ?>

                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="citystrong">Город:</span>
                                                    <?php if($value->address && $value->address->citytitle): ?>
                                                        <?php echo e($value->address->citytitle['text_ru']); ?>

                                                    <?php endif; ?>
                                                    <br>
                                                    <?php if(isset($value->address["street"])): ?>
                                                        <span class="citystrong">Улица:</span><?php echo e($value->address["street"]); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($value->address["home"])): ?>
                                                        <span class="citystrong">Дом:</span><?php echo e($value->address["home"]); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($value->address["podezd"])): ?>
                                                        <span class="citystrong">Подезд:</span><?php echo e($value->address["podezd"]); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($value->address["kvartira"])): ?>
                                                        <span class="citystrong">Квартира:</span><?php echo e($value->address["kvartira"]); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($value->address["naselenny_punkt"])): ?>
                                                        <span class="citystrong">Нас пункт:</span><?php echo e($value->address["naselenny_punkt"]); ?><br>
                                                    <?php endif; ?>
                                                    <?php if(isset($value->address["post_index"])): ?>
                                                        <span class="citystrong">Индекс:</span><?php echo e($value->address["post_index"]); ?>

                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($value->promocode_id): ?>
                                                <?php echo e($value->promocode->code); ?>-<?php echo e($value->promocode->percentage.'%'); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($value->status && $value->status['id']===1): ?>
                                                <a class="btn btn-info" href="/admin/acceptOrder/<?php echo e($value->order_id); ?>">Принять</a>
                                            <?php elseif($value->status && $value->status['id']===2): ?>
                                                <?php if($value->delivery_type=='pickup'): ?>
                                                    <a class="btn btn-info" href="/admin/delivered/<?php echo e($value->order_id); ?>">Забрали</a>
                                                <?php else: ?>
                                                    <a class="btn btn-info" href="/admin/delivered/<?php echo e($value->order_id); ?>">Доставить</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($value->order_comment); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($orders->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function mySubmit(theForm) {
            $.ajax({ // create an AJAX call...
                data: $(theForm).serialize(), // get the form data
                type: $(theForm).attr('method'), // GET or POST
                url: $(theForm).attr('action'), // the file to call
                success: function (response) { // on success..
                    if(response=='true'){
                        alert('Успешно');
                    }
                    else{
                        alert('Что то не так');
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/orders/index.blade.php ENDPATH**/ ?>