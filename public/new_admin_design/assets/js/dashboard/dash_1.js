try {

/*
    ==============================
    |    @Options Charts Script   |
    ==============================

    =============================
        Total Orders | Options
    =============================
*/
var d_2options2 = {
  chart: {
    id: 'sparkline1',
    group: 'sparklines',
    type: 'area',
    height: 280,
    sparkline: {
      enabled: true
    },
  },
  stroke: {
      curve: 'smooth',
      width: 2
  },
  fill: {
    opacity: 1,
  },
  series: [{
    name: 'Sales',
    data: [28, 40, 36, 52, 38, 60, 38, 52, 36, 40]
  }],
  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
  yaxis: {
    min: 0
  },
  grid: {
    padding: {
      top: 125,
      right: 0,
      bottom: 36,
      left: 0
    },
  },
  fill: {
      type:"gradient",
      gradient: {
          type: "vertical",
          shadeIntensity: 1,
          inverseColors: !1,
          opacityFrom: .40,
          opacityTo: .05,
          stops: [45, 100]
      }
  },
  tooltip: {
    x: {
      show: false,
    },
    theme: 'dark'
  },
  colors: ['#fff']
}

/*
    =================================
        Revenue Monthly | Options
    =================================
*/


/*
    ==================================
        Sales By Category | Options
    ==================================
*/



/*
    ==============================
    |    @Render Charts Script    |
    ==============================
*/


/*
    ============================
        Daily Sales | Render
    ============================
*/


/*
    ============================
        Total Orders | Render
    ============================
*/
var d_2C_2 = new ApexCharts(document.querySelector("#total-orders"), d_2options2);
d_2C_2.render();



/*
    =================================
        Sales By Category | Render
    =================================
*/
var chart = new ApexCharts(
    document.querySelector("#chart-2"),
    options
);

chart.render();

/*
    =============================================
        Perfect Scrollbar | Recent Activities
    =============================================
*/
const ps = new PerfectScrollbar(document.querySelector('.mt-container'));


} catch(e) {
    console.log(e);
}
