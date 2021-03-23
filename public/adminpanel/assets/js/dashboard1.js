$(function() {
    "use strict";

    var day_data = [
        {"period": "1398-01-01", "ferari": 15, "hyundai": 2, "hawal" : 50},
        {"period": "1398-02-01", "ferari": 1, "hyundai": 6, "hawal" : 5},
        {"period": "1398-03-01", "ferari": 5, "hyundai": 35, "hawal" : 14},
        {"period": "1398-04-01", "ferari": 2, "hyundai": 10, "hawal" : 4},
        {"period": "1398-05-01", "ferari": 7, "hyundai": 42, "hawal" : 26},
        {"period": "1398-06-01", "ferari": 30, "hyundai": 7, "hawal" : 37},
    ];
    Morris.Bar({
        element: 'period_brands_car',
        data: day_data,
        xkey: 'period',
        ykeys: ['ferari', 'hyundai','hawal'],
        labels: ['فراری', 'هیوندا','هاوال'],
        xLabelAngle: 60,
        resize:true,
    });


    // Sales overview
    // Morris.Area({
    //     element: 'period_brands_car',
    //     data: [{
    //         period: '2010',
    //         iphone: 10,
    //         ipad: 50,
    //         itouch: 100
    //     }, {
    //         period: '2011',
    //         iphone: 200,
    //         ipad: 300,
    //         itouch: 400
    //     }, {
    //         period: '2012',
    //         iphone: 500,
    //         ipad: 700,
    //         itouch: 900
    //     }, {
    //         period: '2013',
    //         iphone: 10,
    //         ipad: 20,
    //         itouch: 90
    //     }, {
    //         period: '2014',
    //         iphone: 800,
    //         ipad: 400,
    //         itouch: 150
    //     }, {
    //         period: '2015',
    //         iphone: 1500,
    //         ipad: 1000,
    //         itouch: 500
    //     }, {
    //         period: '2016',
    //         iphone: 300,
    //         ipad: 150,
    //         itouch: 1600
    //     }
    //
    //
    //     ],
    //     lineColors: ['#55ce63', '#2f3d4a', '#009efb'],
    //     xkey: 'period',
    //     ykeys: ['iphone', 'ipad', 'itouch'],
    //     labels: ['فراری', 'هیوندای', 'هاوال'],
    //     pointSize: 0,
    //     lineWidth: 0,
    //     resize:true,
    //     fillOpacity: 0.8,
    //     behaveLikeLine: true,
    //     gridLineColor: '#e0e0e0',
    //     hideHover: 'auto',
    // });

    var sparklineLogin = function() {
        $('.spark-count').sparkline([4, 5, 0, 10, 9, 12, 4, 9, 4, 5, 3, 10, 9, 12, 10, 9], {
            type: 'bar',
            //width: '100%',
            height: '170',
            barWidth: '8',
            resize: true,
            barSpacing: '6',
            barColor: '#fff'
        });

        $('.spark-count2').sparkline([20, 40, 30], {
            type: 'pie',
            height: '170',

            resize: true,
            sliceColors: ['#ff9823', '#ffeebd', '#ffe391']
        });
    }
    var sparkResize;

    sparklineLogin();
});