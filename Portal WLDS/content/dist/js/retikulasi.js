// JavaScript Document
var i ,XMLHttpRequest,pipretakh,ret= " ";
var request = new XMLHttpRequest();
request.open("GET","../"+"logsalah.php", false);
request.send(null);
var parObject = JSON.parse(request.responseText);

//var parObject = JSON.parse(getJSON);
for ( i = 0; i < parObject.length; i++) {
    var counter = parObject[i];
    /* console.log(counter.counter_name); */
    pipretakh = function (ret){
	ret += counter.pipa_retikulasi_akhir;
	}
}
var chart   = new Highcharts.chart('containerRetikulasi', {
    chart: {
        type: 'spline',
        animation: Highcharts.svg, // don't animate in old IE
        marginRight: 10,
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
                        y = pipretakh(ret);
                    series.addPoint([x, y], true, true);
                }, 1000);
            }
        }
    },

    time: {
        useUTC: false
    },

    title: {
        text: 'Debit Pipa Retikulasi'
    },
    xAxis: {
        type: 'datetime',
        tickPixelInterval: 150
    },
    yAxis: {
        title: {
            text: 'Nilai Debit Air'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br/>',
        pointFormat: '{point.x:%Y-%m-%d %H:%M:%S}<br/>{point.y:.2f}'
    },
    legend: {
        enabled: true
    },
    exporting: {
        enabled: true
    },
    series: [{
        name: 'Debit (liter/detik)',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -19; i <= 0; i += 1) {
                data.push({
                    x: time + i * 1000,
                    y: pipretakh(ret)
                });
            }
            return data;
        }())
    }]
});