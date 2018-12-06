@extends('admin.master')
@section('content')
<script type="text/javascript" src="/static/js/page.js"></script>
<script type="text/javascript" src="/static/js/lightbox.js"></script>
<link href="/static/css/lightbox.css" rel="stylesheet">

<div class="right_col" role="main">
<div class="page-title">
<div class="title_left">
<h3>信息配置<span style="font-size:14px;"></span></h3>
</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12 col-sm-12 col-xs-12">

	<div class="x_panel">
		<!-- 头部 -->
        <div class="x_title">
            <ul class="nav navbar-right panel_toolbox"></ul>
            <small><a href="javascript:void(0);" class="btn btn-sm btn-primary btn_add">添加配置</a></small>
            <div class="clearfix"></div>
        </div>

		
		
		<!-- 内容部 -->
		<form action="{{url('admin/editConfigs')}}" method="post">
		@foreach ($configs as $row)
		<div class="x_content">
		    @if($row['type'] == 2)
			    <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="font-size: 14px; padding-top: 8px; text-align: right;">{{$row['name']}} : ({{ $row['title'] }})
                            <span class=""></span>
               </label>
               <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    {{--<select class="select2_single form-control" tabindex="-1" id="type" >--}}
                        {{--<option value="0" @if($row['value'] == '0')selected='selected'@endif>关闭</option>--}}
                        {{--<option value="1" @if($row['value'] == '1')selected='selected'@endif>开启</option>--}}
                    {{--</select>--}}
                    <input type="radio"  @if($row['value'] == '0') checked="checked" @endif name="{{$row['name']}}" class=""  value="0">关闭
                    <input type="radio"  @if($row['value'] == '1') checked="checked" @endif name="{{$row['name']}}" class=""  value="1">开启

                    <a href="javascript:void(0)" style="margin-left: 100px" class="btn btn-danger btn-sm cancel" val="{{$row['title']}}"><i class="fa fa-lock"></i>删除</a>
               </div>
			@else
               <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="font-size: 14px;padding-top: 8px; text-align: right;">{{$row['name']}} : ({{ $row['title'] }})
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">

                    <input type="text"  name="{{$row['name']}}" class="form-control col-md-3 col-xs-12"  value="{{$row['value']}}">
                    <a href="javascript:void(0)" style="margin-left: 100px" class="btn btn-danger btn-sm cancel" val="{{$row['title']}}"><i class="fa fa-lock"></i>删除</a>
                </div>
			@endif
		</div>
		@endforeach
		<div class="x_content">

				<label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
					<input type="submit" id="info_edit" class="btn btn-sm btn-success" style="float: right;" value="修改">
				</label>

		</div>
		</form>
		<div class="x_title">
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="text-align: right;">公共上传图片：
			    <span class=""></span>
			</label>
			<div class="col-sm-3">
			    <div id="uploader-demo">
			        <div id="fileList" class="uploader-list album">
			        <div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>
			            <div id="file_List" val="0">
			                
			                    <a class="example-image-link" data-lightbox="example-set"  href="" rel="lightbox">
			                        <img width="400"  src="" title="上传图片到服务器返回图片地址">
			                    </a>
			                
			            </div>
			        </div>
			        <input type="hidden" value="" id="img_url" />
			        <br>
			        <div id="fileList-photo" class="uploader-list">
			                            </div>

			        <div id="filePicker">选择图片</div>

			    </div>
			</div>
		</div>

		<div class="x_content">
	        <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">
				<span class=""><!-- <input id='cp_btn' type="button"  value="复制链接"/> -->复制使用图片地址：</span>
			</label>
			<div class="col-md-8 col-sm-8 col-xs-8" style="">

				<input type="text"  name="cp_url" class="form-control col-md-3 col-xs-12" id='cp_url' value="">

			</div>
		</div>
	</div>
</div>

</div>

<script type="text/html" id="add_tpl">
<div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
<table class="table table-data">
<tbody>
<tr><td style="text-align:right;width:30%;">渠道名：</td><td><input id="title" type='text' class="select2_single form-control" value="" style="width:80%"></td></tr>
<tr><td style="text-align:right;width:30%;">描述：</td><td><input id="name" type='text' class="select2_single form-control" value="" style="width:80%"></td></tr>
<tr><td style="text-align:right;width:30%;padding-top:15px;">类型：</td><td><select id="type" class="select2_single form-control" tabindex="1" style="width:40%"><option value="2">开关</option><option value="1">其他配置</option></select></tr>
<tr>
<tr><td style="text-align:right;width:30%;">取值：</td><td><input id="value" type='text' class="select2_single form-control" placeholder="0-正常，1-审核模式" value="" style="width:80%"></td></tr>
<tr>
</tr>
<tr>
<td style="width:30%;"></td>
<td><a class="btn btn-success" id="enter">添加</a><a class="btn btn-primary" id="canel" style="margin-left:20px;">取消</a></td>
</tr>
</tbody>
</table>
</div>
</script>

<script type="text/javascript">
$(document).ready(function(){

	//删除配置操作
	$(".btn_del").on("click",function(e){
		var params = "id="+$(this).attr('value');
		layer.confirm('确定删除该配置？', {icon: 2, title:'删除配置'}, function(index){// 发送登录的异步请求
			$.post("/admin/switch_del",params,function(data, status){
				_this.init();
			});
			layer.close(index);
		});
	});

	// // 复制
	// $("#cp_btn").click(function(){
	// 	var copy_content = $("#cp_url").val();
	// 	copy_clip(copy_content);
	// });
});

        $(".cancel").on("click",function(e){
                var title =$(this).attr('val');
                var url = "/admin/delete_configs?title="+title;
                layer.confirm('确定删除该配置？', {icon: 2, title:'删除'},
                 function(value, index, elem){
                 $.ajax({url:url,success:function(data,status,xhr){
                            if(data.error == 0) {
                                layer.msg('删除成功',{
                                      icon: 6,
                                      time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                },function(){
                                    location.reload();
                                });
                            } else {
                                layer.msg(data.info, {icon: 6});
                            }

                            }
                        });
                    });
                  });

function copy_clip(copy_content) {
    var url = copy_content;     //需要复制的内容
    var txt = url.substring(url.indexOf(":") + 1, url.length);
    if (window.clipboardData) {
        window.clipboardData.clearData();
        window.clipboardData.setData("Text", txt);
        alert('恭喜，复制成功！');
    } else if (navigator.userAgent.indexOf("Opera") != -1) {
        window.location = txt;
    } else if (window.netscape) {
        try {
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
        } catch (e) {
            alert("您的firefox安全限制限制您进行剪贴板操作，请在新窗口的地址栏里输入'about:config'然后找到'signed.applets.codebase_principal_support'设置为true'");
            return false;
        }
        var clip = Components.classes["@mozilla.org/widget/clipboard;1"].createInstance(Components.interfaces.nsIClipboard);
        if (!clip)
            return;
        var trans = Components.classes["@mozilla.org/widget/transferable;1"].createInstance(Components.interfaces.nsITransferable);
        if (!trans)
            return;
        trans.addDataFlavor('text/unicode');
        var str = new Object();
        var len = new Object();
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
        var copytext = txt;
        str.data = copytext;
        trans.setTransferData("text/unicode", str, copytext.length * 2);
        var clipid = Components.interfaces.nsIClipboard;
        if (!clip)
            return false;
        clip.setData(trans, null, clipid.kGlobalClipboard);

    }
}

// 图片
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
uploader.on( 'fileQueued', function( file ) {
    var $li = $('<div id="" class="file-item thumbnail">'+'<a href="" rel="lightbox"><img style="width:200px;height:200px;margin-top:-20px;"></a>'+'</div>'),
    $img = $li.find('img');
    // $("#fileList-photo").html($li);
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
uploader.on( 'uploadSuccess', function( file,response ) {
    var html= '<a class="example-image-link" data-lightbox="example-set"  href="'+response.data+'" rel="lightbox" >'+'<img src="'+response.data+'" width="200" height="200" >'+'</a>';
    $("#file_List").html(html);
    $("#file_List").attr("val",1);
    // $.ajax({
    //     url:'/admin/UserDetailEdit',
    //     dataType:"json",
    //     type:'post',
    //     data:{header_url: response.data,uid:$("#uid").val()},
    //     success:function(result){
    //         if(result.error==0){
    //             layer.msg('修改成功',{icon:1,time:1000});
    //         }else{
    //             layer.msg(result.msg,{icon:2,time:1000});
    //         }
           
    //     }
    // });
    $("#cp_url").val(response.data);
    $("#img_url").val(response.data);
    $( '#'+file.id ).addClass('upload-state-done');
});

//添加配置操作
		$(".btn_add").on("click",function(e){
			var tpl = $("#add_tpl").html();
			var html = template(tpl,{});
			layer.open({
				id:'add_back_dialog',
				title:"添加配置",
				area: ['600px', '500px'],
				fix: false, //不固定
				content: html,
				btn:false,
				success:function(){
					$("#canel").on("click",function(){
						parent.layer.closeAll();
					});
					$("#enter").on("click",function(){
						var param = {};
						param.title = $("#title").val();
						param.name = $("#name").val();
						param.value = $("#value").val();
						param.type = $("#type").val();
						console.log(param);
				        if(param.type == 2){
				            if(param.value != 1 && param.value != 0){
				                layer.msg('开关值配置错误', {icon: 5});
                                return;
				            }
				        }
						$.ajax({
							url:'/admin/add_config',
							dataType:"json",
							type:"post",
							data:param,
							success:function(data){
								if(data.error==0) {
                                    layer.msg('添加成功',{
                                              icon: 6,
                                              time: 1000 //2秒关闭（如果不配置，默认是3秒）
                                        },function(){
                                            location.reload();
                                        });
                                } else {
                                    layer.msg('添加失败', {icon: 5});
                                }
							}

						});
					});
				}
			});
		});







</script>
@endsection