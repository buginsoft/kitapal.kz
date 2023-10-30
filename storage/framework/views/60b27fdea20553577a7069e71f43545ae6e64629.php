<?php $__env->startSection('breadcrumb','Панель'); ?>
<?php $__env->startSection('content'); ?>
    <!--  BEGIN CONTENT AREA  -->
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    <div class="widget-heading">
                        <h5 class="">Недавние заказы</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><div class="th-content">Пользователь</div></th>
                                    <th><div class="th-content">Номер заказа</div></th>
                                    <th><div class="th-content">Дата заказа</div></th>
                                    <th><div class="th-content th-heading">Цена</div></th>
                                    <th><div class="th-content">Статус</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $recent_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><div class="td-content customer-name">
                                                <?php if($item->user_id): ?>
                                                    <img src="<?php echo e($item->user->avatar); ?>" alt="avatar"><?php echo e($item->user->user_name); ?>

                                                <?php else: ?>
                                                    <?php echo e($item->user_name.' '.$item->user_phone); ?>

                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td><div class="td-content"><?php echo e('#'.$item->order_id); ?></div></td>
                                        <td><div class="td-content"><?php echo e($item->updated_at->format('d/m/Y H:i')); ?></div></td>
                                        <td><div class="td-content pricing"><span class=""><?php echo e($item->total.'тг'); ?></span></div></td>
                                        <td><div class="td-content"><span class="badge <?php if($item->status->id==1): ?> outline-badge-success <?php else: ?> outline-badge-primary <?php endif; ?>"><?php echo e($item->status->text); ?></span></div></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">

                    <div class="widget-heading">
                        <h5 class="">Бестселлеры бумажные книги</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><div class="th-content">Книга</div></th>
                                    <th><div class="th-content th-heading">Цена</div></th>
                                    <th><div class="th-content">Продано</div></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $top_selling; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="td-content product-name">
                                                <?php if($item->main_image()): ?>
                                                    <img src="<?php echo e($item->main_image()->path); ?>" alt="product"><?php echo e($item->book_name); ?>

                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td><div class="td-content"><span class="pricing"><?php echo e($item->paperbook_price.'тг'); ?></span></div></td>
                                        <td><div class="td-content"><?php echo e($item->bought_count); ?></div></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Продажи в этом году</h5>
                        <ul class="tabs tab-pills">
                            <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">По месяцам</a></li>
                        </ul>
                    </div>

                    <div class="widget-content">
                        <div class="tabs tab-content">
                            <div id="content_1" class="tabcontent">
                                <div id="revenueMonthly"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Продажи по категориям</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div id="s-bar" class=""></div>
                    </div>
                </div>

            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget-two" style="height:70%">
                    <div class="widget-content">
                        <div class="w-numeric-value">
                            <div class="w-content">
                                <span class="w-value">Ежедневные продажи</span>
                            </div>
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </div>
                        </div>
                        <div class="w-chart">
                            <div id="daily-sales"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                <div class="widget widget-activity-four">
                    <div class="widget-heading">
                        <h5 class="">Сообщений</h5>
                    </div>

                    <div class="widget-content">

                        <div class="mt-container mx-auto">
                            <div class="timeline-line">
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item-timeline timeline-primary">
                                        <div class="t-dot" data-original-title="" title="">
                                        </div>
                                        <div class="t-text">
                                            <p><?php echo e($item->name); ?></p>
                                            <span class="badge badge-danger">Pending</span>
                                            <p class="t-time"><?php echo e($item->created_at->format('d/m/Y H:i')); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="tm-action-btn">
                            <button class="btn">View All <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->
    <!-- END MAIN CONTAINER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="/new_admin_design/plugins/apex/apexcharts.min.js"></script>
    <script>
        var d_2options1 = {
            chart: {
                height: 160,
                type: 'bar',
                stacked: true,
                stackType: '100%',
                toolbar: {
                    show: false,
                }
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 1,
            },
            colors: ['#e2a03f', '#e0e6ed'],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            series: [{
                name: 'Продажи',
                data: <?php echo e($current_week); ?>

            },{
                name: 'Прошлая неделя',
                data: <?php echo e($last_week); ?>

            }],
            xaxis: {
                labels: {
                    show: false,
                },
                categories: ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота', 'Воскресенье'],
            },
            yaxis: {
                show: false
            },
            fill: {
                opacity: 1
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: '25%',
                }
            },
            legend: {
                show: false,
            },
            grid: {
                show: false,
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                padding: {
                    top: 10,
                    right: 0,
                    bottom: -40,
                    left: 0
                },
            },
        }
        var d_2C_1 = new ApexCharts(document.querySelector("#daily-sales"), d_2options1);
        d_2C_1.render();

        //Monthly Sales
        var options1 = {
            chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                    enabled: false
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.3,
                    blur: 5,
                    left: -7,
                    top: 22
                },
                toolbar: {
                    show: false
                },
                events: {
                    mounted: function(ctx, config) {
                        const highest1 = ctx.getHighestValueInSeries(0);
                        const highest2 = ctx.getHighestValueInSeries(1);

                        ctx.addPointAnnotation({
                            x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                            y: highest1,
                            label: {
                                style: {
                                    cssClass: 'd-none'
                                }
                            },
                            customSVG: {
                                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                cssClass: undefined,
                                offsetX: -8,
                                offsetY: 5
                            }
                        })

                        ctx.addPointAnnotation({
                            x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                            y: highest2,
                            label: {
                                style: {
                                    cssClass: 'd-none'
                                }
                            },
                            customSVG: {
                                SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                cssClass: undefined,
                                offsetX: -8,
                                offsetY: 5
                            }
                        })
                    },
                }
            },
            colors: ['#1b55e2', '#e7515a'],
            dataLabels: {
                enabled: false
            },
            markers: {
                discrete: [{
                    seriesIndex: 0,
                    dataPointIndex: 7,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 5
                }, {
                    seriesIndex: 2,
                    dataPointIndex: 11,
                    fillColor: '#000',
                    strokeColor: '#000',
                    size: 4
                }]
            },
            subtitle: {
                text: 'Всего заказов',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 35,
                floating: false,
                style: {
                    fontSize: '14px',
                    color:  '#888ea8'
                }
            },
            title: {
                text: '<?php echo e($total_in_year_sales); ?>',
                align: 'left',
                margin: 0,
                offsetX: -10,
                offsetY: 0,
                floating: false,
                style: {
                    fontSize: '25px',
                    color:  '#0e1726'
                },
            },
            stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
            },
            series: [{
                name: 'Продажи',
                data: <?php echo e($month_sales); ?>

            }],
            labels: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            xaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    show: true
                },
                labels: {
                    offsetX: 0,
                    offsetY: 5,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-xaxis-title',
                    },
                }
            },
            yaxis: {
                labels: {
                    offsetX: -22,
                    offsetY: 0,
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Nunito, sans-serif',
                        cssClass: 'apexcharts-yaxis-title',
                    },
                }
            },
            grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                    lines: {
                        show: true
                    }
                },
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                padding: {
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: -10
                },
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                    width: 10,
                    height: 10,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    fillColors: undefined,
                    radius: 12,
                    onClick: undefined,
                    offsetX: 0,
                    offsetY: 0
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 20
                }
            },
            tooltip: {
                theme: 'dark',
                marker: {
                    show: true,
                },
                x: {
                    show: false,
                }
            },
            fill: {
                type:"gradient",
                gradient: {
                    type: "vertical",
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: .28,
                    opacityTo: .05,
                    stops: [45, 100]
                }
            },
            responsive: [{
                breakpoint: 575,
                options: {
                    legend: {
                        offsetY: -30,
                    },
                },
            }]
        }
        var chart1 = new ApexCharts(
            document.querySelector("#revenueMonthly"),
            options1
        );

        chart1.render();
        //------------------

        //categiry
        let category_labels = [];

        <?php $__currentLoopData = $category_text_ar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        category_labels.push('<?php echo e($item); ?>');
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        var sBar = {
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                data: <?php echo e($category_value); ?>

            }],
            xaxis: {
                categories: category_labels,
                /*labels: {
                    formatter: function(value, index) {
                        return (value / 1000) + 'K'
                    }
                }*/
            }

        }
        var chart = new ApexCharts(
            document.querySelector("#s-bar"),
            sBar
        );

        chart.render();

    </script>
    <script src="/new_admin_design/assets/js/dashboard/dash_1.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>