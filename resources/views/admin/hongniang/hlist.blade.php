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
				<h3>&nbsp;&nbsp;红娘管理</h3>
				<div class="col-md-6 col-sm-6 col-xs-12">
                    <div  class="btn-group" data-toggle="buttons">
                        <a class="btn  <?php if($type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">用户列表管理</a>
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
                                    <option value="all">--全部--</option>
                                    <option value="0">--启用--</option>
                                    <option value="-1">--禁用--</option>
                                </select>
                            </div>
                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">性别:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="sex" tabindex="-1">
                                    <option value="all">--全部--</option>
                                    <option value="1">--男--</option>
                                    <option value="2">--女--</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">uid:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">昵称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">创建时期:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">--至--:</label>
                            <div class="col-md-1" style="width:12%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>

                            <div class="col-md-1">
                                <a  class="btn btn-success" id="search">查询</a>
                            </div>
                            
                        </div>
                        <div class="form-group create_user" <?php if($type==0){?>style="display: none;"<?php }?>>
                            <div class="col-md-1">
                                <a  class="btn btn-success" id="create_user">生成马甲号</a>
                            </div>
                        </div>
                        

                    </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action"
							style="text-align: center;">
							<thead>
								<tr class="headings">
									<th class="column-title" style="text-align: center;">序列号</th>
                                    <th class="column-title" style="text-align: center;">Uid</th>
									<th class="column-title" style="text-align: center;">头像</th>
									<th class="column-title" style="text-align: center;">昵称</th>
									<th class="column-title" style="text-align: center;">生日</th>
                                    <th class="column-title" style="text-align: center;">性别</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
                                    <th class="column-title" style="text-align: center;">关注数</th>
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
            <td class=" " style="vertical-align:middle;"><%=data[i].id%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].uid%></td>
            <td class=" " style="vertical-align:middle;"><img src="<%=data[i].header_url%>" width="50px" height="50px"></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].nickname%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].birthday%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].sex==1){%>男<%}else{%>女<%}%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].concern_num%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].created_at%></td>
            <td class=" last" style="vertical-align:middle;">
                <a href="/admin/hinfo?uid=<%=data[i].uid%>" class="btn btn-info btn-xs" ><i class="fa fa-list-ul"></i> 详情 </a>
                <%if(data[i].status==0){%><a class="btn btn-danger btn-xs item_close" val="<%=data[i].uid%>" ><i class="fa fa-lock" title="禁用" ></i>禁用</a><%}else{%><a class="btn btn-info btn-xs item_open" val="<%=data[i].uid%>"><i class="fa fa-unlock" title="启用"></i> 启用</a><%}%>
                {{--<a href="javascript:void(0)"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除 </a>--}}
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
        _this.page=1;
        _this.vest='<?=$type?>';
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/get_hongniang',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
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
            $(".item_close").on("mouseover",function(e){
                layer.tips('禁用后用户将不能登录,请慎重操作!', $(this), {
                    tips: [1, 'red'],
                    time:2500
                });
            })
            $(".item_close").on("click",function(e){
                var uid =$(this).attr('val');
                $.ajax({
                    url:'/admin/api/user_status',
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
                    url:'/admin/api/user_status',
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
                closeBtn : 0,
                type:1,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;' data-toggle='tooltip' data-placement='top'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['238px', '50px']
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.sex=$("#sex").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            fetch();
        });

        $(".show_page").on("click",function(e){
            _this.vest=$(this).attr('val');
           window.location.href='/admin/hlist?type='+_this.vest;

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
                    console.log($("#num").parent('div'));
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
                        data:{num:num,type:1},
                        success:function(result){
                            //parent.layer.closeAll();
                            layer.msg("生成马甲号成功",{icon:1,time:2000});
                            fetch();
                        }
                    });

                }
            });
        });

        this.init();
    })
</script>
@endsection
