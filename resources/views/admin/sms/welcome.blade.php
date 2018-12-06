@extends('admin.master') 
@section('content')
    <script type="text/javascript" src="/static/js/page.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>&nbsp;&nbsp;验证码管理</h3>
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
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">手机号:</label>
                            <div class="col-md-1" style="width:20%;">
                                <input type="text" id="phone"  class="form-control col-md-1" style="border-radius:2px;" placeholder="13345625049">
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
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
									<th class="column-title" style="text-align: center;">手机</th>
                                    <th class="column-title" style="text-align: center;">验证码</th>
                                    <th class="column-title" style="text-align: center;">请求次数</th>
									<th class="column-title" style="text-align: center;">有效时长</th>
                                    <th class="column-title" style="text-align: center;">生成时间</th>
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
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td style="vertical-align: middle;" class=" "><%=data[i].phone%></td>
            <td style="vertical-align: middle;" class=" "><%=data[i].code%></td>
            <td style="vertical-align: middle;" class=" "><%=data[i].times%></td>
            <td style="vertical-align: middle;" class=" "><%if(data[i].expire == -1) {%>永久 <%} else {%><%=data[i].expire%>秒<% }%></td>
            <td style="vertical-align: middle;" class=" "><%=data[i].created_at%></td>
            <td style="vertical-align: middle;" class=" last">
                <a class="btn btn-remove btn-danger btn-sm" title="失效" val="<%=data[i].id%>"><i class="fa fa-lock"></i> 失效 </a>
            </td>
        </tr>
        <%}%>
</script>
<script type="text/javascript">
	$(function(){
        var _this={};
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/sms_list',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.sms}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            $(".btn-remove").on("click",function(e){
                var id =$(this).attr('val');
                $.ajax({
                    url:'/admin/api/sms_del',
                    dataType:"json",
                    type:'get',
                    data:{id:id},
                    success:function(result){
                       if(result.error==0){
                           layer.msg('操作成功',{icon:1,time:1000});
                           fetch();
                       }else{
                           layer.msg(result.msg, {icon: 2,time: 1000 });
                       }
                    }
                });
            });
        }
        $("#search").on("click",function(e){
        	_this.page=1;
            _this.phone= $.trim($("#phone").val());
            fetch();
        });

        this.init();
    })
</script>
@endsection
