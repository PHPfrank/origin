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
                <h3>&nbsp;&nbsp;悬赏列表管理</h3>
                <br>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div  class="btn-group" data-toggle="buttons">
                        <a class="btn  <?php if($type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">悬赏列表</a>
                        <a class="btn <?php if($type==1){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="1">马甲号管理</a>
                    </div>
                </div>
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
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="0">启用</option>
                                    <option value="-1">禁用</option>
                                </select>
                            </div>
                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">性别:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="sex" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="1">男</option>
                                    <option value="2">女</option>
                                </select>
                            </div>
                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">是否支付:</label>
                            <div class="col-md-2" style="width:12%;">
                                <select class="select2_single form-control" id="is_pay" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="1">已支付</option>
                                    <option value="0">未支付</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">UID:</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">昵称:</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
                            </div>     
                            <label class="" for="first-name"
                                style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">工作地:</label>
                            <div class="col-md-1" style="width: 15%;">
                                <input type="text" id="workplace" name="workplace" class="form-control col-md-1" style="border-radius: 2px;" placeholder="浙江-杭州">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="" for="first-name"
                                           style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">排序规则:</label>

                            <div class="col-md-2" style="width: 12%;">
                                <select class="select2_single form-control" tabindex="-1" id="order"
                                        name="order">
                                    <option value="">请选择</option>
                                    <option value="1">创建时间</option>
                                    <option value="2">修改时间</option>
                                    <option value="3">权重值</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">创建时期:</label>
                            <div class="col-md-1" style="width:20%;">
                                <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:20%;">
                                <input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s')}}">
                            </div>

                            <div class="col-md-1">
                                <button type="button" class="btn btn-success" id="search">查询</button>
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
									<th class="column-title" style="text-align: center;">悬赏ID</th>
                                    <th class="column-title" style="text-align: center;">UID</th>
									<th class="column-title" style="text-align: center;">昵称</th>
									<th class="column-title" style="text-align: center;">形象照</th>
                                    <th class="column-title" style="text-align: center;">性别</th>
                                    <th class="column-title" style="text-align: center;">谢媒金</th>
                                    <th class="column-title" style="text-align: center;">是否支付</th>
                                    <th class="column-title" style="text-align: center;">权重值</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: center;">操作</th>
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
</div>
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class=" " style="vertical-align:middle;"><%=data[i].fid%></td>
            <td class=" " style="vertical-align:middle;"><a href="/admin/user_detail?uid=<%=data[i].uid%>"><%=data[i].uid%></a></td>
			<td class=" " style="vertical-align:middle;"><%=data[i].nickname%></td>
			<td><img src="<%=data[i].img%>" width="50px" height="50px"></td>
			<td class=" " style="vertical-align:middle;"><%if(data[i].sex==1){%>男<%}else if (data[i].sex == 2){%>女<%} else {%>未知<% } %></td>
			<td class=" " style="vertical-align:middle;"><%=data[i].matchmaker_gold%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].is_pay==1){%><font color='green'>已支付</font><% } else  {%> <font color='red'>未支付</font><% } %></td>
			<td class=" " style="vertical-align:middle;"><%=data[i].weights%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].created_at%></td>
            <td class=" last" style="vertical-align:middle;width:25%;">
				<a href="javascript:void(0)" class="btn btn-success btn-sm recommend_oper" id="" val="<%=data[i].fid%>"><i class="fa fa-sign-in"></i> 推荐 </a>
                <a href="/admin/user_resource?uid=<%=data[i].uid%>" class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 详情 </a>
                <%if(data[i].status==0){%><a class="btn btn-danger btn-sm item_close" val="<%=data[i].uid%>" ><i class="fa fa-lock" title="禁用" ></i>禁用</a><%}else{%><a class="btn btn-info btn-sm item_open" val="<%=data[i].uid%>"><i class="fa fa-unlock" title="启用"></i> 启用</a><%}%>
            </td>
        </tr>
        <%}%>
</script>
<script type="text/javascript">
	$(function(){
        $('.form_datetime').datetimepicker({
            // minView: "month", //选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            format: 'yyyy-mm-dd hh:ii:ss',
            todayBtn:  1,
            autoclose: 1
        });
        var _this={};
        _this.page=1;
        _this.vest='<?=$type?>';
        this.init=function(){
           fetch();
        },
        fetch=function(){
        	console.log(_this);
            $.ajax({
                url:'/admin/user_find_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.data}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            
            $(".recommend_oper").on("click",function(){
            	var fid =$(this).attr('val');
            	layer.prompt({
               	  title: '推荐悬赏',
               	  value:'请输入推荐权重数值（推荐值范围1-10）',
               	  formType: 2 //prompt风格，支持0-2
               	}, function(value, index, elem){
                 	var url = "/admin/recommend_bounty?fid="+fid+"&weights="+value;
                 	$.ajax({url:url,success:function(data,status,xhr){
                 		if(data.error == 0) {
                 			layer.msg('添加成功', {icon: 6});
                 			layer.close(index);
                 			fetch();
                 		} else {
                 			layer.msg(data.info, {icon: 6});
                 		}
                 	 }});
                 });
            });
            
            $(".item_close").on("click",function(e){
                var uid =$(this).attr('val');
                $.ajax({
                    url:'/admin/bountyStatus',
                    dataType:"json",
                    type:'get',
                    data:{status:-1,uid:uid},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            $(".item_open").on("click",function(e){
                var uid =$(this).attr('val');
                $.ajax({
                    url:'/admin/bountyStatus',
                    dataType:"json",
                    type:'get',
                    data:{status:0,uid:uid},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });

            
        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['238px', '50px']
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.sex=$("#sex").val();
            _this.is_pay =$("#is_pay").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            _this.workplace = $.trim($("#workplace").val());
            _this.order = $.trim($("#order").val());
            fetch();
        });
        $(".show_page").on("click",function(e){
            _this.vest=$(this).attr('val');
           window.location.href='/admin/userList?type='+_this.vest;

        });
        $("#create_user").on("click",function(){
            layer.open({
                title:"生成马甲号",
                area: ['300px', '230px'],
                fix: false, //不固定
                maxmin: true,
                content:'<textarea id="num" class="form-control" required="required" rows="4" placeholder="请填写生成几个马甲号"></textarea>',
                btn:['确定','取消'],
                success:function(){
                    $("#num").parent('div').css("height","148px");
                },
                yes:function(e){
                   var num =$.trim($("#num").val());
                    if(num==''){
                        msg='请输入需要生成马甲号的个数';
                        alert_msg(msg);
                        return false;
                    }
                    $.ajax({
                        url:'/admin/api/user_create_vest',
                        dataType:"json",
                        type:'post',
                        data:{num:num},
                        success:function(result){
                            if(result.error == 0) {
                                layer.msg("生成马甲号成功",{icon:1,time:2000});
                                fetch();
                            } else {
                                layer.msg(result.msg, {icon: 2,time: 1000 });
                            }

                        }
                    });

                }
            });
        });

        this.init();
    })
</script>
@endsection
