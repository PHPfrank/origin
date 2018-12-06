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
                <h3>&nbsp;&nbsp;平台日志</h3>
                <br>
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
                            
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">日期:</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d')}}">
                            </div>
                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;来源:</label>
                                <div class="col-md-2" style="width:10%;">
                                    <select class="select2_single form-control" id="os" tabindex="-1">
                                        <option value="0">不限</option>
                                        <option value="all">app总计</option>
                                        <option value="ios">苹果</option>
                                        <option value="android">安卓</option>
                                    </select>
                                </div>
                            <div class="col-md-1" style="width:6%;">
                                <button type="button" class="btn btn-success" id="search">查询</button>
                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
                                @foreach ($menu as $m)
                                    <th class="column-title" style="text-align: center;">{{ $m}}</th>
                                @endforeach
                                
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
</div>
<style>

</style>
<script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer" >
            <td class=" " rowspan="2" style="vertical-align: middle;"><%=data[i].day_desc%></td>
            <td class=" " rowspan="2" style="vertical-align: middle;"><% if(data[i].os=='all') {%>app总计<%}else {%><%=data[i].os%><% }%></td>
            <td class=" " rowspan="2" style="vertical-align: middle;"><%=data[i].user_register%></td>
            <td class=" " rowspan="2" style="vertical-align: middle;"><%=data[i].order_num%></td>
            <td class=" " rowspan="2" style="vertical-align: middle;"><%=data[i].order_success_num%></td>
            <td class=" " rowspan="2" style="vertical-align: middle;">￥<%=data[i].order_amount%></td>
        </tr>
        <tr class="even pointer">
        </tr>
        <%}%>
</script>

<script type="text/javascript">
	$(function(){
        $('.form_datetime').datetimepicker({
            minView: "month", //选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            todayBtn:  1,
            autoclose: 1
        });
        var _this={};
        _this.uid=$("#uid").val();
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/statics_log_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.list}));
                    // console.log(template(tpl,{data:result.data.list}));
                    console.log(result.data.list);
                    render(result.data._count,result.data._limit);

                }
            });
        },
        render=function(_count,_limit){
            pageinit({
                page:{pageSize:_limit,currentPage:_this.page},
                _count:_count
            },_this);
        },
        alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['238px', '50px']
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.os=$("#os").val();
            _this.start_time=$("#start_time").val();
            _this.end_time=$("#end_time").val();
            fetch();
        });

        this.init();
    })
</script>
@endsection
