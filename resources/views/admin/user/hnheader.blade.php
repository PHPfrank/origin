@extends('admin.master')
@section('content')
<script type="text/javascript" src="/static/js/page.js"></script>
<script type="text/javascript" src="/static/js/lightbox.js"></script>
<link href="/static/css/lightbox.css" rel="stylesheet">
<div class="right_col" role="main">
<div class="page-title">
<div class="title_left">
<h3>红娘头像审核</h3>
</div>
</div>
<div class="clearfix"></div>
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_content">
<p class="text-muted font-13 m-b-30"></p>
<div class="btn-group" data-toggle="buttons">
<a class="btn  btn-primary show_page" value="0">审核列表</a>
<a class="btn btn-default show_page" value="1">已通过列表</a>
<a class="btn btn-default show_page" value="-1">未通过列表</a>
</div>
<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
<thead>
<tr>
<th class="col-md-1" style="text-align: center;">UID</th>
<th class="col-md-1" style="text-align: center;">头像</th>
<th class="col-md-1" style="text-align: center;">昵称</th>
<th class="col-md-1" style="text-align: center;">性别</th>
<th class="col-md-2" style="text-align: center;">注册时间</th>
<th class="col-md-2" style="text-align: center;">操作</th>
</tr>
</thead>
<tbody id='data_list'>
</tbody>
</table>
<div id="pagination"> </div>
</div>
</div>
</div>
</div>
<script type="text/html" id="data_tpl">
<%for(var i = 0; i < data.length; i++) {%>
<tr>
<td style="vertical-align: middle;"><a href="/admin/hinfo?uid=<%=data[i].uid%>"><%=data[i].uid%></a></td>
<td>
	<a class="example-image-link" data-lightbox="example-set"  href="<%=data[i].header_url%>" data-lightbox="lightbox[roadtrip]<%=data[i].uid%>">
		<img src="<%=data[i].header_url%>" width="50px" height="50px">
	</a>
</td>
<td style="vertical-align: middle;"><%=data[i].nickname%></td>
<td style="vertical-align: middle;"><%if(data[i].sex==1){%>男<%}else{%>女<%}%></td>
<td style="vertical-align: middle;text-align:left;"><%=data[i].created_at%></td>
<td style="vertical-align: middle;text-align:left;">
<%if(data[i].header_url_status == 0) { %>
<button type="submit" class="btn btn-success" value="<%=data[i].uid%>">审核通过</button>
<button type="submit" class="btn btn-danger" value="<%=data[i].uid%>">审核不通过</button>
<%}%>
<%if(data[i].header_url_status == 1) { %>
<button type="submit" class="btn btn-danger" value="<%=data[i].uid%>">审核不通过</button>
<%}%>
<%if(data[i].header_url_status == -1) { %>
<button type="submit" class="btn btn-success" value="<%=data[i].uid%>">审核通过</button>
<%}%>
</td>
</tr>
<%}%>
</script>

<script type="text/javascript">
$(document).ready(function(){
	var _this = {};
	var _param = {};
	_this.init = function() {
		$.ajax({
			url:'/admin/hnheader_data',
			dataType:"json",
			type:'post',
			data:_param,
			success:function(result){
				$("#data_list").html(template($("#data_tpl").html(),{data:result.data.list}));
				pageinit({page:{pageSize:10,currentPage:result.data.page.page},_count:result.data.page.count},_param);
				_this.render();
			}
		});
	}

	//tab标签切换
	$(".btn-group a").click(function() {
		$(".btn-group a").removeClass("btn-primary");
		$(".btn-group a").addClass("btn-default");
		$(this).addClass("btn-primary");
		_param.status = $(this).attr("value");
		_this.init();
	});
		//加载完主要数据，渲染其他事件
		_this.render = function() {
			//审核通过
			$(".btn-success").click(function(){
				var pass_param = {uid:$(this).attr("value")};
				layer.confirm('确定审核通过？', {
					btn: ['确定','取消'] //按钮
				}, function(){
					$.ajax({
						url:'/admin/api/hnheader_pass',
						dataType:"json",
						type:'post',
						data:pass_param,
						success:function(result){
                            if(result.error==0){
                                layer.closeAll();
                                _this.init();
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
						}
					});

				});
			});
				//审核不通过
				$(".btn-danger").click(function(){
					var pass_param = {uid:$(this).attr("value")};
					layer.confirm('确定审核不通过？', {
				  btn: ['确定','取消'] //按钮
					}, function(){
						$.ajax({
							url:'/admin/api/hnheader_refuse',
							dataType:"json",
							type:'post',
							data:pass_param,
							success:function(result){
                                if(result.error==0){
                                    layer.closeAll();
                                    _this.init();
                                }else{
                                    layer.msg(result.msg,{icon:2,time:1000});
                                }
							}
						});

					});
				});
		}
		fetch = _this.init;
		_this.init();
});
</script>
@endsection
