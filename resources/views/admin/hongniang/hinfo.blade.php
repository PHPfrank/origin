@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <link href="/static/css/lightbox.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/lightbox.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
                <a class="btn btn-default btn-primary btn-show" val="1">基本信息</a>
                <a class="btn btn-default" style="float: right;" href="javascript:void(0);" onclick="history.go(-1)">返回</a>
                <div id="info-content" >

            </div>
        </div>
    </div>
</div>
    </div>
    <script type="text/html" id="info_tpl">
        <div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="panel-heading">
                基本信息
            </div>
            <div class="panel-body">
        <div class="row">
            <div class="col-sm-3 mail_list_column">
                <div id="uploader-demo">
                    <div id="fileList" class="uploader-list album">
                        <div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
                        <div id="file_List" val="0">
                            <%if(info.header_url){%>
                        <a class="example-image-link" data-lightbox="example-set"  href="<%=info.header_url%>" rel="lightbox">
                            <img width="200" height="200" src="<%=info.header_url%>" >
                        </a>
                            <%}%>
                            </div>
                    </div>
                    <iput type="hidden" value="" id="header_url" />
                    <div id="filePicker">选择图片</div>
                </div>
            </div>

            <!-- /MAIL LIST -->

            <!-- CONTENT MAIL -->
            <div class="col-sm-4 ">
        <div class="inbox-body">
            <div class="mail_heading row">
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">类型:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text"  name="uid"
                               class="form-control col-md-3 col-xs-12" disabled
                               value="<%if(info.phone){%>手机用户<%}else{%>微信用户<%}%>">
                    </div>
                </div>
				<%if(info.phone){%>
				<div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">手机号:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text"  name="uid"
                               class="form-control col-md-3 col-xs-12" disabled
                               value="<%=info.phone%>">
                    </div>
                </div>
				<%}%>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">Uid:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text" id="uid" name="uid"
                               class="form-control col-md-3 col-xs-12" disabled
                               value="<%=info.uid%>">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">昵称:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text" id="nickname" name="nickname"
                               class="form-control col-md-3 col-xs-12"
                               value="<%=info.nickname%>">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">性别:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <select class="select2_single form-control" tabindex="-1"
                                id="sex" >
                            <option value="1" <%if(info.sex==1){%>selected='selected'<%}%>>男</option>
                            <option value="2" <%if(info.sex==2){%>selected='selected'<%}%>>女</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">资源数:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text"  name="uid"
                               class="form-control col-md-3 col-xs-12" disabled
                               value="<%=info.resource_num%>">
                    </div>
                </div>
            </div>
        </div>
        </div>


        <div class="col-sm-5">
            <div class="inbox-body">
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">成功案例:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text"  name="uid"
                               class="form-control col-md-3 col-xs-12" disabled
                               value="<%=info.success_num%>">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">出生年月:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text" id="birthday" name="last-name"
                               class="form-control col-md-3 col-xs-12 form_datetime"
                               value="<%=info.birthday%>">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">工作地:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text" id="workplace" name="last-name"
                               class="form-control col-md-3 col-xs-12"
                               value="<%=info.workplace%>">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-3 col-sm-3 col-xs-3"
                           for="last-name" style="padding-top: 8px; text-align: right;">头衔:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                        <input type="text" id="identity" name="last-name"
                               class="form-control col-md-3 col-xs-12"
                               value="<%=info.identity%>">
                    </div>
                </div>
                </div>
            </div>
            <div>
                <div class="form-group col-md-12">
                    <label class="control-label col-md-4 col-sm-4 col-xs-4"
                           for="last-name" style="padding-top: 8px; text-align: right;">自我介绍:
                        <span class=""></span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                    <textarea  id="Introduce" name="last-name" rows="2" cols="10"
                                               class="form-control col-md-3 col-xs-12"><%=info.introduce%></textarea>
                    </div>
                </div>
            </div>
            <div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-7 col-sm-7 col-xs-7"
                       for="last-name" style="padding-top: 8px; text-align: right;">
                    <button id="info_edit" class="btn btn-sm btn-success"
                            style="float: right;" >修改基本资料</button>
                </label>
				<% if(info.vest == 1) {%>
				<label class="control-label col-md-5 col-sm-5 col-xs-5"
                       for="last-name" style="padding-top: 8px; text-align: right;">
                    <button id="add_vestreource" class="btn btn-sm btn-success"
                            style="float: left;" >添加红娘资源</button>
                </label>
				<% } %>
            </div>
                </div>
        </div>
            </div>
        </div>
</script>
    <script type="text/javascript">

        $(function(){
            var uid ='<?=$uid?>';
            $.ajax({
                url:'/admin/get_info',
                dataType:"json",
                type:'get',
                data:{uid:uid},
                success:function(result){
                    var tpl = $("#info_tpl").html();
                    $("#info-content").html(template(tpl,{info:result.data.info}));
                    render();
                }
            });
            render=function(){
                $('.form_datetime').datetimepicker({
                    minView: "month", //选择日期后，不会再跳转去选择时分秒
                    language:  'zh-CN',
                    format: 'yyyy-mm-dd',
                    todayBtn:  1,
                    autoclose: 1
                });

                $("#info_edit").on("click",function(){
                   var _this={};
                    _this.uid =$("#uid").val();
                    _this.nickname = $.trim($("#nickname").val());
                    _this.birthday =$.trim($("#birthday").val());
                    _this.sex =$.trim($("#sex").val());
                    _this.workplace = $.trim($("#workplace").val());;
                    _this.Introduce =$.trim($("#Introduce").val());
                    _this.header_url =$.trim($("#header_url").val());
                    _this.identity =$.trim($("#identity").val());
                    $.ajax({
                        url:'/admin/api/hinfo_edit',
                        dataType:"json",
                        type:'post',
                        data:_this,
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                                $('.del_avater').parents('#fileList').children("#file_List").attr("val",0);
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                        }
                    });
                });

                $("#add_vestreource").on("click",function(){
					$.ajax({
						url:'/admin/create_vestresource',
						dataType:"json",
						type:'post',
						data:{uid:$("#uid").val()},
						success:function(result) {
							window.location.href='/admin/resource?rid='+result.data;
						}
					})
               	});
               	
                var uploader = WebUploader.create({
                    auto: true,
                    swf: '/static/swf/Uploader.swf',
                    server: '/admin/upload',
                    pick: '#filePicker',
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    }
                });
                uploader.on( 'uploadSuccess', function( file,response ) {
                    var html= '<a class="example-image-link" data-lightbox="example-set"  href="'+response.data+'" rel="lightbox" >'+'<img src="'+response.data+'" width="200" height="200" >'+'</a>';
                    $("#file_List").html(html);
                    $("#file_List").attr("val",1);
                    $("#header_url").val(response.data);
                    $( '#'+file.id ).addClass('upload-state-done');

                });
                $("div.album").hover(function(){
                    $(this).find('.toolBar').show();
                },function(){
                    $(this).find('.toolBar').hide();
                });
                $(".del_avater").on("click",function(e){
                    var uid =$("#uid").val();
                    var dom =$(this);
                    var falg=$(this).parents('#fileList').children("#file_List").attr("val");
                    layer.confirm('您确定要删除此头像吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        if(falg==1){
                            layer.msg('删除成功', {icon: 1, time: 1000});
                            dom.parents('#fileList').children("#file_List").html('');
                            return false;
                        }
                        $.ajax({
                            url: '/admin/api/user_del_avater',
                            dataType: "json",
                            type: 'post',
                            data: {uid: uid},
                            success: function (result) {
                                if(result.error==0){
                                    layer.msg('删除成功', {icon: 1, time: 1000});
                                    dom.parents('#fileList').children("#file_List").html('');
                                }else{
                                    layer.msg(result.msg, {icon: 2, time: 1000});
                                }
                            }
                        });
                    },function(){

                    })
                });
            }

        });
    </script>
@endsection
