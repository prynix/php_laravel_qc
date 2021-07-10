@extends('layout.main')
@section('content')

        @foreach($acls_updated as $acls_updated)
            <!--{{date('m',strtotime($acls_updated->acls_updated))}}-->
        @endforeach
        <!--{{$month}}-->
<script type="text/javascript">
//ajax get amount of views and clicks banner
$(function() {
    $('#find-data').click(function(){
        starttime=$('#reservationtime').val().split("-")[0]; //alert(starttime);
        endtime=$('#reservationtime').val().split("-")[1]; //alert(endtime);
        
    });

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Advertising Statistics'
        },
        subtitle: {
            text: 'Source: news.tintuc.vn'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Hit'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} hit</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        colors: [
            '#7cb5ec',
            '#434348'
        ],
        series: [{
            name: 'Number of impressions ',
            data: [49, 71, 106, 129, 144.0, 176.0, 135, 148, 216, 194, 95, 54]

        }, {
            name: 'Click counter',
            data: [83, 78, 98, 93, 106.0, 84, 105.0, 104, 91, 83, 106, 92]

        }]
    });
    
    $('#container1').highcharts({
       chart: {
            type: 'area',
            spacingBottom: 30
        },
        title: {
            text: 'Visits'
        },
        subtitle: {
            text: '',
            floating: true,
            align: 'right',
            verticalAlign: 'bottom',
            y: 15
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Hits and Click'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.x + ': ' + this.y;
            }
        },
        plotOptions: {
            area: {
                fillOpacity: 0.5
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Hits',
            data: [6, 12, 14, 11, 12, 12, 14, 15, 10, 16, 17, 19]
        }, {
            name: 'Click',
            data: [8, 9, 12, 11, 10, 11, 9, 12, 10, 18, 13, 19]
        }]
    });
    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                {
                    name: 'Search Engines',
                    y: 77.46,
                    sliced: true,
                    selected: true
                },
                ['Direct Traffic',       13.91],
                ['Referring Sites',    7.73],
                ['Other',     0.90]
            ]
        }]
    });
});
</script>

				<section class="content-header">
                    <h1>
                        Statistics
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Statistics</li>
                    </ol>
                </section>
                <section class="content">
                	<div class="row">
                        <div class="col-xs-12">
                            <div class="box box-success">
                                <div class="box-header">                                  
                                </div><!-- /.box-header -->
                            	<div class="box-body">
                                    <div class="form-group" style="width:50%;margin-left:50%;">
                                        <label>Date and time range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservationtime"/>
                                        </div><!-- /.input group -->
                                        <button class="btn btn-default" id="find-data" style="margin-top:10px;">Find Result</button>
                                    </div><!-- /.form group -->
                            		<div class="form-group"<div id="container" style="width: auto; height: auto; margin: 0 auto"></div></div>
                                    <div class="form-group"<div id="container1" style="width: auto; height: auto; margin: 0 auto"></div></div>
                            	</div>
                            </div>
                            <!-- Default box -->
                            <div class="col-md-6" style="padding-left:0px;">
                                <div class="box box-solid box-success">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:16px;">Site Usage</h4>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <p style="font-weight:bold;line-height:30px;">
                                            72.873&nbsp;<font color="#0055A8">Visits</font><br/>
                                            187.200&nbsp;<font color="#0055A8">Pageviews/visit</font><br/>
                                            2.57&nbsp;<font color="#0055A8">Pageviews</font><br/>
                                            63.19%&nbsp;<font color="#0055A8">Boundrate</font><br/>
                                            00:02:42&nbsp;<font color="#0055A8">Avg Time On Site</font><br/>
                                            86,70%&nbsp;<font color="#0055A8">% New Visit</font><br/>
                                        </p>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                            <div class="col-md-6" style="padding-right:0px;">
                                <div class="box box-solid box-success">
                                    <div class="box-header">
                                        <h4 class="box-title" style="font-size:16px;">Traffic Sources Overview</h4>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div id="container2" style="width: auto; height: auto; margin: 0 auto"></div>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section>
@stop