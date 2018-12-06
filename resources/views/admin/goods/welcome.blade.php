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
                <h3>&nbsp;&nbsp;商品管理</h3>
                <br>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div  class="btn-group" data-toggle="buttons">
                        <a class="btn  <?php if($type==0){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page"  val="0">有赞商品列表</a>
                        <a class="btn <?php if($type==1){?>btn-primary<?php }else{?>btn-default<?php } ?> show_page" val="1">马甲商品管理</a>
                    </div>
                    <div class="btn-group">
                        <?php if($type==1){?>
                        <div class="col-md-1">
                            <a  class="btn btn-edit btn-info" id="create_good">添加马甲商品</a>
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
                <form class="form-horizontal form-label-left" style="text-align: left;">
                    <div class="form-group">

                        <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;分类:</label>
                            <div class="col-md-2" style="width:12%;">

                                <select class="select2_single form-control" id="cate_id" tabindex="-1">
                                    <option value="all">全部</option>
                                @foreach ($cate as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                                </select>

                            </div>
                        <label class="" for="first-name" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">商品名称:</label>
                            <div class="col-md-1" style="width:10%;">
                                <input type="text" id="good_name"  class="form-control col-md-1" style="border-radius:2px;" placeholder="">
                            </div>
                        <label class="" style="text-align:left;padding-right:1px;padding-left:2px;padding-top:8px;float:left;">&nbsp;&nbsp;排序方式:</label>
                            <div class="col-md-2" style="width:12%;">

                                <select class="select2_single form-control" id="order" tabindex="-1">
                                    <option value="sort">按排序</option>
                                    <option value="pv">按浏览量</option>
                                    <option value="uv">按访客数</option>
                                </select>

                            </div>
                        <div class="col-md-1" style="width:6%;">
                            <button type="button" class="btn btn-success" id="search">查询</button>
                        </div>
                    </div>

                </form>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="font-size: 14px;">
							<thead>
								<tr class="headings">
                                    <th class="column-title">id</th>
                                    <th class="column-title">标题</th>
                                    <th class="column-title">浏览量</th>
                                    <th class="column-title">访客数</th>
									<th class="column-title" style="width: 150px; height: 100px;">商品图片</th>
                                    <th class="column-title">价格</th>
                                    <th class="column-title">划线价</th>
                                    <th class="column-title">库存</th>
                                    <th class="column-title">排序</th>
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
            <td class=" "><%=data[i].title%></td>
            <td class=" "><%=data[i].pv%></td>
            <td class=" "><%=data[i].uv%></td>
            <td class=" "><img src="<%=data[i].image%>" width="150px" height="100px"></td>
            <td class=" "><%=data[i].price%></td>
            <td class=" "><%=data[i].origin_price%></td>
            <td class=" "><%=data[i].stock%></td>
            <td class=" "><%=data[i].sort%></td>
            <td class=" last" style="vertical-align:center;">
                <a href="/admin/goods_detail?id=<%=data[i].id%>&cate_id=<%=data[i].cate_id%>" target='_blank' class="btn btn-primary btn-sm" ><i class="fa fa-list-ul"></i> 详情 </a>
                <%if(data[i].status==1){%><a class="btn btn-danger btn-sm item_close1" val="<%=data[i].id%>" ><i class="fa fa-lock" title="下架" ></i>下架</a><%}else{%><a class="btn btn-info btn-sm item_close1" val="<%=data[i].id%>"><i class="fa fa-unlock" title="上架"></i> 上架</a><%}%>
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
                url:'/admin/get_goods_data',
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

             $(".item_close1").on("click",function(e){
                var id =$(this).attr('val');
                var url = "/admin/goods_status?id="+id;
                $.ajax({url:url,success:function(data,status,xhr){
                    if(data.error == 0) {
                        layer.msg('修改成功', {icon: 6});
                        fetch();
                    } else {
                        layer.msg(data.info, {icon: 6});
                    }
                }
                    });
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
        };
        $("#search").on("click",function(e){
            _this.page=1;
            _this.cate_id=$("#cate_id").val();
            _this.good_name=$("#good_name").val();
            _this.order=$("#order").val();
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
