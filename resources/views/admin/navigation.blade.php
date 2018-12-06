<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class=""><a href="javascript:;"
					class="user-profile dropdown-toggle" data-toggle="dropdown"
					aria-expanded="false">
					欢迎：<?php echo $adminUser["auth_name"];?>
					<span class=" fa fa-angle-down"></span>
				</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						{{--<li><a href="javascript:;"> 个人资料</a></li>--}}
						<li><a href="javascript:void(0);" class="admin_edit" val="<?php echo $adminUser["auth_name"];?>" > <span>修改密码</span>
						</a></li>
						<li><a href="/admin/login_out"><i class="fa fa-sign-out pull-right"></i>
								退出登录</a></li>
					</ul></li>
			</ul>
		</nav>
	</div>
</div>
<script type="text/html" id="ad_reply_tpl">

	<div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
		<table class="table table-data">
			<tbody>
                <tr>
                    <td colspan="2">
						<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="text-align: right;">
							<span class="">原密码:</span>
						</label>
						<div class="col-md-8 col-sm-8 col-xs-8" style="">
							<input type="password"  name="s_name" id="ad_old_pwd" style="width:200px;" class="form-control" value="">
                    	</div>
					</td>
                </tr>
                <tr>
					<td colspan="2">
						<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="text-align: right;">
							<span class="">新密码:</span>
						</label>
						<div class="col-md-8 col-sm-8 col-xs-8" style="">
							<input type="password"  name="s_name" id="ad_new_pwd" style="width:200px;" class="form-control" value="">
						</div>
					</td>
                </tr>
				<tr>
					<td colspan="2">
						<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="text-align: right;">
							<span class="">重复密码:</span>
						</label>
						<div class="col-md-8 col-sm-8 col-xs-8" style="">
							<input type="password"  name="s_name" id="ad_new_pwd_too" style="width:200px;" class="form-control" value="">
						</div>
					</td>
				</tr>

                <tr>
                    <td colspan="2">
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-1">
                                <a  class="btn btn-success" style="float: right;"  id="ad_canel">取消</a>
                                <a  class="btn btn-primary ad_tijiao" style="float: right; margin-right: 20px;" val="1"  >确认</a>
								<span id="ad_msg"></span>
                            </div>
                        </div>
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</script>
<script type="text/javascript">
$(function(){
	$(".admin_edit").on("click",function(e){
		var tpl = $("#ad_reply_tpl").html();
		var html =template(tpl,{});
		layer.open({
			id:'',
			title:"<?php echo $adminUser["auth_name"];?>",
			area: ['700px', '350px'],
			fix: false, //不固定
			maxmin: true,
			content: html,
			btn:false,
			success:function(){
				$(".ad_tijiao").on("click",function(){
					var dt = {};
					dt.old_pwd=$("#ad_old_pwd").val();
					dt.new_pwd=$("#ad_new_pwd").val();
					dt.new_pwd_too=$("#ad_new_pwd_too").val();
					$.ajax({
						url:'/admin/edit_pwd',
						dataType:"json",
						type:'post',
						data:dt,
						success:function(result){
							if(result.error==0){
								layer.msg('修改成功',{icon:6,time:1000});
								parent.layer.closeAll();
							}else{
								layer.msg(result.desc,{icon:2,time:1000});
								$("#ad_msg").val(result.msg);
							}
						}
					});

				});
				$("#ad_canel").on("click",function(){
					parent.layer.closeAll();
				});
		   }
		});

	});

});
</script>



