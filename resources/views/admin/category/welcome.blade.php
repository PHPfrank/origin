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
                <h3>&nbsp;&nbsp;分类管理</h3>
                <br>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="btn-group">
                        <?php if($type==1){?>
                        <div class="col-md-1">
                            <a  class="btn btn-edit btn-info" id="create_good">添加马甲分类</a>
                        </div>
                        <?php }?>
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
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="font-size: 14px;">
							<thead>
								<tr class="headings">
                                    <th class="column-title">id</th>
                                    <th class="column-title">标题</th>
									<th class="column-title" style="width: 120px; height: 100px;">分类图片</th>
									<th class="column-title">权重</th>
									<th class="column-title">状态</th>
									<th class="column-title" style="text-align: center;width:10%;">操作</th>
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
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class=" "><%=data[i].id%></td>
            <td class=" "><%=data[i].name%></td>
            <td class=" "><img src="<%=data[i].image_url%>" width="120px" height="100px"></td>
            <td class=" "><%=data[i].weight%></td>
            <td class=" "><%if(data[i].status==1){%>正常<%}else if(data[i].status==0){%>关闭<% }%></td>
            <td class=" last" style="vertical-align:center;">
                <a href="/admin/cate_detail?id=<%=data[i].id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 详情 </a>
            </td>
        </tr>
        <%}%>
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
        _this.type='<?=$type?>';
        //console.log(_this);
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/get_cate_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.data,vest:result.data.vest}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);

        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                closeBtn : 0,
                content:"<font color='red' class='alert alert-danger' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['238px', '50px']
            });
        };
        $("#search").on("click",function(e){
            _this.page=1;
            _this.status=$("#status").val();
            _this.close=$("#close").val();
            _this.sex=$("#sex").val();
            _this.user_id =$.trim($("#user_id").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.phone =$.trim($("#phone").val());
            _this.start_time = $.trim($("#start_time").val());
            _this.end_time = $.trim($("#end_time").val());
            _this.active_start_time = $.trim($("#active_start_time").val());
            _this.active_end_time = $.trim($("#active_end_time").val());
            _this.header_url = $.trim($("#header_url").val());
            //console.log(_this);
            fetch();
        });
        $(".show_page").on("click",function(e){
            _this.type=$(this).attr('val');
           window.location.href='/admin/base_good?type='+_this.type;

        });
        $("#create_good").on("click",function(e){
            window.location.href='/admin/create_good';
        });

        this.init();
    })
</script>
@endsection
