

<?php $__env->startSection('content'); ?>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">Куплено за все время</h5>
                    </div>
                    <div class="widget-content" style="position: relative;">
                        <div id="chart-2" class="" style="min-height: 390px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">За год</h5>
                    </div>

                    <div class="widget-content" style="position: relative;">
                        <div id="s-line" class="" style="min-height: 365px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">Түскен сумма</h5>
                    </div>
                    <div class="widget-content" style="position: relative;">
                        <div id="amount" class="" style="min-height: 390px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="/new_admin_design/plugins/apex/apexcharts.min.js"></script>
    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 380
            },
            colors: <?php echo $colors; ?>,
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Жалпы',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                show: true,
                width: 25,
            },
            series: <?php echo e($total_subscriptions); ?>,
            labels: <?php echo $labels; ?>,
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        };



        var chart = new ApexCharts(
            document.querySelector("#chart-2"),
            options
        );

        chart.render();

        var sLineArea = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false,
                }
            },
            colors: <?php echo $colors; ?>,
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: <?php echo $years; ?>,

            xaxis: {
                categories: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сен','Окт','Ноя','Дек'],
            }

        };

        var chart2 = new ApexCharts(
            document.querySelector("#s-line"),
            sLineArea
        );

        chart2.render();




        var amount = {
            chart: {
                type: 'donut',
                width: 380
            },
            colors: <?php echo $colors; ?>,
            dataLabels: {
                enabled: false
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '14px',
                markers: {
                    width: 10,
                    height: 10,
                },
                itemMargin: {
                    horizontal: 0,
                    vertical: 8
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '65%',
                        background: 'transparent',
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: '29px',
                                fontFamily: 'Nunito, sans-serif',
                                color: undefined,
                                offsetY: -10
                            },
                            value: {
                                show: true,
                                fontSize: '26px',
                                fontFamily: 'Nunito, sans-serif',
                                color: '20',
                                offsetY: 16,
                                formatter: function (val) {
                                    return val+'тг'
                                }
                            },
                            total: {
                                show: true,
                                showAlways: true,
                                label: 'Жалпы',
                                color: '#888ea8',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce( function(a, b) {
                                        return a + b
                                    }, 0)+'тг'
                                }
                            }
                        }
                    }
                }
            },
            stroke: {
                show: true,
                width: 25,
            },
            series: <?php echo e($paid_subs); ?>,
            labels: <?php echo $labels; ?>,
            responsive: [{
                breakpoint: 1599,
                options: {
                    chart: {
                        width: '350px',
                        height: '400px'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },

                breakpoint: 1439,
                options: {
                    chart: {
                        width: '250px',
                        height: '390px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                            }
                        }
                    }
                },
            }]
        };



        var chart3 = new ApexCharts(
            document.querySelector("#amount"),
            amount
        );

        chart3.render();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/kitapal.kz/httpdocs/resources/views/admin/subscription/statistic.blade.php ENDPATH**/ ?>