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
                <h3>&nbsp;&nbsp;{{$title}}</h3>
                <br>
			</div>
			<div class="title_right">
				<div
					class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group"><a target="_blank" href="vip_good_detail" class="btn btn-edit btn-info" id="">添加</a></div>
				</div>
			</div>

		</div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
                                @foreach ($menu as $m)
                                    <th class="column-title" style="text-align: center;">{{ $m}}</th>
                                @endforeach
                                
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
            <td class=" "><%=data[i].id%></td>
            <td class=" "><%=data[i].title_1%></td>
            <td class=" "><%=data[i].title_2%></td>
            <td class=" "><%=data[i].real_price%></td>
            <td class=" "><%=data[i].orig_price%></td>
            <td class=" "><%=data[i].iap_product_price%></td>
            <td class=" "><%=data[i].day_msg%></td>
            <td class=" "><%=data[i].sale_banner_msg%></td>
            <td class=" "><%=data[i].is_vip_forever_msg%></td>
            <td class=" "><%=data[i].status_msg%></td>
            <td class=" "><%=data[i].order_by%></td>
            <td class=" ">
                <a href="/admin/vip_good_detail?id=<%=data[i].id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 编辑 </a>
            </td>
        </tr>
        <%}%>
</script>

<script type="text/javascript">
	$(function(){
        $('.form_datetime').datetimepicker({
            // minView: "month", //选择日期后，不会再跳转去选择时分秒
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            todayBtn:  1,
            autoclose: 1
        });
        var _this={};
        _this.uid=$("#uid").val();
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/vip_good_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.list}));
                    // console.log(template(tpl,{data:result.data.list}));
                    console.log(result.data.list);
                    render(result.data._count,result.data._limit);

                }
            });
        },
        render=function(_count,_limit){
            pageinit({
                page:{pageSize:_limit,currentPage:_this.page},
                _count:_count
            },_this);
        },
        alert_msg=function(msg){
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
            _this.start_time=$("#start_time").val();
            _this.end_time=$("#end_time").val();
            fetch();
        });

        this.init();
    })
</script>
@endsection
