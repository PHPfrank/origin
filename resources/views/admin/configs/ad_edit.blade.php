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
			<div class="page-title">
				<div class="title_left">
					<h3>广告编辑</h3>
				</div>
				<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.location.href=document.referrer;">返回</a>
				
			</div>
			<div class="row">
				<div id="info-content" >
			</div>
         </div>
        </div>
    </div>
</div>
    <script type="text/html" id="info_tpl">
        <div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="x_title">
				<h2>详情</h2>
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
        		<div class="row">
            		<div class="col-sm-3">
                		<div id="uploader-demo">
                    		<div id="fileList" class="uploader-list album">
                        		<div id="file_List" val="0">
                            		<%if(data.data[0].img){%>
                        				<a class="example-image-link" data-lightbox="example-set"  href="<%=data.data[0].img%>" rel="lightbox"><img width="200" height="300" src="<%=data.data[0].img%>" ></a>
                            		<%}%>
                            	</div>
                    		</div>
                    		<input type="hidden" value="<%=data.data[0].img%>" id="img_url" />
							<br>
                    		<div id="filePicker">选择并修改图片</div>
                		</div>
            		</div>
 					<div class="col-sm-4 ">
       	  				<div class="inbox-body" style="padding-top:10px;">
            				<div class="mail_heading row">
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">ID:
                                        <span class=""></span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                        <input type="text"  name="id" id="id" class="form-control col-md-3 col-xs-12" value="<%=data.data[0].id%>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">url:
                                        <span class=""></span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                        <input type="text"  name="url" id="url" class="form-control col-md-3 col-xs-12" value="<%=data.data[0].url%>">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">开关:
                                        <span class=""></span>
                                    </label>
                                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                    {{--<select class="select2_single form-control" tabindex="-1" id="status" >--}}
                                        {{--<option value="1" <%if(data.data[0].status==1){%>selected='selected'<%}%>>可见</option>--}}
                                        {{--<option value="-1" <%if(data.data[0].status==-1){%>selected='selected'<%}%>>不可见</option>--}}
                                    {{--</select>--}}
                                    <input type="text"  name="status" id="status" class="form-control col-md-3 col-xs-12" value="可见" readonly="readonly>
                                </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                                        <button id="info_edit" class="btn btn-sm btn-success" style="float: right;" >修改提交</button>
                                    </label>
                                </div>
           	 				</div>
						</div>
					</div>
                        {{--<div class="row-fluid">--}}
                            {{--<div id="uploader-two" class="wu-example">--}}
                                {{--<div class="queueList-two">--}}
                                    {{--<ul class="filelist-two unstyled"></ul>--}}
                                    {{--<div id="dndArea" class="placeholder">--}}
                                        {{--<div id="filePicker-two"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>

			</div>
		</div>
	</div>
		
	</script>
    <script type="text/javascript">

        $(function(){
            var id = GetParam('id');
			if(!id){
			  id = 0;
			}
            var init = function () {
                $.ajax({
	                url:'/admin/get_ad_data',
	                dataType:"json",
	                type:'get',
	                data:{id:id},
	                success:function(result){
	                    //console.log(result);
	                    var tpl = $("#info_tpl").html();
	                    $("#info-content").html(template(tpl,{data:result.data}));
	                    render();
	                }
            	});
            }
            init();
            render=function(){
                $('.form_datetime').datetimepicker({
                    minView: "month", //选择日期后，不会再跳转去选择时分秒
                    language:  'zh-CN',
                    format: 'yyyy-mm-dd',
                    todayBtn:  1,
                    autoclose: 1
                });
                $("#house").on("change",function(e){
                    if($(this).val()==0){
                        $(".house_show").hide();
                    }else{
                        $(".house_show").show();
                    }
                });
                $("#info_edit").on("click",function(){
                   var _this={};
                    _this.id =$("#id").val();
                    _this.url =$.trim($("#url").val());
//                    _this.status = $.trim($("#status").val());
                    console.log(_this);
                    $.ajax({
                        url:'/admin/ad_edit',
                        dataType:"json",
                        type:'post',
                        data:_this,
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                        }
                    });
                });

                //图片上传
                var uploader_photo = WebUploader.create({
                    auto: true,
                    compress:false,
                    swf: '/static/swf/Uploader.swf',
                    server: '/admin/upload',
                    pick: '#upload-photo',
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    }
                });
                uploader_photo.on( 'fileQueued', function( file ) {
                    var $li = $('<div id="" class="file-item thumbnail">'+'<a href="" rel="lightbox"><img style="width:200px;height:200px;margin-top:-20px;"></a>'+'</div>'),
                    $img = $li.find('img');
                    $("#fileList-photo").html($li);
                        uploader.makeThumb( file, function( error, src ) {
                            if ( error ) {
                                $img.replaceWith('<span>不能预览</span>');
                                return;
                            }
                            $li.find('a').attr('href',src);
                            $img.attr( 'src', src );
                        },
                        500,
                        500
                    );
                });
                $(function(){
                    $("div.album").hover(function(){
                        $(this).find('.toolBar').show();
                        },
                    function(){
                        $(this).find('.toolBar').hide();
                    });

                    $(".del_album").on("click",function(e){
                        var id =$(this).attr('val');
                        $.ajax({
                            url:'/admin/api/user_del_album',
                            dataType:"json",
                            type:'post',
                            data:{id:id},
                            success:function(result){
                                if(result.error==0){
                                    layer.msg('删除成功',{icon:1,time:1000});
                                    init();
                                }else{
                                    layer.msg(result.msg,{icon:2,time:1000});
                                }
                            }
                        });
                    });
                });

                var uploader = WebUploader.create({
                    auto: true,
                    compress:false,
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
                        $.ajax({
                            url:'/admin/ad_edit',
                            dataType:"json",
                            type:'post',
                            data:{img_url: response.data,id:$("#id").val()},
                            success:function(result){
                                if(result.error==0){
                                    layer.msg('修改成功',{icon:1,time:1000});
                                }else{
                                    layer.msg(result.msg,{icon:2,time:1000});
                                }

                            }
                        });
                        $("#img_url").val(response.data);
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
                    layer.confirm('您确定要删除banner图片吗？', {
                        btn: ['确定','取消'] //按钮
                    }, function() {
                        if(falg==1){
                        	$("#img_url").val('');
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
                            	   $("#img_url").val('');
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
