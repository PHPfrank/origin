@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/page.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>&nbsp;&nbsp;红包赠送列表</h3>
			</div>
			<div class="title_right">
				<div
					class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
                <div class="x_title">


                    <form class="form-horizontal form-label-left" style="text-align: left;">
                        <div class="form-group">



                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;类型:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="type" tabindex="-1">
                                    <option value="">全部</option>
                                    <option value="1">赠送红包</option>
                                    <option value="2">收到红包</option>
                                </select>
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;UID:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;昵称:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">赠送时间:</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s')}}">
                            </div>


                            <div class="col-md-1">
                                <a  class="btn btn-success" id="search">查询</a>
                            </div>
                            {{--<div class="col-md-1">--}}
                                {{--<a class="btn btn-primary" id="btn_excel" style=""> 导出订单 </a>--}}
                            {{--</div>--}}
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
                                    {{--<th class="column-title" style="text-align: center;">赠送人UID</th>--}}
                                    <th class="column-title" style="text-align: center;">赠送人UID+昵称</th>
                                    {{--<th class="column-title" style="text-align: center;">获赠人UID</th>--}}
                                    <th class="column-title" style="text-align: center;">获赠人UID+昵称</th>
                                    <th class="column-title" style="text-align: center;">赠送时间</th>
                                    <th class="column-title" style="text-align: center;">内容</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
                                    <th class="column-title" style="text-align: center;">确认时间</th>
                                    <th class="column-title" style="text-align: center;">收回时间</th>
								</tr>
							</thead>
							<tbody id ='data_list'>


                        </tbody>
						</table>
					</div>
                    <div id="pagination">
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">

            {{--<td class=" "><%=data[i].send_uid%></td>--}}
            <td class=" ">
                <a href="/admin/user_detail?uid=<%=data[i].send_uid%>" target="_blank">
                    <%=data[i].send_uid%><br><%=data[i].send_nickname%>
                </a>
            </td>
<!--            <td class=" "><%=data[i].receive_uid%></td>-->
            <td class=" ">
                <a href="/admin/user_detail?uid=<%=data[i].receive_uid%>" target="_blank">
                    <%=data[i].receive_uid%><br><%=data[i].receive_nickname%>
                </a>
            </td>
            <td class=" "><%=data[i].created_at%></td>
			<td class=" "><%=data[i].msg%></td>
			<td class=" "><%=data[i].status_msg%></td>
            <td class=" "><%=data[i].time_status_2%></td>
            <td class=" ">
                <%=data[i].time_status_3%>
                <%if(data[i].status==3){%><br>理由：<%=data[i].msg_3%> <%}%>
            </td>
        </tr>
        <%}%>
</script>
<script type="text/javascript">
	$(function(){
        $('.form_datetime').datetimepicker({
            //minView: "month", //选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            format: 'yyyy-mm-dd hh:ii:ss',
            todayBtn:  1,
            autoclose: 1
        });
        var _this={};
        _this.page=1;
        _this.status=1;
        var count=0;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/bonusOrderList',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.list}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            count =_count;
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.type=$("#type").val();
            _this.status=$("#status").val();
            _this.sex=$("#sex").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            _this.pay_code= $("#pay_code").val();
            _this.order_sn =$.trim($("#order_sn").val());
            _this.reg_start_time =$.trim($("#start_reg_time").val());
            _this.reg_end_time =$.trim($("#end_reg_time").val());
            _this.order_client =$.trim($("#order_client").val());
            fetch();
        });

        this.init();
    })
</script>
@endsection
