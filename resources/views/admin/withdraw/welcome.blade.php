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
				<h3>&nbsp;&nbsp;提现列表</h3>
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
                                    <option value="">不限</option>
                                    <option value="0">待审核</option>
                                    <option value="-1">忽略</option>
                                    <option value="1">待付款</option>
                                    <option value="2">已付款</option>
                                    <option value="-2">付款失败</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">UID:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">&nbsp;&nbsp;创建时期:</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>

                            <div class="col-md-3">
                                <a  class="btn btn-success" id="search">查询</a>
                                <a  class="btn btn-primary" id="addBatchNo">生成新批次号</a>
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
									<th class="column-title" style="text-align: center;">序列号</th>
                                    <th class="column-title" style="text-align: center;">UID</th>
									<th class="column-title" style="text-align: center;">昵称</th>
									<th class="column-title" style="text-align: center;">账号</th>
                                    <th class="column-title" style="text-align: center;">账户名</th>
                                    <th class="column-title" style="text-align: center;">金额</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: left;">操作</th>
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
            <td class=" " style="vertical-align:middle;"><%=data[i].id%></td>
            <td class=" " style="vertical-align:middle;"><a target="_blank" href="/admin/user_detail?uid=<%=data[i].uid%>"><%=data[i].uid%></a></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].nickname) {%><%=data[i].nickname%><%}%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].account%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].name%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].amount%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].status==0){%>待审核<%}else if(data[i].status==-1){%><font color="red">忽略</font><%}else if(data[i].status==1){%><font color='blue'>待付款</font><%}else if(data[i].status==-2){%>付款失败<%}else if(data[i].status==2){%><font color="green">完成</font><%}%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].created_at%></td>
            <td class=" last" style="vertical-align:middle;">
                <%if(data[i].status==0){%><a  class="btn btn-info btn-sm item_agree" val="<%=data[i].id%>"><i class="fa fa-check"></i> 同意</a>
                <a class="btn btn-danger btn-sm item_denial" val="<%=data[i].id%>" ><i class="fa fa-close" title="忽略" ></i>忽略</a><%}else {%>
                    <a  class="btn btn-info btn-sm item_show" val="<%=data[i].id%>"><i class="fa fa-bars"></i> 查看</a> <%}%>
            </td>
        </tr>
        <%}%>
</script>
<script type="text/html" id="show_detail">
    <div class="panel panel-default" style="border-top: 1px solid #dddddd;">
            <div class="panel-body">
                <p> 处理人：<%=info.auth_name%></p>
                <p> 状态：<% if(info.status==1){%><font color="green">待付款</font><%}else if(info.status==-1){%><font color="blue">忽略</font><%}else if(info.status==0){%><font color="green">待审核</font><%}else if(info.status==2){%><font color="green">付款成功</font><%}else if(info.status==-2){%><font color="red">付款失败</font><%}%></p>
                <p> 提现现金额：<%=info.amount%>元</p>
                <% if(info.status==1){%>
                <p> 提现批次号：<%=info.batch_no%></p>
                <p> 支付宝支付：<%=info.notify_id%></p>
                <%}%>
                <p> 处理日期：<%=info.updated_at%></p>
            </div>
    </div>
</script>

<script type="text/html" id="batch_list">
	<table class="table table-striped jambo_table bulk_action" style="text-align: center;">
		<thead>
			<tr>
				<th class="col-md-4" style="text-align:center;">批次号</th>
				<th class="col-md-2" style="text-align:center;">记录数</th>
				<th class="col-md-4" style="text-align:center;">添加时间</th>
			</tr>
			</thead>
			<tbody>
			

 	<%for(var i = 0; i < info.length; i++) {%>
        <tr class="even pointer">
            <td class=" " style="vertical-align:left;"><input type="radio" value="<%=info[i].batch_no%>" name="batch" tabindex="0" style="margin-right:10px;"><%=info[i].batch_no%></td>
            <td class=" " style="vertical-align:left;"><%=info[i].record_num%></td>
            <td class=" " style="vertical-align:left;"><%=info[i].created_at%></td>
        </tr>
        <%}%>


			</tbody>
	</table>
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
                url:'/admin/get_withdraw',
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
            $(".item_denial").on("click",function(e){
                var id =$(this).attr('val');
                layer.confirm('确定忽略该次用户提现吗?', {
                    btn:['确定','取消']
                },function(){
                    $.ajax({
                        url:'/admin/withdraw_amount',
                        dataType:"json",
                        type:'get',
                        data:{status:-2,id:id},
                        success:function(result){
                            layer.msg('操作成功',{icon:1,time:2000});
                            fetch();
                        }
                    });

                    parent.layer.closeAll();
                });

            });
            //添加批次号
            $(".item_agree").on("click",function(e){   
                var id =$(this).attr('val');
                layer.open({
                    type:1,
                    title:"选择批次号",
                    area: ['450px', '400px'],
                    btn:['确定','取消'],
                    fix: false, //不固定
                    maxmin: true,
                    content: '<div id="batch_info"></div>',
                    success:function(){
                    	 $.ajax({
                             url:'/admin/batch_list',
                             dataType:"json",
                             type:'post',
                             success:function(result) {
                                 var tpl = $("#batch_list").html();
                                 $("#batch_info").html(template(tpl,{info:result.data}));
                             }
                         });
                    },
                    yes: function(index, layero){
                    	var batch_no = $('#batch_info input[name="batch"]:checked').val();
                    	if(batch_no) {
                    		$.ajax({
								url:'/admin/update_batchdata',
								dateType:"json",
								type:'post',
								data:{record_id:id,batch_no:batch_no},
								success:function(result) {
									if(result.error == 0) {
										fetch();
										parent.layer.closeAll();
									} else {
										layer.msg('更新失败',{icon:2,time:2000});
									}
								}
                            });
                        }
                   	},
                });
            });
            $(".item_show").on("click",function(){
                var id =$(this).attr('val');
                layer.open({
                    title:"查看详情",
                    area: ['450px', '400px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: '<div id="show_info"></div>',
                    success:function(){
                        info(id);

                    }
                });
            })

        },info=function(id){
            $.ajax({
                url:'/admin/withdraw_record',
                dataType:"json",
                type:'post',
                data:{id:id},
                success:function(result) {
                    var tpl = $("#show_detail").html();
                    $("#show_info").html(template(tpl,{info:result.data}));
                }
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.sex=$("#sex").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            fetch();
        });

		$("#addBatchNo").on("click",function(e){
			$.ajax({
				url:'/admin/create_batch',
				dataType:"json",
				type:'post',
				success:function(result) {
					if(result.error==0){
						layer.msg("添加成功",{icon:1,time:2000});
					} else {
						layer.msg("添加失败",{icon:2,time:2000});
					}
				}
			});
		});
        

        this.init();
    })
</script>
@endsection
