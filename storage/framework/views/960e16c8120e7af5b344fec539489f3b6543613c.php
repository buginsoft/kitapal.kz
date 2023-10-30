<!DOCTYPE html>
<html>
<head>
    <title>Email Receipt</title>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp" style="background-color: #d5d5d5;">
    <tbody>
    <tr>
        <td>
            <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth" style="background-color: #ffffff;">
                <tbody>
                <tr>
                    <td style="padding-bottom: 10px;" align="center">
                        <a href=""><img width="60" img src="https://kitapal.kz/img/logo/kitapal-logo-NEW-PNG.png" alt="kitapal.kz"></a>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-top: 30px;border-bottom: 1px solid #bbbbbb;">
                        <?php if(app()->getLocale()=='kz'): ?>
                            Сәлеметсіз бе, <?php echo e($name); ?>!<br>
                            #<?php echo e($order_id); ?> – тапсырысыңызға төлем алдық.<br>
                            Сәлден соң менеджер сіздің тапсырысты қабылдап, мәлімет жібереді.<br>
                            Тапсырысыңызға рахмет! Пайдалы кітап болсын! Сабыр етіп күткеніңізге рахмет.<br>
                        <?php else: ?>
                            Здравствуйте, <?php echo e($name); ?>!<br>
                            Мы получили оплату за заказ #<?php echo e($order_id); ?>.<br>
                            Через некоторое время менеджер примет ваш заказ и отправит информацию.<br>
                            Спасибо за ваш заказ! Пусть это будет полезная книга! Спасибо за терпение.<br>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $__currentLoopData = $order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding-top: 0;">
                            <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="font-size: 14px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                        <?php echo e($book[0]?$book[0]:'1'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                        <?php if(app()->getLocale()=='kz'): ?>Дана:<?php else: ?> Количество: <?php endif; ?> <?php echo e($book[1]?$book[1]:''); ?>

                                    </td>
                                    <td style="width: 130px;"></td>
                                </tr>
                                <tr>
                                    <?php if($book[2]): ?>
                                        <?php if($book[2]=='paper'): ?>
                                            <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                <?php if(app()->getLocale()=='kz'): ?>Типі: қағаз <?php else: ?> Тип: бумажный <?php endif; ?>
                                            </td>
                                        <?php elseif($book[2]=='audio'): ?>
                                            <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                <?php if(app()->getLocale()=='kz'): ?> Типі: аудио <?php else: ?> Тип: аудио <?php endif; ?>
                                            </td>
                                        <?php elseif($book[2]=='ebook'): ?>
                                            <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                <?php if(app()->getLocale()=='kz'): ?> Типі: электронды <?php else: ?> Тип: электронный <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                        <b style="color: #666666;"><?php echo e($book[3]?$book[3].'тг':''); ?></b>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="padding-top: 0;">
                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                            <tbody>
                            <tr>
                                <td style="font-size: 14px;font-weight: bold; line-height: 18px; color: #757575; width: 440px;">
                                    <?php if(app()->getLocale()=='kz'): ?>
                                        Барлығы
                                    <?php else: ?>
                                        Итог
                                    <?php endif; ?>
                                </td>

                                <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                    <b style="color: #666666;"><?php echo e($total.' тг'); ?></b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        ТОО «Самға баспасы»<br>
                        Юр. адрес: РК, г. Алматы,<br>
                        мкр. 5, дом 18, н.п. 67<br>

                        БИН 180140037919<br>
                        ИИК: KZ43722S000001356971 – KZT<br>
                        Кбе – 17<br>
                        АО «KASPI BANK»<br>
                        БИК CASPKZKA<br>
                        Директор: Махмутов А.А.<br>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/mails/successpurchased.blade.php ENDPATH**/ ?>