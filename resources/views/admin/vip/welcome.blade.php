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
                <h3>&nbsp;&nbsp;VIP管理</h3>
                <br>
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
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
                                    <th class="column-title" style="text-align: center;">VIP编号</th>
                                    <th class="column-title" style="text-align: center;">VIP会员名称</th>
                                    <th class="column-title" style="text-align: center;">会员价格</th>
                                    <th class="column-title" style="text-align: center;">会员特权</th>
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
<img id='img_show' src="" style="position:fixed;right:0; top:0;display:none;max-height:100%;">
    <script type="text/html" id="item_list">
        <%for(var i = 0; i < data.length; i++) {%>
        <tr class="even pointer">
            <td class=" " style="vertical-align:middle;"><%=data[i].id%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].level_name%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].money%></td>
            <td class=" " style="vertical-align:middle;"><%=data[i].remark%></td>
            <td class=" last" style="vertical-align:middle;">
                <a href="/admin/vip_info?id=<%=data[i].id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 编辑 </a>
            </td>
        </tr>
        <%}%>
</script>

<script type="text/javascript">
    function check_deny(did){

        $.ajax({
                url:'/admin/check_date',
                type:'get',
                data:{did:did,status:-1},
                success:function(msg){
                var msg = msg;
                console.log(msg);
                $.ajax({
                        url:'/admin/vip_list_data',
                        type:'get',
                        data:{},
                        success:function(result){
                        var tpl = $("#item_list").html();
                        $("#data_list").html(template(tpl,{data:result.data.list}));
                          }
                       });
            }
                });
    }

    function check_pass(did){

            $.ajax({
                    url:'/admin/check_date',
                    type:'get',
                    data:{did:did,status:1},
                    success:function(msg){
                    $.ajax({
                        url:'/admin/date_list_data',
                        type:'get',
                        data:{},
                        success:function(result){
                        var tpl = $("#item_list").html();
                        $("#data_list").html(template(tpl,{data:result.data.list}));
                          }
                       });
                }
                    });
        }

        function recommend(did){
                    $.ajax({
                            url:'/admin/recommend',
                            type:'get',
                            data:{did:did},
                            success:function(msg){
                            $.ajax({
                                url:'/admin/date_list_data',
                                type:'get',
                                data:{},
                                success:function(result){
                                var tpl = $("#item_list").html();
                                $("#data_list").html(template(tpl,{data:result.data.list}));
                                  }
                               });
                        }
                            });
                }



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
        _this.status=$("#status").val();
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/vip_list_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    console.log(result);
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.list}));
                   render(result.data._count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            
            // 封面图
            $(".dmc_img").on("click",function(e){
                var img_id = $(this).attr('val');
                $.ajax({
                    url:"/admin/set_img_weights?id="+img_id,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            // 推荐动态
            $(".recommend_dmc").on("click",function(e){
                var id = $(this).attr('val');
                $.ajax({
                    url:"/admin/api/recommend_dmc?id="+id,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });


            $('#qx').click(function(){
                if(this.checked){
                    $('.box').prop('checked',true);
                }else{
                    $('.box').prop("checked",false);
                }
            });
            $(".t_box").click(function(){
                var box = $(this).find('input[type="checkbox"]');
                box.click();
            });

            $('.dmc_img').dblclick(function(){
                var src = $(this).attr('src');
                var myWindow = window.open('');
                myWindow.document.write("<img src='"+src+"' >");
            });
            // 
            $(".dmc_img").mouseover(function(){
                var src = $(this).attr('src');
                $('#img_show').attr('src',src);
                $('#img_show').show();  
                // setTimeout(function(){
                //     $('#img_show').attr('src',src);
                //     $('#img_show').show();
                // },300);
                
                // $(this).parent().find('div').show();    
            });
            $(".dmc_img").mouseout(function(){
                $('#img_show').hide();
                // $(this).parent().find('div').hide();    
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

        //审核
        $('.ck_dmc').on("click",function(e){
            var status = $(this).attr('val');

            var dids = '';
            var checked = $('.box:checked');
            checked.each(function(i,item){
                if(i==0){
                    dids += $(this).val();
                }else{
                    dids += ','+$(this).val();
                }   
            });

            if(dids==''){
                layer.msg('没有操作对象', {icon: 2,time: 1000 });
                return false;
            }
            // alert('dids');
            console.log(dids);
            layer.confirm('确认提交', {
                btn: ['确定','取消'] //按钮
            }, function() {
                $.ajax({
                    url:"/admin/api/ck_dmc?dids="+dids+'&status='+status,
                    dataType:"json",
                    type:'get',
                    data:{},
                    success:function(result){
                        if(result.error == 0) {
                            layer.msg('提交成功', {icon: 6});
                            fetch();
                        } else {
                            layer.msg(result.msg, {icon: 2,time: 1000 });
                        }
                    }
                });
            });
            return false;

        });
        $("#search").on("click",function(e){
            _this.status=$("#status").val();
            _this.close=$("#close").val();
            _this.sex=$("#sex").val();
            _this.uid =$.trim($("#uid").val());
            _this.nickname =$.trim($("#nickname").val());
            _this.phone =$.trim($("#phone").val());
            _this.is_bounty = $.trim($("#is_bounty").val());
            _this.start_time = $.trim($("#start_time").val());
            _this.end_time = $.trim($("#end_time").val());
            _this.active_start_time = $.trim($("#active_start_time").val());
            _this.active_end_time = $.trim($("#active_end_time").val());
            _this.workplace = $.trim($("#workplace").val());
            _this.is_recommend = $.trim($("#is_recommend").val());
            
            fetch();
        });
        $(".show_page").on("click",function(e){
            _this.vest=$(this).attr('val');
           window.location.href='/admin/base_user?type='+_this.vest;

        });
        $("#create_user").on("click",function(){
            layer.open({
                title:"生成马甲号",
                area: ['300px', '230px'],
                fix: false, //不固定
                maxmin: true,
                content:'<textarea id="num" class="form-control" required="required" rows="4" placeholder="请填写生成几个马甲号"></textarea>',
                btn:['确定','取消'],
                success:function(){
                    $("#num").parent('div').css("height","148px");
                },
                yes:function(e){
                   var num =$.trim($("#num").val());
                    if(num==''){
                        msg='请输入需要生成马甲号的个数';
                        alert_msg(msg);
                        return false;
                    }
                    $.ajax({
                        url:'/admin/api/user_create_vest',
                        dataType:"json",
                        type:'post',
                        data:{num:num},
                        success:function(result){
                            if(result.error == 0) {
                                layer.msg("生成马甲号成功",{icon:1,time:2000});
                                fetch();
                            } else {
                                layer.msg(result.msg, {icon: 2,time: 1000 });
                            }

                        }
                    });

                }
            });
        });

        this.init();
    })
</script>
@endsection
