@extends('layouts.admin.base')
@section('content')
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/report.css') }}" rel="stylesheet">
<style type="text/css">
    .overHidden {
        word-break:keep-all;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading row">
                    <div class="col-sm-6">
                        <h4>小程序粉丝报表</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 showBox">
                            <div style="text-align: center;padding-top: 30px;">
                                <img src="{{URL::asset('img/footer.png')}}">
                            </div>
                            <div style="text-align: center;padding-top: 10px;">
                                <span style="font-size: 18px;color: #5cb85c;">102</span>
                            </div>
                            <div style="text-align: center;padding-top: 15px;">
                                <span style="font-size: 18px;color: #5cb85c;">昨日小程序新增用户</span>
                            </div>
                        </div>

                        <div class="col-md-2 showBox">
                            <div style="text-align: center;padding-top: 15px;">
                                <img src="{{URL::asset('img/allUser.png')}}">
                            </div>
                            <div style="text-align: center;padding-top: 10px;">
                                <span style="font-size: 18px;color: #f0ad4e;">15,896</span>
                            </div>
                            <div style="text-align: center;padding-top: 15px;">
                                <span style="font-size: 18px;color: #f0ad4e;">小程序粉丝总人数</span>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px;">
                        <div class="col-sm-5">
                            <div id="chart-container1"></div>
                        </div>

                        <div class="col-sm-5">
                            <div id="chart-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('bottom_script')
<script type="text/javascript" src="{{ asset('js/jquery-2.2.4.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts.charts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts.theme.fint.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts-jquery-plugin.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script type="text/javascript">    
</script>
<script type="text/javascript">
    $("#chart-container").insertFusionCharts({
        type: "pie3d",
        width: "400",
        height: "350",
        dataFormat: "json",
        dataSource: {
            chart: {
                caption: "悦享小程序粉丝年龄分布",
                startingangle: "120",
                showlabels: "0",
                showlegend: "1",
                enablemultislicing: "0",
                slicingdistance: "15",
                showpercentvalues: "1",
                showpercentintooltip: "0",
                plottooltext: "年龄分布: $label : $datavalue人",
                theme: "fint"
            },
            data: [
                {
                    label: "15~18",
                    value: "20"
                },
                {
                    label: "19~30",
                    value: "124"
                },
                {
                    label: "31~50",
                    value: "6"
                },
                {
                    label: "> 51",
                    value: "2"
                }
            ]
        }
    });

    FusionCharts.ready(function() {
        var salesChart = new FusionCharts({
        type: 'msline',
        renderAt: 'chart-container1',
        width: '600',
        height: '400',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "悦享小程序近20天粉丝增长人数折线图",
                "linethickness": "2",
                "showvalues": "0",
                "formatnumberscale": "1",
                "labeldisplay": "ROTATE",
                "slantlabels": "1",
                "divLineAlpha": "40",
                "anchoralpha": "0",
                "animation": "1",
                "legendborderalpha": "20",
                "drawCrossLine": "1",
                "crossLineColor": "#0d0d0d",
                "crossLineAlpha": "100",
                "tooltipGrayOutColor": "#80bfff",
                "theme": "zune",
                "showBorder": "0",
                "bgColor": "EEEEEE,CCCCCC",
                "bgratio": "60,40",
                "bgAlpha": "70,80",
            },
            "categories": [{
                "category": [
                    {"label": "1日"},
                    {"label": "2日"}, 
                    {"label": "3日"}, 
                    {"label": "4日"}, 
                    {"label": "5日"}, 
                    {"label": "6日"}, 
                    {"label": "7日"}, 
                    {"label": "8日"}, 
                    {"label": "9日"}, 
                    {"label": "10日"}, 
                    {"label": "11日"}, 
                    {"label": "12日"}, 
                    {"label": "13日"}, 
                    {"label": "14日"}, 
                    {"label": "15日"}, 
                    {"label": "16日"}, 
                    {"label": "17日"}, 
                    {"label": "18日"}, 
                    {"label": "19日"}, 
                    {"label": "20日"}
                ]
            }],
            "dataset": [{
                "seriesname": "6月",
                "data": [
                    {"value": "71"},
                    {"value": "77"},
                    {"value": "68"},
                    {"value": "69"},
                    {"value": "82"},
                    {"value": "93"},
                    {"value": "89"},
                    {"value": "90"},
                    {"value": "97"},
                    {"value": "106"},
                    {"value": "100"},
                    {"value": "107"},
                    {"value": "117"},
                    {"value": "119"}, 
                    {"value": "110"}, 
                    {"value": "97"},
                    {"value": "93"},
                    {"value": "97"},
                    {"value": "88"},
                    {"value": "102"}
                ]
                }]
            }
            })
            .render();
    });     
    </script>
@endsection