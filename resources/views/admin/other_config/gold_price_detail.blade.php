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
					<h3>{{$title}}</h3>
				</div>
				<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.location.href=document.referrer;">返回</a>
				
			</div>
			<div class="row">
				<div id="info-content" >
			    </div>

            </div>
        </div>
    </div>
    <div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">       
        <form method='post' name='edit' action='api/gold_price_edit'>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">金币:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="gold" class="form-control col-md-3 col-xs-12" value="{{$info->gold}}">
                </div>
            </div> 
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">价格:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="money" class="form-control col-md-3 col-xs-12" value="{{$info->money}}">
                </div>
            </div> 
            {{--<div class="form-group col-md-12">--}}
                {{--<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="text-align: right;">ICO：--}}
                {{--<span class=""></span>--}}
                {{--</label>--}}
                {{--<div class="col-sm-3">--}}
                    {{--<div id="uploader-demo">--}}
                        {{--<div id="fileList" class="uploader-list album">--}}
                        {{--<div class="toolBar"><i class="fa fa-trash-o del del_avater"  ></i></div>--}}
                            {{--<div id="file_List" val="0">--}}
                                {{----}}
                                    {{--<a class="example-image-link" data-lightbox="example-set"  href="{{$info->ico}}" rel="lightbox">--}}
                                        {{--<img width="80"  src="{{$info->ico}}" title="上传图片到服务器返回图片地址">--}}
                                    {{--</a>--}}
                                {{----}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<input type="hidden" value="{{$info->ico}}" id="img_url" />--}}
                        {{--<br>--}}
                        {{--<div id="fileList-photo" class="uploader-list">--}}
                                            {{--</div>--}}

                        {{--<div id="filePicker">选择图片</div>--}}
                        {{--<input id='ico' name='ico' type='hidden' value='{{$info->ico}}'/>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>   --}}
            

            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">是否可见:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="radio" name='status' @if($info->status==1) checked @endif  value='1'>可见
                    <input type="radio" name='status' @if($info->status==2) checked @endif value='2'>不可见
                </div>
            </div>

            {{--<div class="form-group col-md-12">--}}
                {{--<label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">排序:--}}
                    {{--<span class=""></span>--}}
                {{--</label>--}}
                {{--<div class="col-md-8 col-sm-8 col-xs-8" style="">--}}
                    {{--<input type="text" id="" name="order_by" class="form-control col-md-3 col-xs-12" value="{{$info->order_by}}">--}}
                {{--</div>--}}
            {{--</div>--}}

            <label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                <input type='submit' id="" class="btn btn-sm btn-success" style="float: right;"  value="提交">
            </label>
                
            <input type='hidden' name='id' id='' value="{{$info->id}}">
        </form>
    </div>
</div>

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
    //  var copy_content = $("#cp_url").val();
    //  copy_clip(copy_content);
    // });





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
    $("#ico").val(response.data);
    $("#img_url").val(response.data);
    $( '#'+file.id ).addClass('upload-state-done');
});







</script>    
@endsection
