@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <link href="/static/css/lightbox.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/lightbox.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/vendor/jquery.ui.widget.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.iframe-transport.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.22.0/js/jquery.fileupload.min.js"></script>
    <link href="https://cdn.bootcss.com/summernote/0.7.0/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/summernote/0.7.0/summernote.min.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="page-title">
				<div class="title_left">
					<h3>商品详情</h3>
				</div>
				<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.location.href=document.referrer;">返回</a>
				
			</div>
			<div class="row">
				<div id="info-content" ></div>
			</div>
         </div>
        </div>
    </div>
</div>
<script type="text/html" id="info_tpl">
        <div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="x_title">
                <h2>商品主图</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-3">
                        <div id="uploader-demo">
                            <div id="fileList" class="uploader-list album">
                            <%if(data.goods.type == 1){%>
                            <div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
                            <%}%>
                                <div id="file_List" val="0">
                                    <%if(data.goods.image){%>
                                        <a class="example-image-link" data-lightbox="example-set"  href="<%=data.goods.image%>" rel="lightbox"><img width="200" height="200" src="<%=data.goods.image%>" ></a>
                                    <%}%>
                                </div>
                            </div>
                            <%if(data.goods.type == 1){%>
                            <input type="hidden" value="<%=data.goods.image%>" id="image" /></input>
                                       <br>
                            <div id="filePicker">选择图片</div>
                            <%}%>
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
                                            <input type="text" style="width: 500px;" name="title" id="title" class="form-control col-md-3 col-xs-12" value="<%=data.goods.title%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">商品卖点:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text" style="width: 500px;" name="sell_point" id="sell_point" class="form-control col-md-3 col-xs-12" value="<%=data.goods.sell_point%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">类型:
                                            <span class=""></span>
                                        </label>
                                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                        <select class="select2_single form-control" tabindex="-1" id="tag" >
                                            <option value="0" <%if(data.goods.tag==0){%>selected='selected'<%}%>>普通商品</option>
                                            <option value="1" <%if(data.goods.tag==1){%>selected='selected'<%}%>>top5展示</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">分类:
                                            <span class=""></span>
                                        </label>
                                    <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                        <select class="select2_single form-control" tabindex="-1" id="cate_id" >
                                            <%if(data.goods.cate_id == 0){%>
                                            <option value="0" selected='selected'>未选择</option>
                                            <%}%>
                                            <%for(var i = 0; i < data.cate.length; i++) {%>
                                            <option value="<%=data.cate[i].id%>" <%if(data.goods.cate_id == data.cate[i].id){%>selected='selected'<%}%>><%=data.cate[i].name%></option>
                                            <%}%>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">价格:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="price" id="price" class="form-control col-md-3 col-xs-12" value="<%=data.goods.price%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">划线价:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="origin_price" id="origin_price" class="form-control col-md-3 col-xs-12" value="<%=data.goods.origin_price%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">销量:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="sold_num" id="sold_num" class="form-control col-md-3 col-xs-12" value="<%=data.goods.sold_num%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">库存:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="stock" id="stock" class="form-control col-md-3 col-xs-12" <%if(data.goods.type == 1){%>readonly="readonly"<%}%> value="<%=data.goods.stock%>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">排序:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <input type="text"  name="sort" id="sort" class="form-control col-md-3 col-xs-12" value="<%=data.goods.sort%>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">商品详情:
                                            <span class=""></span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-8" style="">
                                            <div style="width: 500px;" name="summernote" id="summernote" class="form-control col-md-3 col-xs-12"></div>
                                        </div>
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
            <%if(data.goods.type == 1){%>
             <div class="x_title">
                      <h2>商品详情图片</h2>
                      <div class="clearfix"></div>
                  </div>

            <div class="x_content">
              <div class="x_panel">
                  <div class="x_content">
                      <div class="row">
                          <%if(data.goods.item_imgs){%>
                             <%for(var i = 0; i < data.goods.item_imgs.length; i++) {%>
                             <div class="col-sm-3 mail_list_column album">
                               <div class="toolBar" style="display:none;"><i class="fa fa-trash-o del_album del" val="<%=data.goods.item_imgs[i]%>"></i></div>
                               <a href="<%=data.goods.item_imgs[i]%>" data-rel="colorbox" data-lightbox="roadtrip" rel="lightbox[]">
                                   <img width="200" height="200" src="<%=data.goods.item_imgs[i]%>" style="padding-bottom:10px;">
                               </a>
                           </div>
                              <%}%>
                          <%}%>

                              <div class="col-sm-3 album" >
                                  <div id="uploader-bridgeimg">
                                      <div id="fileList-photo" class="uploader-list" style="width:650px;">
                                      </div>
                                      <div id="upload-photos" style="padding-top:80px;">添加图片</div>
                                  </div>

                              </div>
                          </div>
                  </div>
              </div>

            </div>
            <%}%>
    </div>


    </script>

    <script type="text/javascript">

        $(function(){
            var id ='<?=$id?>';
            var init = function () {
                $.ajax({
	                url:'/admin/goods_detail_data',
	                dataType:"json",
	                type:'get',
	                data:{id:id},
	                success:function(result){
	                    console.log(result);
	                    var tpl = $("#info_tpl").html();
	                    //summernote编辑器
	                    $("#info-content").html(template(tpl,{data:result.data}));
	                    $('#summernote').summernote({
                             weight:50,
                             height:50,
                             focus:true,
                             maxHeight:null,
                             minHeight:null,
                             callbacks: {
                                         // onImageUpload的参数为files，summernote支持选择多张图片
                                         onImageUpload : function(files) {
                                             var $files = $(files);
                                             // 通过each方法遍历每一个file
                                             $files.each(function() {
                                                 var file = this;
                                                 // FormData，新的form表单封装，具体可百度，但其实用法很简单，如下
                                                 var data = new FormData();
                                                 // 将文件加入到file中，后端可获得到参数名为“file”
                                                 data.append("file", file);
                                                 // ajax上传
                                                 $.ajax({
                                                     data : data,
                                                     type : "POST",
                                                     url : "/admin/upload",// div上的action
                                                     cache : false,
                                                     contentType : false,
                                                     processData : false,
                                                     // 成功时调用方法，后端返回json数据
                                                     success : function(response) {
                                                         if (response.data) {
                                                             // 文件不为空
                                                                 // 获取后台数据保存的图片完整路径
                                                                 var imageUrl =response.data;
                                                                 // 插入到summernote
                                                                jQuery('#summernote').summernote('insertImage', imageUrl);
                                                         }

                                                     }

                                                 });
                                             });
                                         }
                                     }
                             });
                        $('#summernote').summernote('code', result.data.goods.desc);
	                    render();
	                }
            	});
            };
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
                    _this.id = '<?=$id?>';
                    _this.sort = $.trim($("#sort").val());
                    _this.title = $.trim($("#title").val());
                    _this.price = $.trim($("#price").val());
                    _this.origin_price = $.trim($("#origin_price").val());
                    _this.sold_num = $.trim($("#sold_num").val());
                    _this.stock = $.trim($("#stock").val());
                    _this.cate_id = $.trim($("#cate_id").val());
                    _this.sell_point = $.trim($("#sell_point").val());
                    _this.tag = $.trim($("#tag").val());
                    _this.desc = $('#summernote').summernote('code');
                    $.ajax({
                        url:'/admin/GoodsDetailEdit',
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
                    var id = '<?=$id?>';
                    var image = response.data;
                    $.ajax({
                        url:'/admin/GoodsImageEdit',
                        dataType:"json",
                        type:'post',
                        data:{id:id,image:image},
                        success:function(result){
                            if(result.error==0){
                                layer.msg('修改成功',{icon:1,time:1000});
                                render();
                            }else{
                                layer.msg(result.msg,{icon:2,time:1000});
                                init();
                            }

                        }
                    });
                    //图片的地址
                    $("#image").val(response.data);
                    $( '#'+file.id ).addClass('upload-state-done');
                });


                //相册上传
                var uploader_photos = WebUploader.create({
                    auto: true,
                    swf: '/static/swf/Uploader.swf',
                    server: '/admin/upload',
                    pick: '#upload-photos',
                    accept: {
                        title: 'Images',
                        extensions: 'gif,jpg,jpeg,bmp,png',
                        mimeTypes: 'image/*'
                    }
                });
                //监听fileQueued事件，通过uploader.makeThumb来创建图片预览图。
                uploader_photos.on( 'fileQueued', function( file ) {
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

                uploader_photos.on( 'uploadSuccess', function( file,response ) {
                    var new_item_img = response.data;
                    var id = '<?=$id?>';
                    $.ajax({
                        url:'/admin/GoodsImgEdit',
                        dataType:"json",
                        type:'get',
                        data:{id:id,new_item_img:new_item_img},
                        success:function(result){
                        if(result.error==0){
                               layer.msg('添加成功', {icon: 1, time: 1000});
                               var tpl = $("#info_tpl").html();
                              $("#info-content").html(template(tpl,{data:result.data}));
                              render();
                           }else{
                               layer.msg(result.desc, {icon: 2, time: 1000});
                               init();
                           }
                          }

                     });
                });

                $(".del_album").on("click",function(e){
                        var item_img =$(this).attr('val');
                        var id = '<?=$id?>';
                        var falg=$(this).parents('#fileList').children("#file_List").attr("val");
                        layer.confirm('您确定要删除此图片吗？', {
                            btn: ['确定','取消'] //按钮
                        }, function() {
                            if(falg==1){
                                $("#header_url").val('');
                                layer.msg('删除成功', {icon: 1, time: 1000});
                                dom.parents('#fileList').children("#file_List").html('');
                                return false;
                            }
                            $.ajax({
                                url: '/admin/GoodsImgEdit',
                                dataType: "json",
                                type: 'post',
                                data: {id: id,item_img:item_img},
                                success: function (result) {
                                   if(result.error==0){
                                       $("#header_url").val('');
                                       layer.msg('删除成功', {icon: 1, time: 1000});
                                       init();
                                   }else{
                                       layer.msg(result.msg, {icon: 2, time: 1000});
                                   }
                                }
                            });
                        },function(){

                        })
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
    {{--<script type="text/javascript" >--}}
    {{--$(document).ready(function() {--}}
     {{--$('#summernote').summernote({--}}
     {{--height:300,--}}
     {{--focus:true,--}}
     {{--maxHeight:null,--}}
     {{--minHeight:null--}}
     {{--});--}}
    {{--});--}}

    {{--</script>--}}

@endsection
