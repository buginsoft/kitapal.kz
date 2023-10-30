<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name')); ?></title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="/new_admin_design/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="/new_admin_design/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="/new_admin_design/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/new_admin_design/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="/new_admin_design/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/new_admin_design/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <?php echo $__env->yieldContent('css'); ?>

</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center">
            </div>
        </div>
    </div>
</div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="/">
                    <img style="width:95px;" src="http://kitapal.kz/img/logo/kitapal-logo-NEW-PNG.png" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>

    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span><?php echo $__env->yieldContent('breadcrumb'); ?></span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        <?php echo $__env->make('admin.layouts.left-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <?php echo $__env->yieldContent('content'); ?>

        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p>
                    © 2020 Разработка информационной системы  - <a title="Разработка  книжного интернет-магазина" href="http://buginsoft.kz/">bugin.soft</a>
                </p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="/new_admin_design/assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="/new_admin_design/bootstrap/js/popper.min.js"></script>
<script src="/new_admin_design/bootstrap/js/bootstrap.min.js"></script>
<script src="/new_admin_design/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/new_admin_design/assets/js/app.js"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="/new_admin_design/assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/layouts/layout.blade.php ENDPATH**/ ?>