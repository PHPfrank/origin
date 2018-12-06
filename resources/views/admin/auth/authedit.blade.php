@extends('admin.tips') @section('content')
<div class="right_col" role="main">
<div>
	<div class="col-md-6 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<form id="authedit" class="form-horizontal form-label-left" novalidate>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2" for="name">用户名称
							<span class="required"></span>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-7">
							<input id="auth_id" type="hidden" value="<?php if(isset($authInfo->auth_id)) {echo $authInfo->auth_id;}?>">
							<input id="name" class="form-control col-md-9 col-xs-7" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text" value="<?php if(isset($authInfo->auth_name)) {echo $authInfo->auth_name;}?>">
						</div>
					</div>
					<div class="item form-group">
						<label for="password2"
							class="control-label col-md-3 col-sm-3 col-xs-2">用户密码</label>
						<div class="col-md-9 col-sm-9 col-xs-7">
							<input id="pwd" type="password" name="pwd" data-validate-length="6,8" class="form-control col-md-7 col-xs-7" required="required" value="<?php if(isset($authInfo->auth_pwd)) {echo $authInfo->auth_pwd;}?>">
						</div>
					</div>

					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2"
							for="telephone">所属组 <span class="required"></span></label>
						<div class="col-md-9 col-sm-9 col-xs-10" style="padding-top: 7px;">
							<label> 
								<?php foreach ($adminGroup as $k => $v) {?>
									<input type="checkbox" value="<?php echo $v->group_id;?>" name="group" <?php if(isset($authInfo->group_id) && ($authInfo->group_id == $v->group_id)) {echo "checked";}?>> <?php echo $v->title; ?> 
								<?php } ?>
							</label>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2"
							for="textarea">状态 <span class="required"></span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-7" style="padding-top: 7px;">
							<label> 
								<input type="radio" value="0" id="optionsRadios1" name="status" <?php if(isset($authInfo->status) && ($authInfo->status == 0)) {echo "checked";}?>> 启用 
								<input type="radio" value="-1" id="optionsRadios1" name="status" <?php if(isset($authInfo->status) && ($authInfo->status == -1)) {echo "checked";}?>> 禁用
							</label>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-3">
							<button type="reset" class="btn btn-success"
								style="float: right;" id="cancel">取消</button>
							<button type="button" class="btn btn-primary"
								style="float: right; margin-right: 20px;" id="tijiao">提交</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$("#cancel").click(function(){
		parent.layer.closeAll();
	})
	$("#tijiao").click(function(){  
	    var name = $("#name").val();  
	    var pwd = $("#pwd").val();  
	    var group = [];
	    var status = $('input[name="status"]:checked').val();
	    var auth_id = $("#auth_id").val();
	    var msg = "";  
	    $('input[name="group"]:checked').each(function(){
			group.push($(this).val());
		})
	    if(name == "") {
			msg = "用户名不能为空！";
			$("#name").focus();
	    } else if(pwd == "") {
			msg = "密码不能为空！";
			$("#pwd").focus();
	    } else if(!group.length) {
			msg = "请选择用户所属组";
		} else if(group.length > 1) {
			msg = "只能选择一个所属组";
		}
	    if (msg != ""){  
	    	layer.msg(msg, {icon: 2,time: 1000 }); 
	    }else{ 
	    	var params = "name="+name+"&pwd="+pwd+"&group="+group.join()+"&status="+status;
	    	if(auth_id) {
				params = params+"&id="+auth_id;
			}
	        //发送异步请求  
	        $.post("/admin/api/do_authedit", params, function(data, status){
				if(data.error == 0) {
					window.parent.location.reload();
					parent.layer.closeAll();  
				} else {
					layer.msg(data.msg, {icon: 2,time: 1000 });
				}
	        }, "json");  
	    }    
	}); 
</script>
@endsection
