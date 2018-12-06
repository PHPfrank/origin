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
					<h3>VIP资料编辑</h3>
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
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">VIP等级名称:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                       <textarea  id="level_name" name="last-name" rows="2" cols="10" class="form-control col-md-3 col-xs-12"><%=data.level_name%></textarea>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">VIP价格:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                       <textarea  id="money" name="last-name" rows="2" cols="10" readonly="readonly" class="form-control col-md-3 col-xs-12"><%=data.money%></textarea>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">VIP特权描述:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                       <textarea  id="remark" name="last-name" rows="2" cols="10" class="form-control col-md-3 col-xs-12"><%=data.remark%></textarea>
                </div>
            </div>
            <label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                <button id="info_edit" class="btn btn-sm btn-success" style="float: right;" >提交</button>
            </label>
        		
            <input type='hidden' name='id' id='id' value="<%=data.id%>">

	</script>
    <script type="text/javascript">

        $(function(){
            var id = GetParam('id');
            if(!id){
              id = 0;
            }
            var init = function(){
                $.ajax({
	                url:'/admin/vip_list_data',
	                dataType:"json",
	                type:'get',
	                data:{id:id},
	                success:function(result){
                      var list = result.data.list[0];
                      if(!list){
                        layer.msg('VIP不存在',{icon:2,time:1000});
                        return false;
                      }
                       console.log(list);
	                    var tpl = $("#info_tpl").html();
	                    $("#info-content").html(template(tpl,{data:list}));
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
               
                $("#info_edit").on("click",function(){
                    var _this={};
                    _this.id =$("#id").val();
                    _this.remark =$.trim($("#remark").val());
                    _this.level_name = $.trim($("#level_name").val());
                    _this.money = $.trim($("#money").val());
                    
                    console.log(_this);
                    $.ajax({
                        url:'/admin/vip_info_save',
                        dataType:"json",
                        type:'post',
                        data:_this,
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                                init();
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                        }
                    });
                });

                //相册上传
                var uploader_photo = WebUploader.create({
                    auto: true,
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
                    var $li = $('<div id="" style="float:left;" class="file-item thumbnail">'+'<a href="" rel="lightbox"><img style="width:200px;height:200px;margin-top:-20px;"></a>'+'</div>'),
                    $img = $li.find('img');
                    $("#fileList-photo").append($li);
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

                uploader_photo.on( 'uploadSuccess', function( file,response ) {
                    var params = "imgs="+response.data+"&did="+$("#did").val();
                    console.log(params);
                    $.post({
                        url:'/admin/api/dmc_info_save',//添加相册数据
                        data:params,
                        success:function(result){
                            init();
                        }
                    });
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
                        url:'/admin/UserDetailEdit',
                        dataType:"json",
                        type:'post',
                        data:{header_url: response.data,uid:$("#uid").val()},
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                            }
                           
                        }
                    });
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
                        	$("#header_url").val('');
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
                            	   $("#header_url").val('');
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
