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
					<h3>新建商品</h3>
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
				<h2>基本信息</h2>
				<div class="clearfix"></div>
			</div>
            <div class="x_content">
        		<div class="row">
            		<div class="col-sm-3">
                		<div id="uploader-demo">
                    		<div id="fileList" class="uploader-list album">
                        	<div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
                        		<div id="file_List" val="0">
                     				<a class="example-image-link" data-lightbox="example-set"  href="<%=data.goods.image%>" rel="lightbox"><img width="200" height="200" src="<%=data.goods.image%>" ></a>
                            	</div>
                    		</div>
                    		<input type="hidden" value="<%=data.goods.image%>" id="image" /></input>
							           <br>
                    		<div id="filePicker">选择图片</div>
                		</div>
            		</div>
            		<div class="col-sm-4 ">
                            <div class="inbox-body" style="padding-top:10px;">
                                <div class="mail_heading row">

                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">标题:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text" style="width: 500px;" name="title" id="title" class="form-control col-md-3 col-xs-12" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">价格:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="price" id="price" class="form-control col-md-3 col-xs-12" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">划线价:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="origin_price" id="origin_price" class="form-control col-md-3 col-xs-12" value="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">库存:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="stock" id="stock" class="form-control col-md-3 col-xs-12" readonly="readonly" value="0">
                                        </div>
                                    </div>
                                </div>
                             </div>
                    </div>
                            <div class="form-group col-md-12">
                                <label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                                    <button id="info_edit" class="btn btn-sm btn-success" style="float: right;" >修 改 资 料</button>
                                </label>
                            </div>
                </div>
           	</div>
	</div>


	</script>
    <script type="text/javascript">

            $(function(){
                var init = function () {
                    $.ajax({
    	                url:'/admin/goods_detail_data',
    	                dataType:"json",
    	                type:'get',
    	                data:{id:0},
    	                success:function(result){
    	                    console.log(result);
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
                        _this.title =$("#title").val();
                        _this.price =$("#price").val();
                        _this.origin_price = $("#origin_price").val();
                        _this.stock = $("#stock").val();
                        _this.image = $("#image").val();
                        $.ajax({
                            url:'/admin/add_good',
                            dataType:"json",
                            type:'post',
                            data:_this,
                            success:function(result){
                                if(result.error==0){
                                    layer.msg('增加成功',{icon:1,time:1000});
                                    window.location.href = "/admin/base_good?type=1";
                                }else{
                                    layer.msg(result.msg,{icon:2,time:1000});
                                }
                            }
                        });
                    });
                    //变更会员VIP
                    $("#vip_edit").on("click",function(){
                        var _this={};
                        _this.uid =$("#uid").val();
                        _this.ic_vip_rss =$("#ic_vip_rss").val();
                        console.log(_this);
                        $.ajax({
                            url:'/admin/api/ic_vip_rss',
                            dataType:"json",
                            type:'post',
                            data:_this,
                            success:function(result){
                                if(result.error==0){
                                    init();
                                    layer.msg('修改成功',{icon:1,time:1000});
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
    //                    $.ajax({
    //                        url:'/admin/UserDetailEdit',
    //                        dataType:"json",
    //                        type:'post',
    //                        data:{header_url: response.data,uid:$("#uid").val()},
    //                        success:function(result){
    //                            if(result.error==0){
    //                                layer.msg('修改成功',{icon:1,time:1000});
    //                            }else{
    //                                layer.msg(result.msg,{icon:2,time:1000});
    //                            }
    //
    //                        }
    //                    });
                        //图片的地址
                        $("#image").val(response.data);
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
                                url: '/admin/api/goods_del_avater',
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