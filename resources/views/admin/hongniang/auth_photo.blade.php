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
                <h3>&nbsp;&nbsp;审核图片</h3>
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

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">uid:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="红娘uid">
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">rid:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="rid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="资源id">
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
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success" id="search">查询</button>
                            </div>
                        </div>

                    </form>
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
        <div class="album" style="float: left;width: 24%;height: 280px;margin:5px;">
            <div class="toolBar"><i class="fa fa-trash-o del_album del" val="<%=album[i].id%>"></i></div>
            <a class="example-image-link" data-lightbox="example-set"  href="<%=album[i].img_url%>" rel="lightbox">
                <img src="<%=album[i].img_url%>" width="100%" height="220" layer-src="<%=album[i].img_url%>">
                <br>红娘:[<%=album[i].h_uid%>]<%=album[i].h_nickname%>(<%=album[i].relation%>)
                <br>资源[<%=album[i].rid%>]<%=album[i].b_nickname%>(<%=album[i].created_at%>)
            </a>
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
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/get_hongniang_photo',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{album:result.data.data}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count) {
            pageinit({
                page: {pageSize:12, currentPage: _this.page},
                _count: _count
            }, _this);
            $("div.album").hover(function () {
                $(this).find('.toolBar').show();
            }, function () {
                $(this).find('.toolBar').hide();
            });
            $(".del_album").on("click", function (e) {
                var id = $(this).attr('val');
                layer.confirm('您确定要删除该照片吗？', {
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.ajax({
                        url: '/admin/api/del_bridgeimg',
                        dataType: "json",
                        type: 'post',
                        data: {id: id},
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
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            _this.rid =$.trim($("#rid").val());
            fetch();
        });
        this.init();
    })
</script>
@endsection
