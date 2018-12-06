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
				<h3>&nbsp;&nbsp;会员VIP状态列表</h3>
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
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">状态:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="all">全部</option>
                                    <option value="1">到期</option>
                                    <option value="2">未到期</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">uid:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">昵称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
                            </div>
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">被订阅者uid:</label>--}}
                            {{--<div class="col-md-1" style="width:10%;">--}}
                                {{--<input type="text" id="r_uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">--}}
                            {{--</div>--}}
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">被订阅者昵称:</label>--}}
                            {{--<div class="col-md-1" style="width:10%;">--}}
                                {{--<input type="text" id="r_nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">--}}
                            {{--</div>--}}
                            

                            
                        </div>
                        <div class="form-group">
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">到期时间:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">--至--:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>
                            <div class="col-md-1">
                                <a  class="btn btn-success" id="search">查询</a>
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
                                    <th class="column-title" style="text-align: center;width:10%;">序号</th>
									<th class="column-title" style="text-align: center;width:10%;">会员</th>
                                    <th class="column-title" style="text-align: center;width:40%;">到期时间</th>
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
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td style="vertical-align: middle;"><%=data[i].id%></td>
            <td style="vertical-align: middle;"><a target="_blank" href="/admin/base_user?uid=<%=data[i].uid%>"><%=data[i].nickname%>[<%=data[i].uid%>]</a></td>
            <td style="vertical-align: middle;"><%=data[i].expire_date%></td>
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
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/rss_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.data}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            

           
            
        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"</font>",
                time:1000,
                area: ['153px', '50px']
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.r_uid =$.trim($("#r_uid").val());
            _this.r_nickname =$.trim($("#r_nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            fetch();
        });

        this.init();
    })
</script>
@endsection
