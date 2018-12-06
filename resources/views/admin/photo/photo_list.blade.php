@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <link href="/static/css/lightbox.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/lightbox.js"></script>
    <script type="text/javascript" src="/static/js/page.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
                <h3>&nbsp;&nbsp;相册/头像审核</h3>
                <br>
                <div class=""><!-- col-md-6 col-sm-6 col-xs-12 -->
                    <div class="btn-group" data-toggle="buttons">
                        <a class="btn <?php if($tab==2){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="2" >头像</a>
                        <a class="btn <?php if($tab==3){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="3" >视频认证</a>
                        <a class="btn <?php if($tab==4){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="4" >微信审核</a>
                        <a class="btn <?php if($tab==1){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="1" >相册</a>
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

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">UID:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;昵称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="nickname"  class="form-control col-md-1" style="border-radius:2px;" placeholder="李先生">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">状态:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="1">审核中</option>
                                    <option value="2">审核通过</option>
                                    <option value="3">审核不通过</option>
                                    <option value="">不限</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">&nbsp;&nbsp;创建时期:</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success" id="search">查询</button>
                            </div>
                        </div>



                    </form>
                        <div class="form-group pass_status">
                           <input type='checkbox' id="qx" style="width:30px;height:30px;">
                           <button type="button" class="btn btn-success status_on_off pass_status_2" val="2">审核通过</button>
                           <button type="button" class="btn btn-success status_on_off pass_status_3" val="3">审核不通过</button>
                        </div>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
                    <div class="panel panel-default"  style="border-top: 1px solid #dddddd;margin-top: 10px;">
                        <table class="table table-data">
                            <tbody>
                            <tr>
                                <td id="data_list">
                                </td>
                            </tr>
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
        <% for(var i=0;i<album.length;i++){%>
        <div class="album" style="float: left;width:150px;margin:5px;border:1px solid gray;">
            <!-- <div class="toolBar"><i class="fa fa-trash-o del_album del" val="<%=album[i].id%>"></i></div> -->
            <a class="example-image-link" data-lightbox="example-set"  href="<%=album[i].img_url%>" rel="lightbox">
                <?php if($tab==3){?>
                    <video controls="controls"  width="150" height="150">
                      <source src="<%=album[i].img_url%>" type="video/ogg" />
                      <source src="<%=album[i].img_url%>"   type="video/mp4" />
                    Your browser does not support the video tag.
                    </video>
                <?php }else{?>
                    <img src="<%=album[i].img_url%>" width="100%" height="150" layer-src="<%=album[i].img_url%>">
                <?php }?>
            </a>

            <div style="height:200px;overflow:hidden;">
                <br><a href="/admin/base_user?uid=<%=album[i].uid%>&type=<%=album[i].vest%>" target="_blank"><%=album[i].uid%>【<%=album[i].status_msg%>】</a>
                <br><%=album[i].nickname%>
                <br><%=album[i].time%>
                <br><%=album[i].introduce%>
            </div>
            <div class='t_box' style="height:80px;text-align:center;border:1px solid gray;">
               <input type='checkbox' class="box" value='<%=album[i].id%>' >
            </div>
        </div>
        <% }%>
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
        _this.tab=<?=$tab?>;
        _this.status=$('#status').val();
        console.log(_this);
        this.init=function(){
           fetch();
        },
        fetch=function(){
            var api;
            if(_this.tab==1)
                api = '/admin/photo_list_data';
            else if(_this.tab==2)
                api = '/admin/header_list_data';
            else if(_this.tab==3)
                api = '/admin/health_list_data';
            else if(_this.tab==4)
                api = '/admin/wx_list_data';
            $.ajax({
                url:api,
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{album:result.data.data}));
                   render(result.data._count,result.data._limit);

                }
            });
            $('.status_on_off').attr('disabled',false)
        },
        render=function(_count,_limit) {
            pageinit({
                page: {pageSize: _limit, currentPage: _this.page},
                _count: _count
            }, _this);
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


            $("div.album").hover(function () {
                $(this).find('.toolBar').show();
            }, function () {
                $(this).find('.toolBar').hide();
            });
            $(".show_page").on("click",function(e){
                _this.tab=$(this).attr('val');
               window.location.href='/admin/photo_list?tab='+_this.tab;

            });
            $(".del_album").on("click", function (e) {
                var id = $(this).attr('val');
                layer.confirm('您确定要删除该照片吗？', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.ajax({
                        url: '/admin/api/user_del_album',
                        dataType: "json",
                        type: 'post',
                        data: {id: id,type:_this.type},
                        success: function (result) {
                           if(result.error==0){
                               layer.msg('删除成功', {icon: 1, time: 1000});
                               fetch();
                           }else{
                               layer.msg(result.msg, {icon: 2, time: 1000});
                           }
                        }
                    });
                }, function () {

                })
            });
        };
        $("#search").on("click",function(e){
            _this.page=1;
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.status =$.trim($("#status").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            if(_this.status == 1 || _this.status==3){
                $(".pass_status_2").show();
            }else{
                $(".pass_status_2").hide();
            }
            if(_this.status == 1 || _this.status==2){
                $(".pass_status_3").show();
            }else{
                $(".pass_status_3").hide();
            }
            console.log(_this);
            fetch();
        });
        //审核
        $('.status_on_off').on("click",function(e){
            $(this).attr('disabled',true);
            var btn= $(this);
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
                $(this).attr('disabled',false);
                return false;
            }
            // alert('ids');
            console.log(ids);
            // return false;

            var api;
            if(_this.tab==1)
                api = '/admin/api/photo_status';
            else if(_this.tab==2)
                api = '/admin/api/header_status';
            else if(_this.tab==3)
                api = '/admin/api/health_status';
            else if(_this.tab==4)
                api = '/admin/api/wx_status';
            $.ajax({
                url:api+"?ids="+ids+'&status='+status,
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

            /*
            layer.confirm('确认提交', {
                btn: ['确定','取消'] //按钮
            }, function() {
                var api;
                if(_this.tab==1)
                    api = '/admin/api/photo_status';
                else if(_this.tab==2)
                    api = '/admin/api/header_status';
                else if(_this.tab==3)
                    api = '/admin/api/health_status';
                else if(_this.tab==4)
                    api = '/admin/api/wx_status';
                $.ajax({
                    url:api+"?ids="+ids+'&status='+status,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            layer.msg('提交成功', {icon: 6});
                            fetch();
                            //btn.attr('disabled',false);
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            },function(){

            });
            */

            return false;

        });
        this.init();
    })
</script>
@endsection
