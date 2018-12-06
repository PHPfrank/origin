@extends('admin.master')
@section('content')
<link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
<script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
<script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
<div class="right_col" role="main">
<div class="">
<div class="page-title">
<div class="title_left">
<h3>&nbsp;&nbsp;云信消息</h3>
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
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">性&nbsp;别:</label>
<div class="col-md-2" style="width:12%;">
<select class="select2_single form-control" id="sex" tabindex="-1">
<option value="all">全部</option>
<option value="1">男</option>
<option value="2">女</option>
</select>
</div>

<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">身份:</label>
<div class="col-md-2" style="width:12%;">
<select class="select2_single form-control" id="is_bounty" tabindex="-1">
<option value="all">--全部--</option>
<option value="1">单身</option>
<option value="0">非单身</option>
</select>
</div>
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">用户状态:</label>
<div class="col-md-2" style="width:10%;">
<select class="select2_single form-control" id="status" tabindex="-1">
<option value="all">--全部--</option>
<option value="0">正常</option>
<option value="-1">关闭</option>
</select>
</div>
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">uid:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
</div>
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">昵&nbsp;称:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
</div>
</div>
<div class="form-group">
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">出生日期:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="birthday_start"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
</div>

<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">--至--:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="birthday_end"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
</div>
<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">注册日期:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="start_reg_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
</div>

<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">--至--:</label>
<div class="col-md-1" style="width:12%;">
<input type="text" id="end_reg_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
</div>
<div class="col-md-1">
<a  class="btn btn-success" id="search">查询</a>
</div>
</div>
</form>
<div class="clearfix"></div>
</div>
<div class="x_content" >
<div class="col-sm-12" id="main_content">

</div>
<div class="col-sm-12">
<div class="form-group col-md-12">
<label class="control-label col-md-2 col-sm-4 col-xs-4"
		for="last-name" style="padding-top: 8px; text-align: right;">用户UID:
		<span class=""></span>
		</label>
		<div class="col-md-8 col-sm-8 col-xs-8" style="">
		<input type="text" id="uids" name="last-name"
				class="form-control col-md-3 col-xs-12"
						value="" style="width: 50%;">&nbsp;如100000,100001
						</div>
						</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group col-md-12">
								<label class="control-label col-md-2 col-sm-4 col-xs-4"
										for="last-name" style="padding-top: 8px; text-align: right;">消息内容:
										<span class=""></span>
								</label>
								<div class="col-md-8 col-sm-8 col-xs-8" style="">
								<textarea style="width: 600px;height: 100px;" id="content" name="content"></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group col-md-12">
								<label class="control-label col-md-2 col-sm-4 col-xs-4"
										for="last-name" style="padding-top: 8px; text-align: right;">推送内容</br>（不填默认同消息内容）:
										<span class=""></span>
								</label>
								<div class="col-md-8 col-sm-8 col-xs-8" style="">
								<textarea style="width: 600px;height: 100px;" id="push_content" name="push_content"></textarea>
								</div>
							</div>
						</div>
								<div class="col-sm-12" style="text-align: center;margin-top: 10px;">
								<a  class="btn btn-sm btn-success" id="send_msg" >发送消息</a>
								</div>
								</div>

								</div>
								</div>
								</div>
								</div>
								<script type="text/html" id="item_list">
								<div class="form-group col-md-12">
								<div class="control-group">
								<label class="control-label col-md-2 col-sm-4 col-xs-4"
										for="last-name" style="padding-top: 8px; text-align: right;">人员选择(<%=count%>):
										<span class=""></span>
										</label>
										<div class="controls col-md-8 col-sm-8 col-xs-8">
										<table>
										<tr><td>用户列表</td><td></td><td>选中列表</td></tr>
										<tr>
										<td>
										<select style="width: 200px !important;height: 300px;" name="a_uid"  id='a_uid' multiple="multiple" ondblclick="javascript:moveRight()">
										<%for(var i=0;i<data.length;i++){%>
										<option value="<%=data[i].uid%>"><%if(data[i].nickname){%><%=data[i].nickname%><%}else{%><%=data[i].uid%><%}%></option>
										<%}%>
										</select>
										</td>
										<td>
										<input value=">" type="button"  style="width: 50px" name="button5" onclick="javascript:moveRight();"/></br>
										<input value=">>" type="button" style="width: 50px" name="button5" onclick="javascript:moveAll();"/></br>
										<input value="<" type="button" style="width: 50px" name="button5" onclick="javascript:moveLeft();"/></br>
										<input value="<<" type="button" style="width: 50px"  name="button5" onclick="javascript:moveAllLeft();"/></br>
										</td>
										<td>
										<select style="width: 200px !important;height: 300px;" name="s_uid"  id='s_uid' multiple="multiple" ondblclick="javascript:moveLeft()">
										</select>
										</td>
										</tr>
										</table>
										</div>
										</div>
										</div>
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
												fetch=function(){
													$.ajax({
														url:'/admin/netease_user',
														dataType:"json",
														type:'post',
														data:_this,
														success:function(result){
															var tpl = $("#item_list").html();
															$("#main_content").html(template(tpl,{data:result.data.user,count:result.data.count}));
														}
													});
												}
												$("#search").on("click",function(e){
													_this.sex=$("#sex").val();
													_this.uid =$.trim($("#uid").val());
													_this.is_bounty =$("#is_bounty").val();
													_this.type =$.trim($("#type").val());
													_this.nickname =$.trim($("#nickname").val());
													_this.birthday_start =$.trim($("#birthday_start").val());
													_this.birthday_end =$.trim($("#birthday_end").val());
													_this.reg_start_time =$.trim($("#start_reg_time").val());
													_this.reg_end_time =$.trim($("#end_reg_time").val());
													_this.status=$("#status").val();
													fetch();
												});
													$("#send_msg").on("click",function(){
														var uids =new Array();
														$("#s_uid option").each(function(){  //遍历所有option
															uids.push($(this).val());
														})
														var suid =uids.join(',');
														if(suid==''){
															suid =$("#uids").val();
														}
														if(suid==''){
															layer.msg('请输入用户uid!',{icon:2,time:2000});
															return false;
														}
														var content =$.trim($("#content").val());
														var push_content =$.trim($("#push_content").val());
														if(content==''){
															layer.msg('请输入要发送的消息内容',{icon:2,time:2000});
															return false;
														}
														$.ajax({
															url:'/admin/netease_send_msg',
															dataType:"json",
															type:'post',
															data:{uid:suid,content:content,push_content:push_content},
															success:function(result){
																if(result.error==0){
																	layer.msg('消息发送成功',{icon:1,time:2000});
																}else if(result.error==-100){
																	layer.msg('推送数量太多,一分钟内最多可推送50000条',{icon:2,time:2000});
																}else{
																	layer.msg('消息发送失败',{icon:2,time:2000});
																}
															}
														});
													});
										});
											function moveRight()
											{

												//得到第一个select对象
												var selectElement = document.getElementById("a_uid");
												var optionElements = selectElement.getElementsByTagName("option");
												var len = optionElements.length;


												if(!(selectElement.selectedIndex==-1))   //如果没有选择元素，那么selectedIndex就为-1
												{

													//得到第二个select对象
													var selectElement2 = document.getElementById("s_uid");

													// 向右移动
													for(var i=0;i<len ;i++)
													{
														selectElement2.appendChild(optionElements[selectElement.selectedIndex]);
													}
												}
											}

											//移动所有的到右边
											function moveAll()
											{
												//得到第一个select对象
												var selectElement = document.getElementById("a_uid");
												var optionElements = selectElement.getElementsByTagName("option");
												var len = optionElements.length;
												//将第一个selected中的数组翻转
												var firstOption = new Array();
												for(var k=len-1;k>=0;k--)
												{
													firstOption.push(optionElements[k]);

												}
												var lens = firstOption.length;
												//得到第二个select对象
												var selectElement2 = document.getElementById("s_uid");
												for(var j=lens-1;j>=0;j--)
												{
													selectElement2.appendChild(firstOption[j]);
												}
											}

											//移动选中的元素到左边
											function moveLeft()
											{
												//首先得到第二个select对象
												var selectElement = document.getElementById("s_uid");
												var optionElement = selectElement.getElementsByTagName("option");
												var len = optionElement.length;

												//再次得到第一个元素
												if(!(selectElement.selectedIndex==-1))
												{
													var firstSelectElement = document.getElementById("a_uid");
													for(i=0;i<len;i++)
													{
														firstSelectElement.appendChild(optionElement[selectElement.selectedIndex]);//被选中的那个元素的索引
													}
												}
											}

											//全部向左移
											function moveAllLeft()
											{
												var selectElement = document.getElementById("s_uid");
												var optionElements = selectElement.getElementsByTagName("option");
												var len = optionElements.length;
												var optionEls = new Array();
												for(var i=len-1;i>=0;i--)
												{
													optionEls.push(optionElements[i]);
												}
												var lens = optionEls.length;

												var firstSelectElement = document.getElementById("a_uid");
												for(var j=lens-1;j>=0;j--)
												{
													firstSelectElement.appendChild(optionEls[j]);
												}
											}
											</script>
											@endsection
