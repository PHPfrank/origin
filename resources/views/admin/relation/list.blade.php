@extends('admin.master') @section('content')
<link href="/static/js/datetimepicker/css/datetimepicker.css"
	rel="stylesheet">
<script type="text/javascript"
	src="/static/js/datetimepicker/datetimepicker.js"></script>
<script type="text/javascript"
	src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
<script type="text/javascript" src="/static/js/page.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>牵线列表</h3>
				<br>
	            <div class="">
	                <div  class="btn-group" data-toggle="buttons">
	                    <a class="btn  <?php if($type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">红娘推荐牵线</a>
	                    <a class="btn <?php if($type==2){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="2">悬赏者请求牵线</a>
	                </div>
	            </div>
			</div>

		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<form class="form-horizontal form-label-left"
							style="text-align: left;" id="search">
							<div class="form-group">
								<label class=""
									style="text-align: left; padding-right: 1px; padding-left: 1px; padding-top: 8px; float: left;">资源编号:</label>
								<div class="col-md-1" style="width: 12%;">
									<input type="text" id="rid" class="form-control col-md-1"
										style="border-radius: 2px;" name="rid">
								</div>
								<label class="" for="last-name"
									style="text-align: left; padding-right: 1px; padding-left: 5px; padding-top: 8px; float: left;">找对象UID:</label>
								<div class="col-md-1" style="width: 12%;">
									<input type="text" id="fuid" name="fuid"
										class="form-control col-md-1" style="border-radius: 2px;"
										name="uid">
								</div>
								<label class="" for="first-name"
									style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">红娘UID:</label>
								<div class="col-md-1" style="width: 15%;">
									<input type="text" id="huid" class="form-control col-md-1"
										style="border-radius: 2px;" placeholder=""
										name="huid">
								</div>
								<label class=""
									style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">状态:</label>
								<div class="col-md-2" style="width: 12%;">
									<select class="select2_single form-control" tabindex="-1"
										id="sex" name="status" id="status">
										<option value="">请选择</option>
										<?php foreach ($lang as $k => $v) {?>
											<option value="<?php echo $k;?>"><?php echo $v;?></option>
										<?php }?>
									</select>
								</div>
								
							</div>
							<div class="form-group">
                                <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">创建时期:</label>
                                <div class="col-md-1" style="width:20%;">
                                    <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s',strtotime('-7day'))}}">
                                </div>

                                <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                                <div class="col-md-1" style="width:20%;">
                                    <input type="text" id="end_time" name="end_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s')}}">
                                </div>

                                <div class="col-md-3">
									<button type="button" class="btn btn-success" id="check">查询</button>
								</div>
                            </div>
						</form>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<p class="text-muted font-13 m-b-30"></p>
						<table id="datatable-fixed-header"
							class="table table-striped table-bordered"
							style="text-align: center;">
							<thead>
								<tr>
									<th class="col-md-1" style="text-align: center;">牵线编号</th>
									<?php if($type==0){?>
										<th class="col-md-1" style="text-align: center;">红娘</th>
										<th class="col-md-1" style="text-align: center;width:10%;">悬赏者</th>									
									<?php }else{?>
										<th class="col-md-1" style="text-align: center;width:10%;">悬赏者</th>
										<th class="col-md-1" style="text-align: center;">红娘</th>
									<?php } ?>
									
									<th class="col-md-1" style="text-align: center;">资源编号</th>
									<th class="col-md-1" style="text-align: center;">状态</th>
									<th class="col-md-2" style="text-align: center;">创建日期</th>
								</tr>
							</thead>
							<tbody id='data_list'>
							</tbody>
						</table>
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
        <tr>
			<td style="vertical-align: middle;"><a target="_blank" href="/admin/resource?rid=<%=data[i].rid%>"><%=data[i].id%></a></td>
			<?php if($type==0){?>
				<td style="vertical-align: middle;"><a target="_blank" href="/admin/user_detail?uid=<%=data[i].huid%>"><%=data[i].hnickname%></a></td>	
				<td style="vertical-align: middle;"><a target="_blank" href="/admin/user_resource?uid=<%=data[i].fuid%>"><%=data[i].fnickname%></a></td>		
			<?php }else{?>
				<td style="vertical-align: middle;"><a target="_blank" href="/admin/user_resource?uid=<%=data[i].fuid%>"><%=data[i].fnickname%></a></td>
				<td style="vertical-align: middle;"><a target="_blank" href="/admin/user_detail?uid=<%=data[i].huid%>"><%=data[i].hnickname%></a></td>
			<?php } ?>


			
			<td style="vertical-align: middle;"><a target="_blank"  href="/admin/resource?rid=<%=data[i].rid%>"><%=data[i].rid%></a></td>
			<td style="vertical-align: middle;">
			<%if(data[i].status_desc == "申请状态") {%>
			<font color='##f0ad4e'>
			<% } else if(data[i].status_desc == "聊天状态") {%>
			<font color='green'>
			<% } else if(data[i].status_desc == "拒绝状态") {%>
			<font color='red'>
			<% } else if(data[i].status_desc == "完成状态") {%>
			<font color='blue'>
			<% } %>
			<%=data[i].status_desc%>
			</font>
			</td>
			<td style="vertical-align: middle;"><%=data[i].created_at%></td>
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
	var _this = {};
	_this.page=1;
	_this.vest=<?php echo $type; ?>;

	fetch = _this.requestData = function(page){
        var param = $("#search").serialize();
        console.log(param);
        $.post({
 	        url:'/admin/relationData?page='+_this.page+'&type='+_this.vest,
 	        data:param,
 	        success:function(result){
 		        console.log(_this);
 	            var tpl = $("#item_list").html();
 	            $("#data_list").html(template(tpl,{data:result.data.data}));
 	           	pageinit({
 	                page:{pageSize:10,currentPage:_this.page},
 	                _count:result.data.count
 	            },_this);
	            
//  	            laypage({
//  	              cont: 'page',
//  	              pages: result.data.pages, //通过后台拿到的总页数
//  	              curr: page || 1, //当前页
//  	              jump: function(obj, first){ //触发分页后的回调
//  	 	              if(!first) {
//  	                  	_this.requestData(obj.curr);
//  	                  	scrollTo(0,0);
//  	 	              }
//  	              }
//  	            });
 	        }
     	});
    };

   	_this.requestData();
   	$("#check").click(function(){
   	   	_this.page =1;
   		_this.requestData();
   		}
   	);

   	$(".show_page").on("click",function(e){
        _this.vest=$(this).attr('val');
       window.location.href='/admin/relationManage?type='+_this.vest;

    });
});
</script>
@endsection
