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
                <h3>&nbsp;&nbsp;{{$title}}</h3>
                <br>
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
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">组员等级:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="level" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="1">组员</option>
                                    <option value="2">管理员</option>
                                    <option value="3">组长</option>

                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">小组ID:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="group_id"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">小组名称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="group_name"  class="form-control col-md-1" style="border-radius:2px;" placeholder="动次打次">
                            </div>

                            {{--<label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">性别:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="sex" tabindex="-1">--}}
                                    {{--<option value="">不限</option>--}}
                                    {{--<option value="1">男</option>--}}
                                    {{--<option value="2">女</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">状态:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="">不限</option>
                                    <option value="1">正常</option>
                                    <option value="2">禁言</option>

                                </select>
                            </div>
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">用户删除:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="is_delete" tabindex="-1">--}}
                                    {{--<option value="">不限</option>--}}
                                    {{--<option value="1">未删除</option>--}}
                                    {{--<option value="2">已删除</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">是否推荐:</label>--}}
                            {{--<div class="col-md-2" style="width:10%;">--}}
                                {{--<select class="select2_single form-control" id="is_recommend" tabindex="-1">--}}
                                    {{--<option value="all">不限</option>--}}
                                    {{--<option value="1">是</option>--}}
                                    {{--<option value="0">否</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            
                        </div>
                        <div class="form-group">
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">创建时间:</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d',strtotime('-7day'))}}">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:18%;">
                                <input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d')}}">
                            </div>

                            <div class="col-md-1" style="width:6%;">
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
                                    <th><input type='checkbox' id="qx" ></th>
                                    @foreach ($menu as $m)
                                        <th class="column-title" style="text-align: center;">{{ $m}}</th>
                                    @endforeach
                                    
									<th class="column-title" style="text-align: center;">操作</th>
								</tr>
							</thead>
							<tbody id ='data_list'>


                            </tbody>
						</table>

					</div>
                    <div>
                        {{--<a href="javascript:void(0)"  val='2' class="ck_dmc btn btn-success"><i class="fa fa-pinterest"></i>审核通过</a>--}}
                        {{--<a href="javascript:void(0)"  val='3' class="ck_dmc btn btn-success"><i class="fa fa-pinterest"></i>审核不通过</a>--}}
                    </div>
                    <div id="pagination">
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<img id='img_show' src="" style="position:fixed;right:0; top:0;display:none;max-height:100%;">
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class='t_box'><input type='checkbox' class="box" value='<%=data[i].id%>'></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].id%></td>
            <td class=" " style="vertical-align:middle;text-align:left;">
                <a href="/admin/group_list?group_id=<%=data[i].id%>" target='_blank'>
                    <img class='logo_img' src="<%=data[i].group_logo%>" width="50px" height="50px" style="cursor:pointer;"><%=data[i].group_name%>
                </a>
            </td>
            <td class=" " style="vertical-align:middle;text-align:left;">
                <%=data[i].nickname%><br>
                <%=data[i].uid%><br>
                <%if(data[i].sex==1){%>
                    <font color='green'>♂</font>
                <%}else if(data[i].sex==2){%>
                    <font color='red'>♀</font>
                <%}%>
            </td>
            <td class=" " style="vertical-align:middle;"><%=data[i].level_msg%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].status_msg%></td>
            <td class=" " style="vertical-align:middle;width:150px;"><%=data[i].created_at%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].dmc_num%></td>
            <td class=" " style="vertical-align:middle;">
                <%if(data[i].level==1){%>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="2" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user-plus"></i>设为管理员</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="3" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user-secret"></i>设为组长</a>
                <%}else if(data[i].level==2){%>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="1" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user"></i>设为组员</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="3" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user-secret"></i>设为组长</a>
                <%}else if(data[i].level==3){%>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="1" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user"></i>设为组员</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm level"  level="2>" g_id="<%=data[i].group_id%>"  val="<%=data[i].uid%>"><i class="fa fa-user-plus"></i>设为管理员</a>
                <%}%>

                <%if(data[i].status==1){%>
                    <a class="btn btn-danger btn-sm lock" lock="2" g_id="<%=data[i].group_id%>" val="<%=data[i].uid%>" ><i class="fa fa-lock" title="禁言" ></i>禁言</a>
                <%}else{%>
                    <a class="btn btn-info btn-sm lock" lock="1" g_id="<%=data[i].group_id%>" val="<%=data[i].uid%>"><i class="fa fa-unlock" title="解禁"></i> 解禁</a>
                <%}%>

                <a class="btn btn-info btn-sm add_group_dmc" type="2" g_id="<%=data[i].group_id%>" val="<%=data[i].uid%>"><i class="fa fa-paper-plane" title="发布话题"></i></a>
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
        $("#uid").val(GetParam('uid'));
        $("#group_id").val(GetParam('group_id'));
        _this.uid=GetParam('uid');
        _this.group_id=GetParam('group_id');
        _this.status=$("#status").val();
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/group_member_list_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.list}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);

            // 封面图
            $(".dmc_img").on("click",function(e){
                var img_id = $(this).attr('val');
                $.ajax({
                    url:"/admin/set_img_weights?id="+img_id,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            //设置组员等级
            $(".level").on("click",function(e){
                var data = {};
                data.uid = $(this).attr('val');
                data.g_id = $(this).attr('g_id');
                data.level = $(this).attr('level');
                $.ajax({
                    url:"/admin/api/change_level",
                    dataType:"json",
                    type:'get',
                    data:data,
                    success:function(result){
                        if(result.error == 0) {
                            layer.msg('设置成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg(result.desc, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            //小组禁言
            $(".lock").on("click",function(e){
                var data = {};
                data.uid = $(this).attr('val');
                data.g_id = $(this).attr('g_id');
                data.status = $(this).attr('lock');
                $.ajax({
                    url:"/admin/api/speak_on_off",
                    dataType:"json",
                    type:'get',
                    data:data,
                    success:function(result){
                        if(result.error == 0) {
                            layer.msg('设置成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg(result.desc, {icon: 2,time: 1000 });
                        }
                    }
                });
            });

            //添加话题
            $('.add_group_dmc').click(function(){
                var data = {};
                data.type = $(this).attr('type');
                data.uid = $(this).attr('val');
                data.g_id = $(this).attr('g_id');

                var did = 0;
                $.ajax({
                    url:"/admin/api/add_dmc",
                    dataType:"json",
                    async:false,
                    type:'post',
                    data:data,
                    success:function(result){
                        if(result.data.id) {
                            did = result.data.id;
                            layer.msg('添加成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg(result.info, {icon: 2,time: 1000 });
                        }
                    }
                });
                window.open("/admin/dmc_info?id="+did);
            });




            $('#qx').click(function(){
                if(this.checked){
                    $('.box').prop('checked',true);
                }else{
                    $('.box').prop("checked",false);
                }
            });
            $(".t_box").click(function(){
                var box = $(this).find('input[type="checkbox"]');
                box.click();
            });

            $('.logo_img').click(function(){
                var src = $(this).attr('src');
                var myWindow = window.open('');
                myWindow.document.write("<img src='"+src+"' >");
            });
            //
            $(".logo_img999").mouseover(function(){
                var src = $(this).attr('src');
                $('#img_show').attr('src',src);
                $('#img_show').show();
                // setTimeout(function(){
                //     $('#img_show').attr('src',src);
                //     $('#img_show').show();
                // },300);

                // $(this).parent().find('div').show();
            });
            $(".logo_img999").mouseout(function(){
                $('#img_show').hide();
                // $(this).parent().find('div').hide();
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

        //审核
        $('.ck_dmc').on("click",function(e){
            var status = $(this).attr('val');

            var ids = '';
            var checked = $('.box:checked');
            checked.each(function(i,item){
                if(i==0){
                    ids += $(this).val();
                }else{
                    ids += ','+$(this).val();
                }
            });

            if(ids==''){
                layer.msg('没有操作对象', {icon: 2,time: 1000 });
                return false;
            }
            // alert('dids');
            console.log(ids);
            layer.confirm('确认提交', {
                btn: ['确定','取消'] //按钮
            }, function() {
                $.ajax({
                    url:"/admin/api/ck_group?ids="+ids+'&status='+status,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            layer.msg('提交成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            return false;

        });
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.close=$("#close").val();
            _this.sex=$("#sex").val();
            _this.uid =$.trim($("#uid").val());
            _this.level =$.trim($("#level").val());
            _this.group_id =$.trim($("#group_id").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.group_name =$.trim($("#group_name").val());
            _this.start_time = $.trim($("#start_time").val());
            _this.end_time = $.trim($("#end_time").val());
            _this.active_start_time = $.trim($("#active_start_time").val());
            _this.active_end_time = $.trim($("#active_end_time").val());
            _this.workplace = $.trim($("#workplace").val());
            _this.is_recommend = $.trim($("#is_recommend").val());
            _this.page=1;
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
