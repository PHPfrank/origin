@extends('admin.master')
@section('content')
    <script src="/static/js/highcharts/highcharts.js"></script>
<div class="right_col" role="main">
	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;提现统计</h3>
            </div>
            <div class="title_right">
                <div
                        class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <table class="table table-striped  bulk_action"
                           style="text-align: center;">
                        <thead>
                        <tr class="headings">
                            <th class="column-title" style="text-align: center;">本周</th>
                            <th class="column-title" style="text-align: center;">提现人数</th>
                            <th class="column-title" style="text-align: center;">提现金额</th>
                        </tr>
                        </thead>
                        <tbody id ='data_this_week'>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <table class="table table-striped  bulk_action"
                           style="text-align: center;">
                        <thead>
                        <tr class="headings">
                            <th class="column-title" style="text-align: center;">上周</th>
                            <th class="column-title" style="text-align: center;">提现人数</th>
                            <th class="column-title" style="text-align: center;">提现金额</th>
                        </tr>
                        </thead>
                        <tbody id ='data_last_week'>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div id="container_this" style="min-width:400px;height:400px"></div>
                </div>
            </div>
            <div class="animated flipInY col-lg-6 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div id="container_last" style="min-width:400px;height:400px"></div>
                </div>
            </div>
        </div>
	</div>
</div>

    <script type="text/html" id="this_week_tpl">
        <%for(var i = 0; i < result.length; i++) {%>
        <tr class="even pointer">
            <td class=" "><%=result[i].name%></td>
            <td class=" "><%=result[i].withdraw_count%></td>
            <td class=" "><%=result[i].withdraw_amount%></td>
        </tr>
        <%}%>
</script>
<script type="text/html" id="last_week_tpl">
    <%for(var i = 0; i < info.length; i++) {%>
    <tr class="even pointer">
        <td class=" "><%=info[i].name%></td>
        <td class=" "><%=info[i].withdraw_count%></td>
        <td class=" "><%=info[i].withdraw_amount%></td>
    </tr>
    <%}%>
</script>
<script type="text/javascript">
	$(function(){
        var _this={};
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/statistics_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#this_week_tpl").html();
                    $("#data_this_week").html(template(tpl,{result:result.data.result}));
                    var tpl = $("#last_week_tpl").html();
                    $("#data_last_week").html(template(tpl,{info:result.data.info}));
                    render(result.data.this,result.data.last);
                }
            });
        },
        render=function(data,info){
            $('#container_this').highcharts({
                title: {
                    text: '提现人数'
                    //x: -20 //center
                },
                xAxis: {
                    categories: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
                    min:0
                },
                yAxis: {
                    title: {
                        text: '人数'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '人'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: '本周',
                    data: data.user
                }, {
                    name: '上周',
                    data: info.user
                }]
            });
            $('#container_last').highcharts({
                title: {
                    text: '提现金额',
                   // x: -20 //center
                },
                xAxis: {
                    categories: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
                    min:0
                },
                yAxis: {
                    title: {
                        text: '金额'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: '元'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: '本周',
                    data: data.amount
                }, {
                    name: '上周',
                    data: info.amount
                }]
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.phone= $.trim($("#phone").val());
            fetch();
        });
        this.init();
    })
</script>
@endsection
