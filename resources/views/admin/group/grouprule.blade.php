@extends('admin.tips') @section('content')
<div class="right_col" role="main">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<form id="authedit" class="form-horizontal form-label-left"
					novalidate>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2" for="name">群组名称
							<span class="required"></span>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-5">
							<input id="group_id" type="hidden" value="<?php if(isset($adminGroup->group_id)) {echo $adminGroup->group_id;}?>">
							<input id="name" class="form-control col-md-3 col-xs-3"
								data-validate-length-range="6" data-validate-words="2"
								name="name" placeholder="" required="required" type="text"
								value="<?php if(isset($adminGroup->title)) {echo $adminGroup->title;}?>">
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2" for="name">权限分配
							<span class="required"></span>
						</label>
						<div class="col-md-9 col-sm-9 col-xs-9">
							<ul class="list-unstyled" style="margin-top:10px;">
								<?php foreach ($adminRuleList as $k1 => $v1) { ?>
									<?php if($v1->level == 1) { ?>
										<li>
											|--<input type="checkbox" class="" name="rules" value="<?php echo $v1->id;?>"
											<?php if(isset($adminGroup->arrayRule) && (in_array($v1->id, $adminGroup->arrayRule))) {echo "checked";}?>
											> <?php echo $v1->title;?>
										</li>
										<p>
									<?php foreach ($adminRuleList as $k2 => $v2) {?>
										<?php if(($v2->level ==2) && ($v2->pid == $v1->id)) { ?>
											<li>
												|---------
												<input type="checkbox" class="" name="rules" value="<?php echo $v2->id;?>"
												<?php if(isset($adminGroup->arrayRule) && (in_array($v2->id, $adminGroup->arrayRule))) {echo "checked";}?>
												> <?php echo $v2->title;?>
											</li>
											<p>
											<?php foreach ($adminRuleList as $k3 => $v3) {?>
												<?php if(($v3->level ==3) && ($v3->pid == $v2->id)) { ?>
													<li>
														|----------------
														<input type="checkbox" class="" name="rules" value="<?php echo $v3->id;?>"
														<?php if(isset($adminGroup->arrayRule) && (in_array($v3->id, $adminGroup->arrayRule))) {echo "checked";}?>
														> <?php echo $v3->title;?>
													</li>
													<p>
											<?php }?>
												<?php }?>
											<?php }?>
										<?php } ?>
									<?php }?>
								 <?php }?>
							</ul>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-2"
							for="textarea">状态 <span class="required"></span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-7" style="padding-top: 7px;">
							<label> 
								<input type="radio" value="0" id="optionsRadios1" name="status" <?php if(isset($adminGroup->status) && ($adminGroup->status == 0)) {echo "checked";}?>> 启用 
								<input type="radio" value="-1" id="optionsRadios1" name="status" <?php if(isset($adminGroup->status) && ($adminGroup->status == -1)) {echo "checked";}?>> 禁用
							</label>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-12 col-xs-8 col-md-offset-3">
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
<script type="text/javascript">
	$("#cancel").click(function(){
		parent.layer.closeAll();
	})
	$("#tijiao").click(function(){  
	    var name = $("#name").val(); 
	    var status = $('input[name="status"]:checked').val(); 
	    var rules = [];
	    var msg = "";
	    var group_id = $("#group_id").val();
	    $('input[name="rules"]:checked').each(function(){
	    	rules.push($(this).val());
		})
	    if(name == "") {
			msg = "用户名不能为空！";
			$("#name").focus();
	    } else if(status == undefined) {
			msg = "状态不能为空！";
		}
	    if (msg != ""){  
	    	layer.msg(msg, {icon: 2,time: 1000 }); 
	    }else{ 
 		    var params = "name="+name+"&rule="+rules.join()+"&status="+status;
 		   if(group_id) {
				params = params+"&group_id="+group_id;
			}
		    //发送异步请求  
		    $.post("/admin/api/do_assignrule", params, function(data, status){
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