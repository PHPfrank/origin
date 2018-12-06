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
                <h3>&nbsp;&nbsp;用户管理</h3>
                <br>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div  class="btn-group" data-toggle="buttons">
                        <a class="btn  <?php if($type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">真实用户列表</a>
                        <a class="btn <?php if($type==1){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="1">马甲号管理</a>
                    </div>
                </div>
                <form action="/admin/add_apk" method="post" enctype="multipart/form-data" >
                    <input type="file" name="file">
                    <button type="submit"> 提交包 </button>
                </form>
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
                            
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">UID:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="user_id"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">昵称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">
                            </div>


                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">手机:</label>
                            <div class="col-md-1" style="width:15%;">
                                <input type="text" id="phone"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">
                            </div>

                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">来源:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="os" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="ios">苹果</option>
                                    <option value="android">安卓</option>
                                </select>
                            </div>

                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">是否会员:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="vip_level" tabindex="-1">
                                    <option value=-1>不限</option>
                                    <option value=0>否</option>
                                    <option value=1>是</option>
                                </select>
                            </div>
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">客户端:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="channel" tabindex="-1">--}}
                                    {{--<option value="all">不限</option>--}}
                                    {{--<option value="1">IOS</option>--}}
                                    {{--<option value="2">安卓</option>--}}
                                    {{--@foreach ($channels as $k=>$v)--}}
                                        {{--<option value="{{$v}}">{{$v}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}


                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">屏蔽:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="status" tabindex="-1">--}}
                                    {{--<option value="">不限</option>--}}
                                    {{--<option value="0">启用</option>--}}
                                    {{--<option value="-1">屏蔽</option>--}}

                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">封号:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="close" tabindex="-1">--}}
                                    {{--<option value="">不限</option>--}}
                                    {{--<option value="0">启用</option>--}}
                                    {{--<option value="-1">封号</option>--}}

                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">注销:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="is_cancel" tabindex="-1">--}}
                                    {{--<option value="0">正常</option>--}}
                                    {{--<option value="1">注销</option>--}}
                                    {{--<option value="">不限</option>--}}

                                {{--</select>--}}
                            {{--</div>--}}

                            
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">登陆时间:</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="active_start_time" name="active_start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="active_end_time" name="active_end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d')}}">
                            </div>


                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">注册时间:</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d')}}">
                            </div>

                        </div>
                        <div class="form-group">

                            <div class="col-md-1" style="width:6%;">
                                <button type="button" class="btn btn-success" id="search">查询</button>
                            </div>
                            <?php if($type==1){?>
                            <div class="col-md-1">
                                <a  class="btn btn-edit btn-info" id="create_user">生成马甲号</a>
                            </div>
                            <?php }?>
                        </div>

                        
                    </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="font-size: 14px;">
							<thead>
								<tr class="headings">
                                    <th class="column-title">UID</th>
                                    <th class="column-title">手机号</th>
                                    <th class="column-title" style="width: 100px;">昵称</th>
									<th class="column-title" style="width: 90px; height: 80px;">头像</th>
                                    <th class="column-title">来源</th>
                                    <th class="column-title">会员级别</th>
                                    <th class="column-title">注册时间</th>
                                    <th class="column-title">最近登陆</th>
									<th class="column-title">操作</th>
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
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class=" "><%=data[i].user_id%></td>
            <td class=" "><%=data[i].phone%></td>
			<td class=" "><%=data[i].nickname%></td>
            <td class=" "><img src="<%=data[i].avatar%>" width="90px" height="80px"></td>
            <td class=" "><%if(data[i].os=='ios'){%>苹果<%}else if(data[i].os=='android'){%>安卓<% } else { %>未知<% } %></td>
            <td class=" "><%if(data[i].vip_level==0){%>非会员<%}else{%>会员<% }%></td>
            <td class=" "><%=data[i].created_at%></td>
            <td class=" "><%=data[i].last_login_time%></td>
            <td class=" last" style="vertical-align:center;">
                <a href="/admin/user_detail?user_id=<%=data[i].user_id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 详情 </a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm cancel" val="<%=data[i].user_id%>"><i class="fa fa-lock"></i>注销</a>
            </td>
        </tr>
        <%}%>
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
        _this.user_id= GetParam('user_id');
        _this.page=1;
        _this.vest='<?=$type?>';
        _this.status = $("#status").val();
        //console.log(_this);
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/get_user_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.data,vest:result.data.vest}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            //加推荐
            $(".recommend_weights").on("click",function(){
                var uid =$(this).attr('val');
                layer.prompt({
                        title: '更新会员权重',
                        value:'请输入推荐权重数值（推荐值范围1-10）',
                        formType: 2 //prompt风格，支持0-2
                    }, function(value, index, elem){
                        var url = "/admin/api/weights_user?uid="+uid+"&weights="+value;
                        $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('推荐成功', {icon: 6});
                                layer.close(index);
                                fetch();
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }
                        }
                    });
                });
            });

            //注销账号
            $(".cancel").on("click",function(){
                var user_id =$(this).attr('val');
                layer.prompt({
                        title:'注销账号',
                        value:"确定要删除该账号吗！",
                        formType: 2 //prompt风格，支持0-2
                    }, function(value, index, elem){
                        var url = "/admin/api/cancel_user?user_id="+user_id;
                        $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('注销成功', {icon: 6});
                                layer.close(index);
                                fetch();
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }
                        }
                    });
                });
            });

            $(".item_open").on("click",function(e){
                var uid =$(this).attr('val');
                layer.prompt({
                        title: '解除禁用',
                        value:'解除禁用理由：',
                        formType: 2 //prompt风格，支持0-2
                    }, function(value, index, elem){
                        var url = "/admin/api/user_status?uid="+uid+"&status=0&msg="+value;
                        $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('解除禁用成功', {icon: 6});
                                layer.close(index);
                                fetch();
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }
                        }
                    });
                });  
            });
            $(".item_close1").on("click",function(e){
                var uid =$(this).attr('val');
                layer.prompt({
                        title: '封号',
                        value:'封号理由：',
                        formType: 2 //prompt风格，支持0-2
                    }, function(value, index, elem){
                        var url = "/admin/api/user_close?uid="+uid+"&close=-1&msg="+value;
                        $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('禁用成功', {icon: 6});
                                layer.close(index);
                                fetch();
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }
                        }
                    });
                });  
            });
            $(".item_open1").on("click",function(e){
                var uid =$(this).attr('val');
                layer.prompt({
                        title: '解封',
                        value:'解封理由：',
                        formType: 2 //prompt风格，支持0-2
                    }, function(value, index, elem){
                        var url = "/admin/api/user_close?uid="+uid+"&close=0&msg="+value;
                        $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('解除禁用成功', {icon: 6});
                                layer.close(index);
                                fetch();
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }
                        }
                    });
                });  
            });
        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['200px', '50px']
            });
        };
        $("#search").on("click",function(e){
            _this.page=1;
            _this.user_id =$.trim($("#user_id").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.phone =$.trim($("#phone").val());
            _this.os =$.trim($("#os").val());
            _this.vip_level =$.trim($("#vip_level").val());
            _this.start_time = $.trim($("#start_time").val());
            _this.end_time = $.trim($("#end_time").val());
            _this.active_start_time = $.trim($("#active_start_time").val());
            _this.active_end_time = $.trim($("#active_end_time").val());
            console.log(_this);
            fetch();
        });
        $(".show_page").on("click",function(e){
            _this.vest=$(this).attr('val');
           window.location.href='/admin/base_user?type='+_this.vest;

        });
        $("#create_user").on("click",function(){
            layer.open({
                title:"生成马甲号",
                area: ['300px', '230px'],
                fix: false, //不固定
                maxmin: true,
                content:'<input id="vest_nickname" class="form-control col-md-1" style="border-radius:2px;"  required="required"  placeholder="请填写马甲号昵称">' +
                                 '<input id="add_vest_price" class="form-control col-md-1" style="border-radius:2px;margin-top: 10px;" required="required"  placeholder="请填写购买vip价格">',
                btn:['确定','取消'],
                success:function(){
                    $("#num").parent('div').css("height","148px");
                },
                yes:function(e){
                   var nickname =$.trim($("#vest_nickname").val());
                   var vest_price =$.trim($("#add_vest_price").val());
                    $.ajax({
                        url:'/admin/api/user_create_vest',
                        dataType:"json",
                        type:'post',
                        data:{nickname:nickname,
                              vest_price:vest_price
                               },
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
