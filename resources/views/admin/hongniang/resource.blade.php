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
                    <h3>资源列表</h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">


                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="btn-group" data-toggle="buttons">
                        <a class="btn <?php if($vest == 0) {?>btn-primary<?php } else {?>btn-default<?php }?> show_page"
                           val="0">资源列表</a>
                        <a class="btn <?php if($vest == 1) {?>btn-primary<?php } else {?>btn-default<?php }?> show_page"
                           val="1">马甲号资源</a>
                    </div>
                    <div class="x_panel">

					<div class="x_title">
						<form class="form-horizontal form-label-left" style="text-align: left;" id="search">
							<input type="hidden" value="<?php echo $vest;?>" name="vest" id="vest">
							<div class="form-group">
								<label class=""
									style="text-align: left; padding-right: 1px; padding-left: 1px; padding-top: 8px; float: left;">资源编号:</label>
								<div class="col-md-1" style="width: 12%;">
									<input type="text" id="rid" class="form-control col-md-1" style="border-radius: 2px;" name="rid">
								</div>
								<label class="" for="last-name"
									style="text-align: left; padding-right: 1px; padding-left: 5px; padding-top: 8px; float: left;">创建者UID:</label>
								<div class="col-md-1" style="width: 12%;">
									<input type="text" id="uid" name="uid" class="form-control col-md-1" style="border-radius: 2px;" name="uid" value="<?php if(isset($_REQUEST['uid'])) {echo $_REQUEST['uid']; }?>">
								</div>
								
								<label class=""
									style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">性别:</label>
								<div class="col-md-2" style="width: 12%;">
									<select class="select2_single form-control" tabindex="-1" id="sex" name="sex" id="sex">
										<option value="">请选择</option>
										<option value="1">男</option>
										<option value="2">女</option>
									</select>
								</div>
								<!-- <label class="" for="first-name"
									style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">居住地:</label>
								<div class="col-md-1" style="width: 15%;">
									<input type="text" id="liveplace" class="form-control col-md-1" style="border-radius: 2px;" placeholder="浙江-杭州" name="liveplace">
								</div> -->
								<label class="" for="first-name"
									style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">工作地:</label>
								<div class="col-md-1" style="width: 15%;">
									<input type="text" id="workplace" name="workplace" class="form-control col-md-1" style="border-radius: 2px;" placeholder="浙江-杭州">
								</div>
							</div>

                                <div class="form-group">
                                    <label class="" for="first-name"
                                           style="text-align: left; padding-right: 1px; padding-left: 1px; padding-top: 8px; float: left;">身高范围:</label>
                                    <div class="col-md-1" style="width: 12%;">
                                        <input type="text" id="high" name="high" class="form-control col-md-1"
                                               style="border-radius: 2px;" placeholder="170-190" name="high">
                                    </div>
                                    <label class="" for="first-name"
                                           style="text-align: left; padding-right: 1px; padding-left: 1px; padding-top: 8px; float: left;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;年龄范围:</label>
                                    <div class="col-md-1" style="width: 12%;">
                                        <input type="text" id="age" name="age" class="form-control col-md-1"
                                               style="border-radius: 2px;" placeholder="18-25">
                                    </div>

                    								<label class="" for="first-name"
                    									style="text-align: left; padding-right: 1px; padding-left: 1px; padding-top: 8px; float: left;">昵称:</label>
                    								<div class="col-md-1" style="width: 12%;">
                    									<input type="text" id="nickname" class="form-control col-md-1" style="border-radius: 2px;" value="<?php if(isset($_REQUEST['nickname'])) {echo $_REQUEST['nickname']; }?>" placeholder="王小二" name="nickname">
                    								</div>

                                    <label class="" for="first-name"
                                           style="text-align: left; padding-right: 1px; padding-left: 2px; padding-top: 8px; float: left;">排序规则:</label>
                                    <div class="col-md-2" style="width: 12%;">
                                        <select class="select2_single form-control" tabindex="-1" id="order"
                                                name="order">
                                            <option value="">请选择</option>
                                            <option value="1">创建时间</option>
                                            <option value="2">修改时间</option>
                                            <option value="3">权重值</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">创建时期:</label>
                                    <div class="col-md-1" style="width:18%;">
                                        <input type="text" id="start_time" name="start_time" class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="{{date('Y-m-d H:i:s',strtotime('-7day'))}}">
                                    </div>

                                    <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                                    <div class="col-md-1" style="width:18%;">
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
                            <table id="datatable-fixed-header" class="table table-striped table-bordered"
                                   style="text-align: center;">
                                <input type="hidden" id="pagess" value="1">
                                <thead>
                                <tr>
                                    <th class="column-title" style="text-align: center;">资源ID</th>
                                    <th class="column-title" style="text-align: center;">UID</th>
                                    <th class="column-title" style="text-align: center;">昵称</th>
                                    <th class="column-title" style="text-align: center;">形象照</th>
                                    <th class="column-title" style="text-align: center;">性别</th>
                                    <th class="column-title" style="text-align: center;">身高</th>
                                    <th class="column-title" style="text-align: center;">点赞数</th>
                                    <th class="column-title" style="text-align: center;">权重值</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
                                    <th class="column-title" style="text-align: center;">创建日期</th>
                                    <th class="column-title" style="text-align: center;">操作</th>
                                </tr>
                                </thead>
                                <tbody id='data_list'>
                                </tbody>
                            </table>
                            <!-- <div id="page" data-page="5" class="ui page" class="col-md-12" style="float:right;"></div> -->
                        </div>
                        <div id="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr>
            <td style="vertical-align: middle;"><%=data[i].rid%></td>
			<td style="vertical-align: middle;"><%=data[i].uid%></td>
			<td style="vertical-align: middle;"><%=data[i].nickname%></td>
			<td><img src="<%=data[i].header_url%>" width="50px" height="50px"></td>
			<td class=" " style="vertical-align:middle;"><%if(data[i].sex==1){%>男<%}else if (data[i].sex == 2){%>女<%} else {%>未知<% } %></td>
			<td style="vertical-align: middle;"><%=data[i].high%></td>
			<td style="vertical-align: middle;"><%=data[i].like_num%></td>
			<td style="vertical-align: middle;"><%=data[i].weights%></td>
			<td class=" " style="vertical-align:middle;"><%if(data[i].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
			<td style="vertical-align: middle;"><%=data[i].created_at%></td>
			<td style="vertical-align: middle;text-align:center;">
				<a href="javascript:void(0)" onClick="recommend(<%=data[i].rid%>);" class="btn btn-success btn-sm" id="recommend_oper"><i class="fa fa-sign-in"></i> 推荐 </a>
                <a href="/admin/resource?rid=<%=data[i].rid%>" class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 详情 </a>
                <%if(data[i].status==0){%><a class="btn btn-danger btn-sm item_close"  val="<%=data[i].rid%>" ><i class="fa fa-lock" title="禁用" ></i>禁用</a><%}else{%><a class="btn btn-info btn-sm item_open" val="<%=data[i].rid%>"><i class="fa fa-unlock" title="启用"></i> 启用</a><%}%>
			</td>
		</tr>
   <%}%>
</script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        // minView: "month", //选择日期后，不会再跳转去选择时分秒
        language:  'zh-CN',
        format: 'yyyy-mm-dd hh:ii:ss',
        todayBtn:  1,
        autoclose: 1
    });
    var _this = {};
    _this.page=1;
    // _this.start_time =$.trim($("#start_time").val());
    // _this.end_time =$.trim($("#end_time").val());
    console.log(_this);
    var fetch = _this.requestData = function(){
        var param = $("#search").serialize();
        			
        $.post({
 	        url:'/admin/resourceData?page='+_this.page,
 	        data:param,
 	        success:function(result){
 	            var tpl = $("#item_list").html();
 	            $("#data_list").html(template(tpl,{data:result.data.data}));
 	           pageinit({
 	                page:{pageSize:10,currentPage:_this.page},
 	                _count:result.data.count
 	            },_this);
	          	  
			$(".item_close").on("click",function(e){

                var uid =$(this).attr('val');
                $.ajax({
                    url:'/admin/statusResource',
                    dataType:"json",
                    type:'get',
                    data:{status:-1,rid:uid},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            $(".item_open").on("click",function(e){
                var uid =$(this).attr('val');
                $.ajax({
                    url:'/admin/statusResource',
                    dataType:"json",
                    type:'get',
                    data:{status:0,rid:uid},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
 	        }
     	});
    }
   	_this.requestData();
   	$("#check").click(_this.requestData);
   	$("#recommend").click(_this.recommend);

    $(".show_page").on("click",function(e){

        $("#vest").val($(this).attr('val'));
       window.location.href='/admin/hresource?vest='+$("#vest").val();

    });



 //开启
 function open(rid)
 {
 console.log("sole")
       	var url = "/admin/status_resource?rid="+rid+"&status=1";
       	$.ajax({url:url,success:function(data,status,xhr){
       		if(data.error == 0) {
       			layer.msg('修改成功', {icon: 6});
       			layer.close(index);
       			$(_this.requestData($("#pagess").val()));
       		} else {
       			layer.msg(data.info, {icon: 6});
       		}
       	 }});
 }
  //禁用
 function close(rid)
 {
 console.log("sole")
       	var url = "/admin/status_resource?rid="+rid+"&status=-1";
       	$.ajax({url:url,success:function(data,status,xhr){
       		if(data.error == 0) {
       			layer.msg('修改成功', {icon: 6});
       			layer.close(index);
       			$(_this.requestData($("#pagess").val()));
       		} else {
       			layer.msg(data.info, {icon: 6});
       		}
       	 }});
 }

 //推荐用户
 function recommend(rid)
 {
    	layer.prompt({
     	  title: '推荐资源',
     	  value:'请输入推荐权重数值（推荐值范围1-10）',
     	  formType: 2 //prompt风格，支持0-2
     	}, function(value, index, elem){
       	var url = "/admin/recommend_resource?rid="+rid+"&weights="+value;
       	$.ajax({url:url,success:function(data,status,xhr){
       		if(data.error == 0) {
       			layer.msg('添加成功', {icon: 6});
       			layer.close(index);
       			$(_this.requestData($("#pagess").val()));
       		} else {
       			layer.msg(data.info, {icon: 6});
       		}
       	 }});
       });
 }

 function addVest()
 {
 	layer.prompt({
 	  title: '添加马甲号',
 	  value:'请输入生成马甲号数量',
 	  formType: 2 //prompt风格，支持0-2
 	}, function(value, index, elem){
//  			var url = "/Admin/User/vest/num/"+value+'.html';
//  			$.ajax({url:url,success:function(data){
//  				if(data.status == 0) {
//  					layer.msg(data.info, {icon: 6});
//  				} else {
//  					layer.msg('成功添加'+data.num+'个马甲号', {icon: 6});
//  					layer.close(index);
//  					window.location.reload();
//  				}
//  	  		  }});
 	});
 }

 
</script>
@endsection
