// JavaScript Document
var chart = new Highcharts.chart('containerReservoir', {

    chart: {
        type: 'gauge',
        styledMode: true
    },

    title: {
        text: 'Tekanan Air'
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            className: 'outer-pane',
            outerRadius: '115%'
        }, {
            className: 'middle-pane',
            outerRadius: '112%'
        }, {
            // default background
        }, {
            className: 'inner-pane',
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 10,

        minorTickInterval: 'auto',
        minorTickLength: 10,
        minorTickPosition: 'inside',

        tickPixelInterval: 30,
        tickPosition: 'inside',
        tickLength: 10,
        labels: {
            step: 2,
            rotation: 'auto'
        },
        title: {
            text: 'PSi'
        },
        plotBands: [{
            from: 0,
            to: 2,
            className: 'green-band'
        }, {
            from: 2,
            to: 6,
            className: 'yellow-band'
        }, {
            from: 6,
            to: 10,
            className: 'red-band'
        }]
    },

    series: [{
        name: 'Tekanan',
        data: [1],
        tooltip: {
            valueSuffix: ' PSi'
        }
    }]

},
// Add some life
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 10);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 10) {
                newVal = point.y - inc;
            }

            point.update(newVal);

        }, 3000);
    }
});