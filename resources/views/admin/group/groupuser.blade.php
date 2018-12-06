@extends('admin.tips') @section('content')
<div class="right_col" role="main">
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>用户ID</th>
						<th>用户名</th>
						<th>状态</th>
						<th>创建时间</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($userList as $k => $v) {?>
					<tr>
						<th scope="row"><?php echo $v->auth_id;?></th>
						<td><?php echo $v->auth_name;?></td>
						<td><?php if($v->status == 0) {echo "<font color='green'>启用</font>";}else {echo "<font color='red'>禁用</font>";}?></td>
						<td><?php echo $v->created_at;?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
