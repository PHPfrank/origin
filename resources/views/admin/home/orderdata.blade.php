@extends('admin.master')
@section('content')
    <script src="/static/js/highcharts/highcharts.js"></script>
<div class="right_col" role="main">
	<div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>&nbsp;&nbsp;订单统计</h3>
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
                            <th class="column-title" style="text-align: center;">总订单数</th>
                            <th class="column-title" style="text-align: center;">总收费额<font color="red"><i class="fa fa-question show_amount"></i></font></th>
                            <th class="column-title" style="text-align: center;">谢媒金数</th>
                            <th class="column-title" style="text-align: center;">谢媒金额</th>
                            <th class="column-title" style="text-align: center;">打赏金数</th>
                            <th class="column-title" style="text-align: center;">打赏金额</th>
                            <th class="column-title" style="text-align: center;">付费率<font color="red"><i class="fa fa-question show_scale"></i></font></th>
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
                            <th class="column-title" style="text-align: center;">总订单数</th>
                            <th class="column-title" style="text-align: center;">总收费额<font color="red"><i class="fa fa-question show_amount"></i></font></th>
                            <th class="column-title" style="text-align: center;">谢媒金数</th>
                            <th class="column-title" style="text-align: center;">谢媒金额</th>
                            <th class="column-title" style="text-align: center;">打赏金数</th>
                            <th class="column-title" style="text-align: center;">打赏金额</th>
                            <th class="column-title" style="text-align: center;">付费率<font color="red"><i class="fa fa-question show_scale"></i></font></th>
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
            <td class=" "><%=result[i].order_count%></td>
            <td class=" "><%=result[i].order_amount%></td>
            <td class=" "><%=result[i].order_x_count%></td>
            <td class=" "><%=result[i].order_x_amount%></td>
            <td class=" "><%=result[i].order_s_count%></td>
            <td class=" "><%=result[i].order_s_amount%></td>
            <td class=" "><%=result[i].order_scale%>%</td>
        </tr>
        <%}%>
</script>
<script type="text/html" id="last_week_tpl">
    <%for(var i = 0; i < info.length; i++) {%>
    <tr class="even pointer">
        <td class=" "><%=info[i].name%></td>
        <td class=" "><%=info[i].order_count%></td>
        <td class=" "><%=info[i].order_amount%></td>
        <td class=" "><%=info[i].order_x_count%></td>
        <td class=" "><%=info[i].order_x_amount%></td>
        <td class=" "><%=info[i].order_s_count%></td>
        <td class=" "><%=info[i].order_s_amount%></td>
        <td class=" "><%=info[i].order_scale%>%</td>
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
                url:'/admin/order_data',
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
            $(".show_amount").on("mouseover",function(e){
                layer.tips('此处总收费代表：平台所有用户当日所充值的金额总和（充值谢媒金和赏金）', $(this), {
                    tips: [1, 'green'],
                    time:2500
                });
            });
            $(".show_scale").on("mouseover",function(e){
                layer.tips('此处付费率代表：当天注册的新用户总收费/总订单数', $(this), {
                    tips: [1, 'green'],
                    time:2500
                });
            });
            $('#container_this').highcharts({
                title: {
                    text: '总订单数'
                    //x: -20 //center
                },
                xAxis: {
                    categories: ['周一', '周二', '周三', '周四', '周五', '周六', '周日'],
                    min:0
                },
                yAxis: {
                    title: {
                        text: '订单数'
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
                    data: data.order_count
                }, {
                    name: '上周',
                    data: info.order_count
                }]
            });
            $('#container_last').highcharts({
                title: {
                    text: '总收费额'
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
                    data: data.order_amount
                }, {
                    name: '上周',
                    data: info.order_amount
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
