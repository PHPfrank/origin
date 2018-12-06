@extends('admin.master')
@section('content')
<script type="text/javascript" src="/static/js/page.js"></script>
<script type="text/javascript" src="/static/js/lightbox.js"></script>
<link href="/static/css/lightbox.css" rel="stylesheet">

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>举报管理</h3>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		
		<!-- 头部 -->
		<div class="x_title">
        	<form class="form-horizontal form-label-left" style="text-align: left;">
            	<div class="form-group">
                   <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">用户ID:</label>
                   <div class="col-md-1" style="width:15%;">
                        <input type="text" id="user_id"  class="form-control col-md-1" style="border-radius:2px;" placeholder="1000000">
                   </div>
                   <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">状态:</label>
                   <div class="col-md-1"  style="width:15%;">
                   		<select class="select2_single form-control" id="status" tabindex="-1">
	                        <option value="all">不限</option>
                            <option value="0">待处理</option>
                            <option value="1">已处理</option>
                            <option value="2">已忽略</option>
                        </select>
                   </div>
                   <div class="col-md-1">
                   		<a  class="btn btn-success" id="search">查询</a>
                   </div>
                </div>
            </form>
            <div class="clearfix"></div>
        </div>
        
        <!-- 内容部 -->
        <div class="x_content">
        	<div class="table-responsive">
				<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
					<thead>
								<tr class="headings">
									<th class="column-title" style="text-align: center;">举报人ID</th>
									<th class="column-title" style="text-align: center;">有赞订单ID</th>
									<th class="column-title" style="text-align: center;">举报内容</th>
									<th class="column-title" style="text-align: center;">图片</th>
									<th class="column-title" style="text-align: center;">状态</th>
                                    <th class="column-title" style="text-align: center;">举报时间</th>
                                    <th class="column-title" style="text-align: center;">操作</th>
								</tr>
					</thead>
					<tbody id ='data_list'></tbody>
				</table>		
			</div>
            <div id="pagination"></div>    
        </div>
        
	</div>
	
</div>

<script type="text/html" id="data_tpl">
	<%for(var i = 0; i < data.length; i++) {%>
		<tr>
			<td style="vertical-align: middle;"><%=data[i].user_id%></td>
			<td style="vertical-align: middle;"><%=data[i].tid%></td>
			<td style="vertical-align: middle;"><%=data[i].content%></td>
			<td style="vertical-align: middle;">
                <%if(data[i].imgs){%>
                    <%for( var j=0;j<data[i].imgs.length;j++){%>
                        <a class="example-image-link" data-lightbox="example-set"  href="<%=data[i].imgs[j]%>" rel="lightbox"><img width="80" height="100" src="<%=data[i].imgs[j]%>" ></a>
                    <%}%>
                <%}%>
            </td>
			<td style="vertical-align: middle;">
				<%if(data[i].status==0){%>
				<font color="red">未处理</font>
				<%}else if(data[i].status==1){%>
				<font color="green">已处理</font>
				<%}else{%>
				<font color="green">已忽略</font>
				<%}%>
			</td>
			<td style="vertical-align: middle;"><%=data[i].created_at%></td>
			<td style="vertical-align: middle;text-align:middle;">
				<%if(data[i].status==0){%>
				<button type="submit" class="btn btn-info btn-sm fa fa-reply btn_oper" value="<%=data[i].id%>"> 处理</button>
				<%}else{%>
				<button type="submit" class="btn btn-success btn-sm fa fa-list-ul btn_oper" value="<%=data[i].id%>"> 查看</button>
				<%}%>
			</td>
		</tr>
	<%}%>
</script>

<script type="text/html" id="reply_tpl">
	<div class="panel panel-default" style="border-top: 1px solid #dddddd;margin-top: 10px;">
       <table class="table table-data">
          <tbody>
          	  <tr><td style="text-align:right;width:30%;">举报人ID：</td><td><%=data.user_id%></td></tr>
			  <tr><td style="text-align:right;width:30%;">当前状态：</td>
			  	<td>
					<%if(data.status==0) {%>
					<font color="red">未处理</font>
					<%}else{%>
					<font color="green">已处理</font>
					<%}%>
			  	</td>
			  </tr>
          	  <%if(data.status == 0){%>
			  <tr>
				<td style="text-align:right;width:30%;padding-top:6%;">处理留言：</td>
				<td>
					<textarea id="deal_content" style="width:80%" onblur="if(this.value == ''){this.style.color = '#ACA899'; this.value = '在此处填写留言(可以不填写)'; }" onfocus="if(this.value == '在此处填写留言(可以不填写)'){this.value =''; this.style.color = '#000000'; }" style="color:#ACA899;">

					</textarea>
				</td>
			  </tr>
			  <tr>
				<td style="width:30%;"></td>
				<td><a class="btn btn-success" id="enter">确认</a><a class="btn btn-primary" id="canel" style="margin-left:20px;">取消</a></td>          
			  </tr>
			  <%}else{%>
			  <tr>
				<td style="text-align:right;width:30%;padding-top:6%;">处理留言：</td>
				<td><textarea id="deal_content" style="width:80%" disabled="disabled"><%=data.deal_content%></textarea></td>
			  </tr>
			  <% } %>
		  </tbody>
       </table>
    </div>
</script>


<script type="text/javascript">
$(document).ready(function(){
	var _this = {};
	var _param = {};
	//获取初始化数据
	_this.init = function() {
		$.ajax({
			url:'/admin/reportinfo_data',
			dataType:"json",
			type:'post',
			data:_param,
			success:function(result){
				$("#data_list").html(template($("#data_tpl").html(),{data:result.data.data}));
				pageinit({page:{pageSize:10,currentPage:result.data.page},_count:result.data.count},_param);
				_this.render();
			}
		});
	};

	//加载完主要数据，渲染其他事件
	_this.render = function() {
		$('.fimg').click(function(){
			var src = $(this).attr('src');
			var myWindow = window.open('');
			myWindow.document.write("<img src='"+src+"' >");
		});
		//处理举报操作
		$(".btn_oper").on("click",function(e){
	         var id =$(this).attr('value');
	         $.ajax({
		        url:'/admin/reportinfo_detail',
		        dataType:"json",
		        type:'get',
		        data:{id:id},
		        success:function(result){
			        console.log(result);
		        	var tpl = $("#reply_tpl").html();
		        	var html = template(tpl,{data:result.data});
		        	layer.open({
		        		 id:'feed_back_dialog',
	                     title:"回复举报",
	                     area: ['600px', '500px'],
	                     fix: false, //不固定
						 content: html,
	                     btn:false,
	                     success:function(){
		                     $("#canel").on("click",function(){
	                             parent.layer.closeAll();
		                     });
		                     $("#enter").on("click",function(){
			                     var param = {};
			                     param.id = result.data.id;
			                     param.deal_content = $("#deal_content").val();
			                     $.ajax({
				                     url:'/admin/reportinfo_oper',
				                     dataType:"json",
				                     type:"post",
				                     data:param,
				                     success:function(ret){
					                     parent.layer.closeAll();
					                     _this.init();
					                 }
				                 });
			                 });
		                 }
			        });
				}
		     });
	    });
	};
	
	//查询操作
	$("#search").on("click",function(e){
		_this.page=1;
		_param.user_id=$("#user_id").val();
		_param.status =$.trim($("#status").val());
        _this.init();
    });


	//做分页操作
	fetch = _this.init;
	//初始化操作
	_this.init();
	
});
</script>
@endsection