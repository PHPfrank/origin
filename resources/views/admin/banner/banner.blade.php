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
                <h3>&nbsp;&nbsp;banner管理</h3>
                <br>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div  class="btn-group" data-toggle="buttons">
                        <a class="btn <?php if($ad_type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">头部大banner</a>
                        <a class="btn <?php if($ad_type==1){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="1">滑动banner</a>
                        <a class="btn <?php if($ad_type==2){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="2">会员大放送</a>
                        <a class="btn <?php if($ad_type==3){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="3">超值大放送</a>
                    </div>
                    <div class="btn-group">
                        <div class="col-md-1">
                            <a  class="btn btn-edit btn-info" id="create_banner">添加banner</a>
                        </div>
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
                    <div class="clearfix"></div>
                </div>

                {{--<form class="form-horizontal form-label-left" style="text-align: left;">--}}
                      {{--<div class="form-group">--}}

                      {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">ID:</label>--}}
                      {{--<div class="col-md-1" style="width:10%;">--}}
                      {{--<input type="text" id="id"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">--}}
                      {{--</div>--}}

                       {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">标题:</label>--}}
                       {{--<div class="col-md-1" style="width:10%;">--}}
                       {{--<input type="text" id="title"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">--}}
                       {{--</div>--}}
                        {{--<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">时间:</label>--}}
                        {{--<div class="col-md-1" style="width:18%;">--}}
                        {{--<input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s',strtotime('-7day'))}}">--}}
                        {{--</div>--}}
                        {{--<label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>--}}
                        {{--<div class="col-md-1" style="width:18%;">--}}
                        {{--<input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s')}}">--}}
                        {{--</div>--}}
                          {{--<div class="col-md-1" style="width:6%;">--}}
                              {{--<button type="button" class="btn btn-success" id="search">查询</button>--}}
                          {{--</div>--}}
                          {{--<div class="col-md-1" style="width:6%;">--}}
                              {{--<button type="button" class="btn btn-success" id="add_banner">添加banner</button>--}}
                          {{--</div>--}}
                   {{--</div>--}}

                {{--</form>--}}


				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
								    <th class="column-title" style="text-align: center;">ID</th>
                                    <th class="column-title" style="text-align: center;">banner类型</th>
                                    <th class="column-title" style="text-align: center;">类型</th>
                                    <th class="column-title" style="text-align: center;">图片</th>
                                    <th class="column-title" style="text-align: center;">跳转链接</th>
                                    <th class="column-title" style="text-align: center;">排序</th>
                                    {{--<th class="column-title" style="text-align: center;">性别</th>--}}
                                    <th class="column-title" style="text-align: center;">开关</th>
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
            <td class=" " style="vertical-align:middle;"><%=data[i].id%></td>
            <td class=" " style="vertical-align:middle;"><%if(data[i].ad_type==1){%>banner图<%}else if(data[i].ad_type==2){%>会员大放送图片<% }else if(data[i].ad_type==3){%>超值大放送图片<% }%></td>
			<td class=" " style="vertical-align:middle;"><%if(data[i].type==0){%>跳转h5<%}else if(data[i].type==1){%>app内跳转<% }%></td>
			<td class=" " style="vertical-align:middle;"><img src="<%=data[i].img%>" width="150px" height="100px"></td>
			<td class=" " style="vertical-align:middle;"><%=data[i].url%></td>
			<td class=" " style="vertical-align:middle;"><%=data[i].sort%></td>
<!--			<td class=" " style="vertical-align:middle;"><%if(data[i].sex==1){%>男<%}else if(data[i].sex==2){%>女<% } else { %>男女共用<% } %></td>-->
			<td class=" " style="vertical-align:middle;"><%if(data[i].status==1){%>可见<%}else if(data[i].status==2){%>不可见<% }%></td>
			<td class=" last" style="vertical-align:middle;">
                <a href="/admin/banner_detail?id=<%=data[i].id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 编辑 </a>
                {{--<a href="javascript:void(0)"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>--}}
            </td>
        </tr>
        <%}%>
</script>
<script type="text/javascript">
	$(function(){
        $('.form_datetime').datetimepicker({
            // minView: "month", //选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            format: 'yyyy-mm-dd hh:ii:ss',
            todayBtn:  1,
            autoclose: 1
        });
        var _this={};
        _this.page=1;
        _this.ad_type='<?=$ad_type?>';
        console.log(_this);
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/get_banner_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
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

            // 添加banner
            $("#add_banner").on("click",function(){
                var url = "/admin/api/add_banner";
                $.ajax({url:url,async:false,success:function(data){
                    console.log(data);
                        if(data.error==0) {
                            layer.msg('添加成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg('添加失败', {icon: 6});
                        }
                    }
                });
                fetch();
            });
        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['238px', '50px']
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.id =$.trim($("#id").val());
            _this.title =$.trim($("#title").val());
            _this.start_time = $.trim($("#start_time").val());
            _this.end_time = $.trim($("#end_time").val());
            console.log(_this);
            fetch();
        });


        $(".show_page").on("click",function(e){
            _this.ad_type=$(this).attr('val');
           window.location.href='/admin/bannerManager?ad_type='+_this.ad_type;

        });

        $("#create_banner").on("click",function(e){
            window.location.href='/admin/create_banner?ad_type='+_this.ad_type;
        });

        this.init();
    })
</script>
@endsection
