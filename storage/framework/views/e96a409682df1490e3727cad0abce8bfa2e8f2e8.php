<?php
    use App\Models\Book;
    //$lang=App::getLocale();
    $name='name_'.$lang;
?>

<?php $__env->startPush('styles'); ?>
    <style>
        .row-eq-height {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('book.title'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title clearfix">
                    <?php if(App::getLocale()=='ru'): ?>
                        Корзина,<span class="text-grey">
                            <span id="totalcount"><?php echo e(\Cart::getTotalQuantity()); ?></span>
                        товара на сумму
                            <span id="pricetotal"><?php echo e(\Cart::getTotal()); ?></span> ₸</span>
                    <?php else: ?>
                        Себетте, <span class="text-grey">
                            <span id="pricetotal"><?php echo e(\Cart::getTotal()); ?></span>
                            ₸ тұратын
                            <span id="totalcount"><?php echo e(\Cart::getTotalQuantity()); ?></span> тауар </span>
                    <?php endif; ?>

                    <?php if(\Cart::getTotalQuantity()!=0): ?>



                            <a href="/checkout" class="hidden-xs pull-right btn btn-blue btn-lg btn-auto"><?php echo app('translator')->get('basket.checkout'); ?></a>


                    <?php endif; ?>
                </h1>

                <div class="row-eq-height">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $book = Book::find($item->attributes->book_id);
                        ?>
                        <div class="col-md-6">
                            <div class="i-basket">
                                <i class="icons ic-x delete-card" onclick="deleteProduct('<?php echo e($item->id); ?>')"></i>
                                <div class="item-basket clearfix">
                                    <div class="img-basket-book">
                                        <img src="<?php echo e($book->main_image()->path); ?>">
                                    </div>
                                    <div class="inf-basket">
                                        <p class="fs-24"><?php echo e($book["book_name"]); ?>

                                            <span class="d-block text-grey fs-15">
                                               <?php $__currentLoopData = $book->authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($key==count($book->authors)-1): ?>
                                                        <?php echo e($author->$name); ?>

                                                    <?php else: ?>
                                                        <?php echo e($author->$name); ?>,
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                        </p>
                                        <div>

                                            <?php if($item->attributes->type =='paper'): ?>
                                                <span class="tag-type text-red">
                                                    <i class="icons ic-book-red"></i><?php echo app('translator')->get('basket.paper'); ?>
                                                </span>
                                            <?php elseif($item->attributes->type =='ebook'): ?>
                                                <span class="tag-type text-green">
                                                    <i class="icons ic-tel"></i><?php echo app('translator')->get('basket.ebook'); ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="tag-type text-green">
                                                    <i class="icons ic-audio"></i>Аудио
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="fs-15">
                                            <span class="d-block"><?php echo app('translator')->get('book.page_quantity'); ?>: <?php echo e($book["page_quanity"]); ?></span>
                                            <span class="d-block">ISBN: <?php echo e($book["isbn"]); ?></span>
                                            <span class="d-block"><?php echo app('translator')->get('book.god_vipuska'); ?> <?php echo e($book["year"]); ?> <?php echo app('translator')->get('book.god'); ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="item-basket clearfix bottom-bask">
                                    <div class="img-basket-book">
                                        <div class="main">
                                            <button onclick="reducecount(<?php echo e(($item->id)); ?>)" class="down_count">-</button>
                                            <input id="<?php echo e($item->id); ?>quantity" class="counter" type="text" value="<?php echo e($item->quantity); ?>">
                                            <button onclick="increasecount(<?php echo e($item->id); ?>)" class="up_count">+</button>
                                        </div>
                                    </div>
                                    <div class="inf-basket">
                                        <span class="itog-prod">
                                            <span id="price<?php echo e($item->id); ?>"><?php echo e($item->price); ?></span> ₸</span>
                                            <a href="/checkout" class="btn-prod"><?php echo app('translator')->get('basket.buy'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(\Cart::getTotalQuantity()!=0): ?>
                        <a href="/checkout" class="btn btn-blue btn-lg btn-block visible-xs"><?php echo app('translator')->get('basket.oformit'); ?></a>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        let totalcount = $("#totalcount");
        let pricetotal  =$("#pricetotal");


        //Уменшает на одну количество товара
        function reducecount($rowId) {
            if(parseInt($("#"+$rowId + "quantity").val())!=1) {
                $.ajax({
                    method: "POST",
                    url: "/decreaseItemQuantity",
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        row_id: $rowId
                    }
                }).done(function (msg) {
                    //Уменшаем количество товаров
                    var count = parseInt($('#shoppingcart_count').text()) - 1;
                    $("#shoppingcart_count").html(count);
                    $("#" + $rowId + "quantity").val(msg["quantity"]);
                    pricetotal.text(parseInt(pricetotal.text()) - parseInt($("#price" + $rowId).text()));
                    totalcount.text(parseInt(totalcount.text()) - 1);
                });
            }
        }

        function increasecount($rowId) {
            $.ajax({
                method: "POST",
                url: "/increaseItemQuantity",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    row_id: $rowId
                }
            }).done(function (msg) {

                //Уменшаем количество товаров
                var count = parseInt($('#shoppingcart_count').text()) + 1;
                $("#shoppingcart_count").html(count);
                $("#" + $rowId + "quantity").val(msg["quantity"]);
                pricetotal.text(parseInt(pricetotal.text()) + parseInt($("#price" + $rowId).text()));
                totalcount.text(parseInt(totalcount.text()) + 1);
            });

        }

        $('.delete-card').on('click', function () {
            $(this).closest('.i-basket').fadeOut('slow');
        });

        //Удаляет продукт полностю
        function deleteProduct( $id) {
            $.ajax({
                method: "POST",
                url: "/deletefrombasket/" + $id,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            }).done(function (msq) {
                $("#shoppingcart_count").html(msq.shoppingcartcount);
                $("#totalcount").html(msq.shoppingcartcount);
                $("#pricetotal").html(msq.totalprice);
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/basket.blade.php ENDPATH**/ ?>