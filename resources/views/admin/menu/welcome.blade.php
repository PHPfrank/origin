@extends('admin.master') 
@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>&nbsp;&nbsp;菜单管理</h3>
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
					<ul class="nav navbar-right panel_toolbox"></ul>
					<small><a  class="btn btn-sm btn-primary btn-add" val="0">添加菜单</a></small>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="datatable-fixed-header" class="table table-striped table-bordered" style="text-align: center;">
							<thead>
								<tr class="headings">
                                    <th class="column-title" style="text-align: center;">菜单名</th>
                                    <th class="column-title" style="text-align: center;">代码</th>
									<th class="column-title" style="text-align: center;">状态</th>
									<th class="column-title" style="text-align: center;">排序</th>
									<th class="column-title" style="text-align: center;">创建时间</th>
									<th class="column-title" style="text-align: center;">操作</th>
								</tr>
							</thead>
							<tbody id="data_list">

                        </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/html" id="list_tpl">
    <%for(var i=0;i<data.length;i++){%>
    <tr class="even pointer">
        <td class=" " style="text-align:left;vertical-align: middle;"><%=data[i].title%>&nbsp;&nbsp;&nbsp; <a  class="btn btn-add btn-info btn-xs" title="添加子菜单"  val="<%=data[i].id%>" level="1"><i class="fa fa-plus"></i> 添加 </a></td>
        <td style="vertical-align: middle;"><%=data[i].name%> </td>

        <td style="vertical-align: middle;"><%if(data[i].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
        <td style="vertical-align: middle;"><%=data[i].sort%></td>
        <td style="vertical-align: middle;"><%=data[i].created_at%></td>
        <td class=" last" style="vertical-align: middle;">

            <a class="btn btn-edit btn-info btn-sm" title="修改菜单" val="<%=data[i].id%>" level="1"><i class="fa fa-pencil"></i> 修改 </a>
            <a class="btn btn-remove btn-danger btn-sm" title="删除菜单" val="<%=data[i].id%>"><i class="fa fa-trash-o"></i> 删除 </a>
        </td>
    </tr>
   <%if(data[i].child!=undefined){ for(var j=0;j<data[i].child.length;j++){%>
    <tr class="even pointer">
        <td style="text-align: left;vertical-align: middle;" ><font color="#000000" style="width: 70px;">----------&nbsp;&nbsp;&nbsp;</font><%=data[i].child[j].title%>&nbsp;&nbsp;&nbsp;<a  class="btn btn-add btn-info btn-xs" title="添加子菜单"  val="<%=data[i].child[j].id%>" level="2"><i class="fa fa-plus"></i> 添加 </a> </td>
        <td style="vertical-align: middle;"><%=data[i].child[j].name%></td>
        <td style="vertical-align: middle;"><%if(data[i].child[j].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
        <td style="vertical-align: middle;"><%=data[i].child[j].sort%></td>
        <td style="vertical-align: middle;"><%=data[i].child[j].created_at%></td>
        <td class=" last" style="vertical-align: middle;">
            <a class="btn btn-edit btn-info btn-sm" title="修改菜单" val="<%=data[i].child[j].id%>" ><i class="fa fa-pencil"></i> 修改 </a>
            <a class="btn btn-remove btn-danger btn-sm" title="删除菜单" val="<%=data[i].child[j].id%>"><i class="fa fa-trash-o"></i> 删除 </a>
        </td>
    </tr>
    <%if(data[i].child[j].schild!=undefined){ for(var u=0;u<data[i].child[j].schild.length;u++){%>
    <tr class="even pointer">
        <td class=" " style="text-align: left;vertical-align: middle;"><font color="#000000" style="width: 70px;">---------------------&nbsp;&nbsp;&nbsp;</font><%=data[i].child[j].schild[u].title%> </td>
        <td style="vertical-align: middle;"><%=data[i].child[j].schild[u].name%> </td>
        <td style="vertical-align: middle;"><%if(data[i].child[j].schild[u].status==0){%><font color="green">启用</font><%}else{%><font color="red">禁用</font><%}%></td>
        <td style="vertical-align: middle;"><%=data[i].child[j].schild[u].sort%></td>
        <td style="vertical-align: middle;"><%=data[i].child[j].schild[u].created_at%></td>
        <td class=" last" style="vertical-align: middle;">
            <a class="btn btn-edit btn-info btn-sm" title="修改菜单" val="<%=data[i].child[j].schild[u].id%>"><i class="fa fa-pencil"></i> 修改 </a>
            <a class="btn btn-remove btn-danger btn-sm" title="删除菜单" val="<%=data[i].child[j].schild[u].id%>"><i class="fa fa-trash-o"></i> 删除 </a>
        </td>
    </tr>
    <%} }} }}%>
</script>
<script type="text/javascript">
	$(function(){
        var _this={};
        this.init=function(){
            fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/menu_list',
                dataType:"json",
                type:'get',
                success:function(result){
                    _this =result.data;
                    var tpl = $("#list_tpl").html();
                    $("#data_list").html(template(tpl,{data:_this}));
                    render();

                }
            });
       },
       render=function(){
            $(".btn-add").on("click",function(e){
                var id =$(this).attr('val');
                layer.open({
                     type: 2,
                    title:"添加菜单",
                    area: ['600px', '400px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: '/admin/menu_add?id='+id
                });
            });

            $(".btn-edit").on("click",function(e){
                var id =$(this).attr('val');
                layer.open({
                    type: 2,
                    title:"添加菜单",
                    area: ['600px', '400px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: '/admin/menu_edit?id='+id
                });

            });

            $(".btn-remove").on("click",function(e){
                var id =$(this).attr('val');
                layer.confirm('您确定要删除该菜单吗？', {
                    btn: ['确定','取消'] //按钮
                }, function(){
                    $.ajax({
                        url:'/admin/api/delmenu',
                        type:"post",
                        dataType:"json",
                        data:{id:id},
                        success:function(result){
                            if(result.error!=0){
                                layer.msg(result.msg, {icon: 2,time: 1000 });
                            }else{
                                fetch();
                                parent.layer.closeAll();
                            }
                        }
                    });
                }, function(){
                });
            })
        };
        this.init();
    })
</script>
@endsection
