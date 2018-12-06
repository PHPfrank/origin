@extends('admin.master')
@section('content')
<script type="text/javascript" src="/static/js/page.js"></script>
<script type="text/javascript" src="/static/js/lightbox.js"></script>
<link href="/static/css/lightbox.css" rel="stylesheet">

<div class="right_col" role="main">
<div class="page-title">
<div class="title_left">
<h3>开关配置</h3>
</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="x_panel">
		<!-- 头部 -->
		<div class="x_title">
			<ul class="nav navbar-right panel_toolbox"></ul>
			<small><a href="javascript:void(0);" class="btn btn-sm btn-primary btn_add">添加配置</a></small>
			<div class="clearfix"></div>
		</div>
		
		<!-- 内容部 -->
		<div class="x_content">
			<div class="table-responsive">
				<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
				<thead>
				<tr class="headings">
				<th class="column-title" style="text-align: center;">应用包名</th>
				<th class="column-title" style="text-align: center;">应用版本</th>
				<th class="column-title" style="text-align: center;">安卓渠道</th>
				<th class="column-title" style="text-align: center;">审核开关</th>
				<th class="column-title" style="text-align: center;">安卓首发logo</th>
				{{--<th class="column-title" style="text-align: center;">筛选开关</th>--}}
				<th class="column-title" style="text-align: center;">备注</th>
				<th class="column-title" style="text-align: center;">创建时间</th>
				<th class="column-title" style="text-align: center;">操作</th>
				</tr>
				</thead>
				<tbody id ='data_list'></tbody>
				</table>
			</div>
			<div id="pagination"></div>
		</div>
	</div>
</div>

</div>

<script type="text/html" id="data_tpl">
<%for(var i = 0; i < data.length; i++) {%>
<tr>
<td style="vertical-align: middle;"><%=data[i].app_id%></td>
<td style="vertical-align: middle;"><%=data[i].app_version%></td>
<td style="vertical-align: middle;"><%=data[i].channel%></td>
<td style="vertical-align: middle;"><%if(data[i].pay_switch == 0) {%>关闭<% } else {%>开启<% } %></td>
<!--<td style="vertical-align: middle;"><%if(data[i].filter_switch == 0) {%>关闭<% } else {%>开启<% } %></td>-->
<td style="vertical-align: middle;"><img src='<%=data[i].channel_logo%>' width='50' alt='缺少logo'/></td>
<td style="vertical-align: middle;"><%=data[i].remark%></td>
<td style="vertical-align: middle;"><%=data[i].created_at%></td>
<td style="vertical-align: middle;text-align:middle;">
<button type="submit" class="btn btn-success btn-sm btn_oper fa fa-pencil" value="<%=data[i].id%>"> 修改</button>
<button type="submit" class="btn btn-danger btn-sm btn_del fa fa-trash-o" value="<%=data[i].id%>"> 删除</button>
</td>
</tr>
<%}%>
</script>

<script type="text/html" id="check_tpl">
<div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
<table class="table table-data">
<tbody>
<tr>
	<td style="text-align:right;width:30%;">系统：</td>
	<td>

	<select  class="select2_single form-control" id="os" tabindex="1" style="width:40%">
		<option value="android" <%if(data.os=='android') {%>selected<%}%>>android</option>
		<option value="ios" <%if(data.os=='ios') {%>selected<%}%>>ios</option>
	</select>
	</td>
</tr>
<tr><td style="text-align:right;width:30%;">应用包名：</td><td><input id="app_id" type='text' class="select2_single form-control" value="<%=data.app_id%>" style="width:80%"></td></tr>
<tr><td style="text-align:right;width:30%;">应用版本：</td><td><input id="app_version" type='text' class="select2_single form-control" value="<%=data.app_version%>" style="width:80%"></td></tr>
<tr>
<td style="text-align:right;width:30%;padding-top:6%;">安卓渠道：</td>
<td><input id="channel" type='text' class="select2_single form-control" value="<%=data.channel%>" style="width:80%"></td>
</tr>
<tr><td style="text-align:right;width:30%;padding-top:15px;">审核开关：</td><td><select id="pay_switch" class="select2_single form-control" id="oper_idea" tabindex="1" style="width:40%"><option value="1" <%if(data.pay_switch==1) {%>selected<%}%>>审核开启</option><option value="0" <%if(data.pay_switch==0) {%>selected<%}%>>审核关闭</option></select></tr>
<tr>
<!--<tr>-->
<!--	<td style="text-align:right;width:30%;padding-top:15px;">筛选开关：</td>-->
<!--	<td>-->
<!--		<select id="filter_switch" class="select2_single form-control" id="filter_switch" tabindex="1" style="width:40%">-->
<!--			<option value="1" <%if(data.filter_switch==1) {%>selected<%}%>>开启</option>-->
<!--			<option value="0" <%if(data.filter_switch==0) {%>selected<%}%>>关闭</option>-->
<!--		</select>-->
<!--	</td>-->
<!--</tr>-->

<tr>
<td style="text-align:right;width:30%;padding-top:6%;">安卓渠道logo：</td>
<td>
	<%if(data.channel_logo){%><img width='50' src='<%=data.channel_logo%>'/><%}%>
	<input id="channel_logo" type='text' class="select2_single form-control" value="<%=data.channel_logo%>" style="width:80%"/>
</td>
</tr>
<tr>
<td style="text-align:right;width:30%;padding-top:6%;">备注：</td>
<td><textarea id="oper_msg" style="width:80%" onblur="if(this.value == ''){this.style.color = '#ACA899'; this.value = '在此处填写备注(可以不填写)'; }" onfocus="if(this.value == '在此处填写备注(可以不填写)'){this.value =''; this.style.color = '#000000'; }" style="color:#ACA899;"><%=data.remark%></textarea></td>
</tr>
<tr>
<td style="width:30%;"></td>
<td><a class="btn btn-success" id="enter">修改</a><a class="btn btn-primary" id="canel" style="margin-left:20px;">取消</a></td>
</tr>
</tbody>
</table>
</div>
</script>



<script type="text/html" id="add_tpl">
<div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
<table class="table table-data">
<tbody>
<tr>
	<td style="text-align:right;width:30%;">系统：</td>
	<td>

	<select  class="select2_single form-control" id="os" tabindex="1" style="width:40%">
		<option value="android">android</option>
		<option value="ios">ios</option>
	</select>
	</td>
</tr>

<tr><td style="text-align:right;width:30%;">应用包名：</td><td><input id="app_id" type='text' class="select2_single form-control" value="" style="width:80%"></td></tr>
<tr><td style="text-align:right;width:30%;">应用版本：</td><td><input id="app_version" type='text' class="select2_single form-control" value="" style="width:80%"></td></tr>
<tr><td style="text-align:right;width:30%;padding-top:15px;">审核开关：</td><td><select id="pay_switch" class="select2_single form-control" id="oper_idea" tabindex="1" style="width:40%"><option value="1">审核开启</option><option value="0">审核关闭</option></select></td></tr>
<tr>
<!--<tr><td style="text-align:right;width:30%;padding-top:15px;">筛选开关：</td><td><select id="filter_switch" class="select2_single form-control" id="oper_idea" tabindex="1" style="width:40%"><option value="1">开启</option><option value="0">关闭</option></select></tr>-->
<td style="text-align:right;width:30%;padding-top:6%;">安卓渠道：</td>
<td><input id="channel" type='text' class="select2_single form-control" value="" style="width:80%"></td>
</tr>
<tr>
<td style="text-align:right;width:30%;padding-top:6%;">安卓渠道logo：</td>
<td>
	<input id="channel_logo" type='text' class="select2_single form-control" value="" style="width:80%"/>
</td>
</tr>
<tr>
<td style="text-align:right;width:30%;padding-top:6%;">备注：</td>
<td><textarea id="oper_msg" style="width:80%" onblur="if(this.value == ''){this.style.color = '#ACA899'; this.value = '在此处填写备注(可以不填写)'; }" onfocus="if(this.value == '在此处填写备注(可以不填写)'){this.value =''; this.style.color = '#000000'; }" style="color:#ACA899;"></textarea></td>
</tr>
<tr>
<td style="width:30%;"></td>
<td><a class="btn btn-success" id="enter">修改</a><a class="btn btn-primary" id="canel" style="margin-left:20px;">取消</a></td>
</tr>
</tbody>
</table>
</div>
</script>


<script type="text/javascript">
$(document).ready(function(){
	var _this = {};
	var _param = {is_oper:-1};
	//获取初始化数据
	_this.init = function() {
		$.ajax({
			url:'/admin/switch_data',
			dataType:"json",
			type:'post',
			data:_param,
			success:function(result){
				$("#data_list").html(template($("#data_tpl").html(),{data:result.data.data}));
				pageinit({page:{pageSize:10,currentPage:result.data.page},_count:result.data.count},_param);
				_this.render();
			}
		});
	};

	//加载完主要数据，渲染其他事件
	_this.render = function() {
		//修改配置操作
		$(".btn_oper").on("click",function(e){
			var id =$(this).attr('value');
			$.ajax({
				url:'/admin/switch_detail',
				dataType:"json",
				type:'get',
				data:{id:id},
				success:function(result){
					var tpl = $("#check_tpl").html();
					var html = template(tpl,{data:result.data});
					layer.open({
						id:'feed_back_dialog',
						title:"查看详情",
						area: ['600px', '600px'],
						fix: false, //不固定
						content: html,
						btn:false,
						success:function(){
							$("#canel").on("click",function(){
								parent.layer.closeAll();
							});
								$("#enter").on("click",function(){
									var param = {};
									param.id = result.data.id;
									param.app_id = $("#app_id").val();
									param.app_version = $("#app_version").val();
									param.pay_switch = $("#pay_switch option:selected").val();
									param.filter_switch = $("#filter_switch option:selected").val();
									param.remark = $("#oper_msg").val();
									param.channel = $("#channel").val();
									param.channel_logo = $("#channel_logo").val();
									param.os = $("#os").val();
									console.log(param);
									$.ajax({
										url:'/admin/switch_oper',
										dataType:"json",
										type:"post",
										data:param,
										success:function(ret){
											parent.layer.closeAll();
											_this.init();
										}
									});
								});
						}
					});
				}
			});
		});

		//删除配置操作
		$(".btn_del").on("click",function(e){
			var params = "id="+$(this).attr('value');
			layer.confirm('确定删除该配置？', {icon: 2, title:'删除配置'}, function(index){// 发送登录的异步请求  
		        $.post("/admin/switch_del",params,function(data, status){
		        	_this.init();
				});  
				layer.close(index);
			});
		});

		//添加配置操作
		$(".btn_add").on("click",function(e){
			var tpl = $("#add_tpl").html();
			var html = template(tpl,{});
			layer.open({
				id:'add_back_dialog',
				title:"添加配置",
				area: ['600px', '500px'],
				fix: false, //不固定
				content: html,
				btn:false,
				success:function(){
					$("#canel").on("click",function(){
						parent.layer.closeAll();
					});
					$("#enter").on("click",function(){
						var param = {};
						param.app_id = $("#app_id").val();
						param.app_version = $("#app_version").val();
						param.pay_switch = $("#pay_switch option:selected").val();
						param.filter_switch = $("#filter_switch option:selected").val();
						param.remark = $("#oper_msg").val();
						param.channel = $("#channel").val();
						param.channel_logo = $("#channel_logo").val();
						param.os = $("#os").val();
						console.log(param);
						$.ajax({
							url:'/admin/switch_oper',
							dataType:"json",
							type:"post",
							data:param,
							success:function(ret){
								parent.layer.closeAll();
								_this.init();
							}
						});
					});
				}
			});
		});
	
	}
	//做分页操作
	fetch = _this.init;
	//初始化操作
	_this.init();

});
</script>
@endsection