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
<h3>&nbsp;&nbsp;取现付款</h3>
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
<div class="col-md-3" style="width:15%;">
<select class="select2_single form-control" id="status" tabindex="-1">
	<option value="">不限</option>
	<option value="0">待操作</option>
	<option value="1">财务付款</option>
	<option value="2">付款中</option>
	<option value="3">付款成功</option>
	<option value="-1">付款失败</option>
</select>
</div>
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">批次号:</label>
<div class="col-md-2" style="width:20%;">
<input type="text" id="batch_no"  class="form-control col-md-4" style="border-radius:2px;" placeholder="">
</div>



<div class="col-md-3">
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
		<th class="column-title" style="text-align: center;">批次号</th>
		<th class="column-title" style="text-align: center;">人次</th>
		<th class="column-title" style="text-align: center;">总金额</th>
		<th class="column-title" style="text-align: center;">状态</th>
		<th class="column-title" style="text-align: center;">成功数</th>
		<th class="column-title" style="text-align: center;">失败数</th>
		<th class="column-title" style="text-align: center;">更新时间</th>
		<th class="column-title" style="text-align: center;">创建时间</th>
		<th class="column-title" style="text-align: centers;">操作</th>
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
		<td class=" " style="vertical-align:middle;"><%=data[i].batch_no%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].record_num%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].record_money%></td>
		<td class=" " style="vertical-align:middle;"><%if(data[i].status==0){%>待操作<%}else if(data[i].status==1){%><font color="blue">财务付款</font><%}else if(data[i].status==2){%><font color="blue">付款中..</font><%}else if(data[i].status==3){%><font color="green">付款成功</font><%}else if(data[i].status==-1){%><font color="red">付款失败</font><%}%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].record_suc%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].record_fail%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].updated_at%></td>
		<td class=" " style="vertical-align:middle;"><%=data[i].created_at%></td>
		<td class=" last" style="vertical-align:middle;">
		<%if(data[i].status==0){%>
			<a  class="btn btn-info btn-sm item_agree" val="<%=data[i].batch_no%>"><i class="fa fa-check"></i> 确认提交</a>
		<%}else if(data[i].status==1){%>
			<a  class="btn btn-success btn-sm item_pay" val="<%=data[i].batch_no%>" href="/admin/do_withdraw/<%=data[i].batch_no%>"> <i class="fa fa-paypal"></i> 付款</a>
		<%}%>

		<a  class="btn btn-info btn-sm item_show" val="<%=data[i].batch_no%>"><i class="fa fa-bars"></i> 批次列表</a>
		</td>
		</tr>
		<%}%>
		</script>
		<script type="text/html" id="show_detail">
		<div class="panel panel-default" style="border-top: 1px solid #dddddd;">
		<div class="panel-body">
		<p> 处理人：<%=info.auth_name%></p>
		<p> 状态：<% if(info.status==1){%><font color="green"> 待付款</font><%}else{%><font color="red"> 忽略</font><%}%></p>
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
		
		<script type="text/html" id="batch_detail">
		<table class="table table-striped jambo_table bulk_action" style="text-align: center;">
		<thead>
		<tr>
		<th class="col-md-2" style="text-align:center;">日期</th>
		<th class="col-md-2" style="text-align:center;">UID</th>
		<th class="col-md-2" style="text-align:center;">账号</th>
		<th class="col-md-2" style="text-align:center;">账户名</th>
		<th class="col-md-1" style="text-align:center;">金额</th>
		<th class="col-md-2" style="text-align:center;">状态</th>
		</tr>
		</thead>
		<tbody>
		<%for(var i = 0; i < info.length; i++) {%>
		<tr class="even pointer">
		<td class=" " style="vertical-align:left;"><%=info[i].updated_at%></td>
		<td class=" " style="vertical-align:left;"><%=info[i].uid%></td>
		<td class=" " style="vertical-align:left;"><%=info[i].account%></td>
		<td class=" " style="vertical-align:left;"><%=info[i].name%></td>
		<td class=" " style="vertical-align:left;"><%=info[i].amount%></td>
		<td class=" " style="vertical-align:left;">
			<% if(info[i].status==1){%><font color="green"> 待付款</font><%}else if(info[i].status==-1){%><font color="blue"> 忽略</font><%}else if(info[i].status==0){%><font color="green"> 待审核</font><%}else if(info[i].status==2){%><font color="green"> 付款成功</font><%}else if(info[i].status==-2){%><font color="red"> 付款失败</font><%}%>
		</td>
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
						url:'/admin/batch_data',
						dataType:"json",
						type:'get',
						data:_this,
						success:function(result){
							var tpl = $("#item_list").html();
							$("#data_list").html(template(tpl,{data:result.data.batchList}));
							render(result.data.count);

						}
					});
				},
				render=function(_count){
					pageinit({
						page:{pageSize:10,currentPage:_this.page},
						_count:_count
					},_this);
				//提交给财务
				$(".item_agree").on("click",function(e){
					var batch_no =$(this).attr('val');
					layer.confirm('确认提交给财务？', {
 						btn:['确定','取消']
 					},function(){
 						$.ajax({
 							url:'/admin/update_batch',
 							dataType:"json",
 							type:'get',
 							data:{batch_no:batch_no},
 							success:function(result){
 								if(result.error == 0) {
 									layer.msg('操作成功',{icon:1,time:2000});
 								}
 								fetch();
 							}
 						});
 						parent.layer.closeAll();
 					});
			});
					$(".item_show").on("click",function(){
						var batch_no =$(this).attr('val');
						layer.open({
							type:1,
							title:"批次详情",
							area: ['800px', '400px'],
							fix: false, //不固定
							maxmin: true,
							content: '<div id="show_info"></div>',
							success:function(){
								info(batch_no);
							}
						});
					});

				},info=function(batch_no){
					$.ajax({
						url:'/admin/batch_detail',
						dataType:"json",
						type:'post',
						data:{batch_no:batch_no},
						success:function(result) {
							var tpl = $("#batch_detail").html();
							$("#show_info").html(template(tpl,{info:result.data}));
						}
					});
				}
				$("#search").on("click",function(e){
					_this.page=1;
					_this.status=$("#status").val();
					_this.batch_no=$("#batch_no").val();
					fetch();
				});
				this.init();
		})
		</script>
		@endsection
