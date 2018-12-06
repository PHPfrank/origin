@extends('admin.master') 
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>&nbsp;&nbsp;用户管理</h3>
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
					<ul class="nav navbar-right panel_toolbox"></ul>
					<small><a href="javascript:void(0);" class="btn btn-sm btn-primary"
						onClick="addAuth();">添加用户</a></small>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
					<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
									<th class="column-title" style="text-align: center;">序列号</th>
									<th class="column-title" style="text-align: center;">用户名</th>
									<th class="column-title" style="text-align: center;">状态</th>
									<th class="column-title" style="text-align: center;">所属组</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: center;">操作</th>
								</tr>
							</thead>
							<tbody id ='data_list'>
                        <?php foreach ($adminUserList as $k => $v) {?>
                          <tr>
									<td style="vertical-align: middle;"><?php echo $v->auth_id;?></td>
									<td style="vertical-align: middle;"><?php echo $v->auth_name;?> </td>
									<td style="vertical-align: middle;"><?php if($v->status == 0) {echo "<font color='green'>启用</font>";} else {echo "<font color='red'>禁用</font>";}?></td>
									<td style="vertical-align: middle;"><?php if($v->group_id==0){?>超级管理员<?php } else {?><?=$v->group->title?><?php }?></td>
									<td style="vertical-align: middle;"><?php echo $v->created_at; ?></td>
									<td style="vertical-align: middle;">
                                        <a href="javascript:void(0)" onClick="modifyAuth(<?php echo $v->auth_id;?>);" class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i> 修改 </a>
										<a href="javascript:void(0)" onClick="delAuth(<?php echo $v->auth_id;?>);" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>
									</td>
								</tr>
                          <?php } ?>
                        </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function addAuth()
	{
		layer.open({
			type: 2,
			title:"添加用户",
			area: ['600px', '400px'],
			fix: false, //不固定
			maxmin: true,
			content: '/admin/authAdd'
		});
	}

	//修改
	function modifyAuth(auth_id)
	{
		layer.open({
			type: 2,
			title:"修改用户",
			area: ['600px', '400px'],
			fix: false, //不固定
			maxmin: true,
			content: '/admin/authAdd?auth_id='+auth_id
		});
		
	}

	//删除
	function delAuth(auth_id)
	{
		layer.confirm('确定删除该用户？', {icon: 2, title:'删除用户'}, function(index){
			// 发送登录的异步请求  
			var params = "auth_id="+auth_id;
	        $.post("/admin/api/do_authDel",params,function(data, status){
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
