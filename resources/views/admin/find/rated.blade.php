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
				<h3>&nbsp;&nbsp;评价红娘</h3>
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
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">类型:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="all">--全部--</option>
                                    <option value="1">--完胜--</option>
                                    <option value="2">--打赏--</option>
                                </select>
                            </div>
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">uid:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="uid"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6000021">
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

                            <div class="col-md-1">
                                <a  class="btn btn-success" id="search">查询</a>
                            </div>
                        </div>

                    </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action"
							style="text-align: center;">
							<thead>
								<tr class="headings">
                                    <th class="column-title" style="text-align: center;">找对象uid(昵称)</th>
									<th class="column-title" style="text-align: center;">红娘uid(昵称)</th>
                                    <th class="column-title" style="text-align: center;">类型</th>
                                    <th class="column-title" style="text-align: center;">评论内容</th>
                                    <th class="column-title" style="text-align: center;">回复内容</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: center;">操作</th>
								</tr>
							</thead>
							<tbody id ='data_list'>


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
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class=" " style="vertical-align:middle;"><a href="/admin/user_resource/<%=data[i].fuid%>"><%=data[i].fuid%>(<%=data[i].f_nickname%>)</a></td>
            <td class=" " style="vertical-align:middle;"><a href="/admin/hinfo/<%=data[i].huid%>"><%=data[i].huid%>(<%=data[i].h_nickname%>)</a></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].type==1){%><font color="green">完胜</font><%}else{%><font color="BLUE">打赏</font><%}%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].content%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].reply%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].created_at%></td>
            <td class=" last" style="vertical-align:middle;">
                <a  class="btn btn-info btn-xs see_info"  val="<%=data[i].id%>"><i class="fa fa-list-ul"></i>查看图片 </a>
                {{--<a href="javascript:void(0)"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除 </a>--}}
            </td>
        </tr>
        <%}%>
</script>
    <script type="text/html" id="show_album">
        <div class="panel panel-default"  style="border-top: 1px solid #dddddd;margin-top: 10px;">
            <div class="panel-heading">
                相册
            </div>
            <table class="table table-data">
                <tbody>
                <tr>
                    <td>
                        <% for(var i=0;i<album.length;i++){%>
                        <div class="album" style="float: left;width: 200px;height: 200px;margin:5px;">
                            <div class="toolBar"><i class="fa fa-trash-o del_album del" val="<%=album[i].id%>"></i></div>
                            <a class="example-image-link" data-lightbox="example-set"  href="<%=album[i].img_url%>" rel="lightbox">
                                <img src="<%=album[i].img_url%>" width="200" height="200" layer-src="<%=album[i].img_url%>">
                            </a>
                        </div>
                        <% }%></td>
                </tr>
                </tbody>
            </table>
        </div>
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
                url:'/admin/rated_list',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.data}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            $(".see_info").on("click",function(e){
                var id =$(this).attr('val');
                layer.open({
                    title:"查看评价图片",
                    area: ['600px', '400px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: '<div id="show_info"></div>',
                    success:function(){
                        album(id);

                    }
                });
            });

        },album=function(id){
            $.ajax({
                url:'/admin/get_rate_info',
                dataType:"json",
                type:'post',
                data:{id:id},
                success:function(result) {
                    var tpl = $("#show_album").html();
                    $("#show_info").html(template(tpl,{album:result.data.album}));
                    do_info(id);
                }
            });
        },do_info=function(parm_id){
            $("div.album").hover(function(){
                $(this).find('.toolBar').show();
            },function(){
                $(this).find('.toolBar').hide();
            });
            $(".del_album").on("click",function(e){
                var id =$(this).attr('val');
                layer.confirm('您确定要删除该照片吗？', {
                    type:1,
                    btn: ['确定','取消'] //按钮
                }, function() {
                    $.ajax({
                        url: '/admin/get_rate_del',
                        dataType: "json",
                        type: 'post',
                        data: {id: id},
                        success: function (result) {
                            album(parm_id);
                            layer.closeAll('page');
                        }
                    });
                },function(){

                })
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
           _this.status=$("#status").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            fetch();
        });

        this.init();
    })
</script>
@endsection
