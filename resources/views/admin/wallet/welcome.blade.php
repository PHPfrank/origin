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
				<h3>&nbsp;&nbsp;用户钱包</h3>
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
                            <!-- <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">&nbsp;&nbsp;创建时期:</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:13%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>
 -->
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
                                    <th class="column-title" style="text-align: center;">UID</th>
									<th class="column-title" style="text-align: center;">昵称</th>
                                    <th class="column-title" style="text-align: center;">金币</th>
                                    {{--<th class="column-title" style="text-align: center;">冻结收益</th>--}}
                                    {{--<th class="column-title" style="text-align: center;">累计收益</th>--}}
                                    {{--<th class="column-title" style="text-align: center;">累计订阅消费</th>--}}
                                    {{--<th class="column-title" style="text-align: center;">累计提现</th>--}}
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
            <td class=" " style="vertical-align:middle;"><a target="_blank" href="/admin/base_user?uid=<%=data[i].uid%>"><%=data[i].uid%></a></td>
            <td class=" " style="vertical-align:middle;"><a target="_blank" href="/admin/base_user?uid=<%=data[i].uid%>"><%=data[i].nickname%></a></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].gold%></span></td>
<!--            <td class=" " style="vertical-align:middle;"><%=data[i].income_freeze%></span></td>-->
<!--            <td class=" " style="vertical-align:middle;"><%=data[i].income_total%></span></td>-->
<!--            <td class=" " style="vertical-align:middle;"><%=data[i].rss_money_total%></td>-->
<!--            <td class=" " style="vertical-align:middle;"><%=data[i].withdraw_total%></td>-->
            <td class=" last" style="vertical-align:middle;">
                <a href="userLog?uid=<%=data[i].uid%>" target='_blank'  class="btn btn-info btn-sm >
                    <i class="fa fa-list-ul"></i>明细
                </a>
                <!--<a href="javascript:void(0)" id="<%=data[i].uid%>" class="btn btn-info btn-sm btn_detail" >
                        <i class="fa fa-list-ul"></i>
                        收益详情
                </a>-->
                {{--<a href="javascript:void(0)"  class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> 删除 </a>--}}
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
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/wallet_data',
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

            $(".btn_detail").on("click",function(e) {
            	layer.open({
        			type: 2,
        			title:"收益详情",
        			area: ['600px', '400px'],
        			fix: false, //不固定
        			maxmin: true,
        			content: '/admin/user_wallet?uid='+this.id
        		});
                
                
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.sex=$("#sex").val();
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
