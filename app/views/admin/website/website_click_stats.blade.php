@extends('layout.main')
@section('content')
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Thống kê trao đổi click',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: {{$website->website}}',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            min:0
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Click được chia sẻ',
            data: [0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Click đã nhận',
            data: [0, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }]
    });
});
		</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
@stop