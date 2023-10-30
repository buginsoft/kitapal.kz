
<?php
    $lang=App::getLocale();
    $name='name_'.$lang;
?>
<?php $__env->startPush('styles'); ?>
    <style>
        .section__body-404{
            padding: 60px 0 150px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 30px;
        }
        .text-content{
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .text-content h2{
            font-size: 60px;
            line-height: 100%;
            color: #333333;
            font-weight: 900;
        }
        .text-content h4{
            font-size: 38px;
            line-height: 100%;
            font-weight: 600;
            color: #333333;
        }
        text-content p{
            font-size: 18px;
            line-height: 100%;
            font-weight: 400;
            color: #333333;
        }

        .first-btn{
            font-size: 17px;
            font-style: normal;
            font-weight: bold;
            border-radius: 4px;
            border: 0;
            padding: 15px 64px;
            margin: 0 10px 0 0;
            background: #8E2976 ;
            color: #FFFFFF;
        }

        .second-btn{
            font-size: 17px;
            font-style: normal;
            font-weight: bold;
            border-radius: 4px;
            border: 0;
            padding: 15px 64px;
            margin: 0 10px 0 0;
            background: rgba(142, 41, 118, 0.16) ;
            color: #8E2976;
        }

        .img-content img{
            width: 500px;
            height: auto;
            object-fit: cover;
        }
        @media  screen and (max-width: 1200px) {
            .section__body-404{
                flex-direction: column;
            }

            .text-content h4 {
                text-align: center;
            }

            .text-content{
                width: 100%;
                display: flex;
                gap: 10px;
                flex-direction: column;
                align-items: center;
            }

            .btn-block{
                display: flex !important;
                justify-content: center;
                gap: 20px;
            }

            .img-content{
                display: flex;
                justify-content: center;
                width: 100%;
            }

            @media  screen and (max-width: 600px){
                .btn-block{
                    display: flex;
                    flex-direction: column;
                }

                .img-content img {
                    width: 100%;

                }
            }
        }
    </style>

<?php $__env->startSection('title',''); ?>
<?php $__env->startSection('content'); ?>
    <div class="page_404">
        <div class="container">
            <div class="section__body-404">
                <div class="section__body-block text-content">
                    <h2>404</h2>
                    <h4>Извините, данная страница отсутствует </h4>
                    <p>Вернитесь на главную или обновите страницу</p>
                    <div class="btn-block">
                        <button class="first-btn">На главную</button>
                        <button class="second-btn">Обновить страницу</button>
                    </div>
                </div>
                <div class="section__body-block img-content">
                    <img src="/images/errors/404.png">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/errors/404.blade.php ENDPATH**/ ?>