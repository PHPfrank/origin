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
				<h3>&nbsp;&nbsp;订单管理</h3>
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
                        	<label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">订单号:</label>
                            <div class="col-md-1" style="width:21%;">
                                <input type="text" id="order_no"  class="form-control col-md-1" style="border-radius:2px;" placeholder="6500528233566000028">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">用户ID:</label>
                            <div class="col-md-1" style="width:21%;">
                                <input type="text" id="user_id"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">
                            </div>
                            
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">&nbsp;&nbsp;状态:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="status" tabindex="-1">
                                    <option value="1">已支付</option>
                                    <option value="0">未支付</option>
                                    <option value="-1">支付失败</option>
                                    <option value="all">全部</option>
                                </select>
                            </div>
                            <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;来源:</label>
                            <div class="col-md-2" style="width:10%;">
                                <select class="select2_single form-control" id="os" tabindex="-1">
                                    <option value="all">全部</option>
                                    <option value="ios">苹果</option>
                                    <option value="android">安卓</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">订单日期:</label>
                            <div class="col-md-1" style="width:14%;">
                                <input type="text" id="start_created_at" value="2017-11-15"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:14%;">
                                <input type="text" id="end_created_at"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>
                            
                            <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:1px;padding-top:8px;float:left;">支付日期:</label>
                            <div class="col-md-1" style="width:14%;">
                                <input type="text" id="start_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-01-05">
                            </div>

                            <label class="" for="first-name" style="text-align:left;padding-top:8px;float:left;">--至--</label>
                            <div class="col-md-1" style="width:14%;">
                                <input type="text" id="end_time"  class="form-control col-md-1 form_datetime" style="border-radius:2px;" placeholder="2016-10-30">
                            </div>

                        </div>

                        <div class="form-group">

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
                                    <th class="column-title" style="text-align: center;float:10px;">订单号</th>
                                    <th class="column-title" style="text-align: center;">用户ID</th>
                                    <th class="column-title" style="text-align: center;">状态</th>
                                    <th class="column-title" style="text-align: center;">来源</th>
                                    <th class="column-title" style="text-align: center;">支付方式</th>
                                    <th class="column-title" style="text-align: center;">金额</th>
                                    <th class="column-title" style="text-align: center;">订单创建时间</th>
                                    <th class="column-title" style="text-align: center;">支付时间</th>
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
            <td class=" " style="text-align:left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<%=data[i].order_no%></td>
            <td class=" "><%=data[i].user_id%></td>
			<td class=" "><% if(data[i].status==0) {%>未支付<% } else if (data[i].status==1) {%><font color="green">已支付</font><%} else{%><font color="red">失败</font><%}%></td>
      		<td class=" "><% if(data[i].os=='ios') {%>苹果<% } else if (data[i].os=='android') {%>安卓<% } else {%>未知<%}%></td>
      		<td class=" "><% if(data[i].pay_code == 'wxpay') {%>微信支付<%} else if(data[i].pay_code == 'alipay'){%>支付宝支付<%}else {%>未知<%}%></td>
            <td class=" "><%=data[i].amount%></td>
            <td class=" "><%=data[i].created_at%></td>
            <td class=" "><% if(data[i].status==1) {%><%=data[i].finished_at%><% }else {%>无<%}%></td>
            <td class=" last" style="vertical-align:center;">
                <% if(data[i].refund==1) {%>
                {{--<button type="button" class="btn btn-success btn-sm fa fa-list-ul btn_oper" value="">已退款</button>--}}
                <a href="javascript:void(0)" class="btn btn-success btn-sm" ><i class="fa fa-list-ul"></i> 已退款 </a>
                 <% }
                else {%>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm refund" val="<%=data[i].id%>"><i class="fa fa-lock"></i>手动退款</a>
                <%}%>
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
        _this.status=1;
        _this.start_created_at =$.trim($("#start_created_at").val());
        var count=0;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            //console.log(_this);
            $.ajax({
                url:'/admin/order_list',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.order}));
                    $("#sum_money").html(result.data.sum_money);
                    $("#sum_money_bonus").html(result.data.sum_money_bonus);
                    $("#sum_money_withdraw").html(result.data.sum_money_withdraw);
                    $("#refund_money").html(result.data.refund_money);
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            count =_count;
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);

            //手动退款
            $(".refund").on("click",function(){
                var id =$(this).attr('val');
                layer.prompt({
                  title: '请输入支付宝账号，并确认', formType: 0},
                  function(pass, index){
                  layer.close(index);
                  layer.prompt({
                  title: '请输入密码', formType: 1},
                  function(text, index){
                    layer.close(index);
                    //layer.msg('演示完毕！您的口令：'+ pass +'<br>您最后写下了：'+text);
                    $.ajax({
                        url:'/admin/order_refund',
                        dataType:"json",
                        type:'post',
                        data:{account:pass,pass:text,id:id},
                        success:function(result){
                            if(result.error==0){
                                layer.msg('退款已成功',{icon:1,time:1000});
                                render();
                            }else{
                                layer.msg(result.desc,{icon:2,time:1000});
                            }
                        }
                    });
                  });
                });
            });
        }
        $("#search").on("click",function(e){
            _this.page=1;
            _this.order_no=$("#order_no").val();
            _this.status=$("#status").val();
            _this.os=$("#os").val();
            _this.user_id =$.trim($("#user_id").val());
            _this.start_time =$.trim($("#start_time").val());
            _this.end_time =$.trim($("#end_time").val());
            _this.start_created_at =$.trim($("#start_created_at").val());
            _this.end_created_at =$.trim($("#end_created_at").val());
            fetch();
        });
        $("#btn_excel").on("click",function(){
           if(count>200){
               var html='<div>';
                for(var i=200;i<count;i+=200){
                    html+='<a class="btn btn-default excel" val='+i+'>'+i+'</a>';
                }
               html+='</div>';
               layer.open({
                   title:"导出订单",
                   area: ['auto', 'auto'],
                   fix: false, //不固定
                   maxmin: true,
                   content: html,
                   success:function(){
                       $(".excel").on("click",function(){
                            _this.offset =$(this).attr('val');
                           var parms ='order';
                           for(var i in _this){
                               if(_this[i]){
                                   parms=parms+'&'+i+'='+_this[i];
                               }
                           }
                           // console.log(parms);
                           window.location.href='/admin/order_excel?order='+parms;
                           parent.layer.closeAll();
                       });
                   }
               });
           }else{
               var parms ='order';
               for(var i in _this){
                   if(_this[i]){
                       parms=parms+'&'+i+'='+_this[i];
                   }
               }
               // console.log(parms);
               window.location.href='/admin/order_excel?order='+parms;
           }
        })
        this.init();
    })
</script>
@endsection
