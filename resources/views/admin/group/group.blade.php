@extends('admin.master') @section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>群组管理</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
					<ul class="nav navbar-right panel_toolbox"></ul>
					<small><a href="javascript:void(0);" class="btn btn-sm btn-primary"
						onClick="addGroup();">添加群组</a></small>
					<div class="clearfix"></div>
					</div>
					<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
									<th class="column-title" style="text-align: center;">序列号</th>
									<th class="column-title" style="text-align: center;">群组名</th>
									<th class="column-title" style="text-align: center;">状态</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: center;">操作</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($adminGroupList as $k => $v) {?>
									<tr class="even pointer">
										<td style="vertical-align: middle;"><?php echo $v->group_id;?></td>
										<td style="vertical-align: middle;"><?php echo $v->title;?> </td>
										<td style="vertical-align: middle;"><?php if($v->status == 0) {echo "<font color='green'>启用</font>";} else {echo "<font color='red'>禁用</font>";}?></td>
										<td style="vertical-align: middle;"><?php echo $v->created_at; ?></td>
										<td style="vertical-align: middle;"> 
											<a href="javascript:void(0)" onClick="modifyGroup(<?php echo $v->group_id;?>);" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i> 修改 </a>
											<a href="javascript:void(0)" onClick="userList(<?php echo $v->group_id;?>);" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> 用户 </a>
											<a href="javascript:void(0)" onClick="delGroup(<?php echo $v->group_id;?>);" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>
										</td>
									</tr>
								<?php }?>
                        	</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	//用户列表
	function userList(group_id)
	{
		layer.open({
			type: 2,
			title:"用户列表",
			area: ['600px', '400px'],
			fix: false, //不固定
			maxmin: true,
			content: '/admin/groupUser?group_id='+group_id
		});
	}

	//添加群组
	function addGroup()
	{
		layer.open({
			type: 2,
			title:"添加群组",
			area: ['600px', '95%'],
			fix: false, //不固定
			maxmin: true,
			content: '/admin/assignRule'
		});
	}

	//修改群组
	function modifyGroup(group_id)
	{
		layer.open({
			type: 2,
			title:"修改群组",
			area: ['600px', '95%'],
			fix: false, //不固定
			maxmin: true,
			content: '/admin/assignRule?group_id='+group_id
		});
	}

	//删除群组
	function delGroup(group_id)
	{
		layer.confirm('确定删除该群组？', {icon: 2, title:'删除群组'}, function(index){
			// 发送登录的异步请求  
			var params = "group_id="+group_id;
	        $.post("/admin/api/do_groupDel",params,function(data, status){
	        	if(data.error == 0) {
	        		layer.msg(data.desc, {icon: 1,time: 1000 }); 
	        		window.parent.location.reload();
				} else {
					layer.msg(data.msg, {icon: 2,time: 1000 });
				}
			});  
			layer.close(index);
		});
	}
</script>
@endsection
