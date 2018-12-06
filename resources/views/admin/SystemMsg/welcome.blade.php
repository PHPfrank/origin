@extends('admin.master') 
@section('content')
    <script type="text/javascript" src="/static/js/page.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>&nbsp;&nbsp;系统消息</h3>
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
                    <small><a  class="btn btn-sm btn-primary btn-add" val="0">添加消息</a></small>
                    <div class="clearfix"></div>
                </div>
				<div class="x_content">
					<div class="table-responsive">
						<table class="table table-striped jambo_table bulk_action"
							style="text-align: center;">
							<thead>
								<tr class="headings">
                                    <th class="column-title" style="text-align: center;">名称</th>
									<th class="column-title" style="text-align: center;">代码</th>
                                    <th class="column-title" style="text-align: center;">内容(带有***或者###的会被自动替换 )</th>
                                    <th class="column-title" style="text-align: center;">时间</th>
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
            <td class=" "><%=data[i].name%></td>
            <td class=" "><%=data[i].key%></td>
            <td class=" "><%=data[i].msg%></td>
            <td class=" "><%=data[i].created_at%></td>
            <td class=" last">
                <a class="btn btn-edit btn-info btn-xs" title="修改菜单" val="<%=data[i].id%>" level="1"><i class="fa fa-pencil"></i> 修改 </a>
                <a class="btn btn-remove btn-danger btn-xs" title="删除菜单" val="<%=data[i].id%>"><i class="fa fa-trash-o"></i> 删除 </a>
                {{--<a href="javascript:void(0)"  class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除 </a>--}}
            </td>
        </tr>
        <%}%>
</script>
    <script type="text/html" id="add_tpl">
            <div class="x_panel">
                <div class="x_content">
                    <form id="authedit" class="form-horizontal form-label-left" novalidate>
                        <div class="item form-group">
                            <label
                                   class="control-label col-md-3 col-sm-3 col-xs-2" style="width: 12%">名称:</label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <input id="name" type="text" name="name"
                                       class="form-control col-md-7 col-xs-7" required="required" value="<%if(typeof(info) != "undefined") {%><%=info.name%><%}%>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2"
                                   class="control-label col-md-3 col-sm-3 col-xs-2" style="width: 12%">代码:</label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <input id="key" type="text" name="name"
                                       class="form-control col-md-7 col-xs-7" required="required" value="<%if(typeof(info) != "undefined") {%><%=info.key%><%}%>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2"
                                   class="control-label col-md-3 col-sm-3 col-xs-2" style="width: 12%">消息:</label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <textarea id="content" class="form-control" required="required" rows="5"><%if(typeof(info) != "undefined") {%><%=info.msg%><%}%></textarea>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-3">
                                <button type="reset" class="btn btn-success"
                                        style="float: right;" id="cancel">取消</button>
                                <button type="button" class="btn btn-primary"
                                        style="float: right; margin-right: 20px;" id="tijiao">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                url:'/admin/system_msg',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    var tpl = $("#item_list").html();
                    $("#data_list").html(template(tpl,{data:result.data.info}));
                   render(result.data.count);

                }
            });
        },
        render=function(_count){
            pageinit({
                page:{pageSize:10,currentPage:_this.page},
                _count:_count
            },_this);
            $(".btn-add").on("click",function(){
                var tpl = $("#add_tpl").html();
                var html =template(tpl,{});
                layer.open({
                    id:'feed_back_dialog',
                    title:"添加消息",
                    area: ['550px', '450px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: "<div id='add'>"+html+"</div>",
                    btn:false,
                    success:function(){
                        do_add(0);
                    }
                });

            })
            $(".btn-edit").on("click",function(e){
                var id =$(this).attr('val');
                layer.open({
                    id:'feed_back_dialog',
                    title:"添加消息",
                    area: ['550px', '450px'],
                    fix: false, //不固定
                    maxmin: true,
                    content: "<div id='add'></div>",
                    btn:false,
                    success:function(){
                        $.ajax({
                            url:'/admin/get_system_msg',
                            dataType:"json",
                            type:'post',
                            data:{id:id},
                            success:function(result){
                                var tpl = $("#add_tpl").html();
                                var html =template(tpl,{info:result.data.info});
                                $("#add").html(html);
                                do_add(id);
                            }
                        });
                    }
                });
            });
            $(".btn-remove").on("click",function(){
                var id =$(this).attr('val');
                $.ajax({
                    url:'/admin/api/del_system_msg',
                    dataType:"json",
                    type:'post',
                    data:{id:id},
                    success:function(result){
                        if(result.error==0){
                            fetch();
                        }else{
                            layer.msg(result.msg,{icon: 2,time: 1000 })
                        }
                    }
                });
            });

        },do_add=function(id){
            $("#tijiao").on("click",function(){
                var name = $.trim($("#name").val());
                var key =$.trim($("#key").val());
                var content =$.trim($("#content").val());
                if(name==''){
                    msg='请输入消息名称';
                    alert_msg(msg);
                    return false;
                }
                if(key==''){
                    msg='请输入对应代码';
                    alert_msg(msg);
                    return false;
                }
                if(content==''){
                    msg='请输入消息内容';
                    alert_msg(msg);
                    return false;
                }
                $.ajax({
                    url:'/admin/add_system_msg',
                    dataType:"json",
                    type:'post',
                    data:{id:id,name:name,content:content,key:key},
                    success:function(result){
                        if(result.error==0){
                            parent.layer.closeAll();
                            fetch();
                        }else{
                            layer.msg(result.msg,{icon: 2,time: 1000 })
                        }
                    }
                });

            });
            $("#cancel").on("click",function(){
                parent.layer.closeAll();
            });
        },alert_msg=function(msg){
            layer.open({
                title:false,
                type:1,
                content:"<font color='red' style='padding-left: 20px;font-size:14px;line-height: 50px;'><i class='fa fa-warning'></i>"+msg+"!</font>",
                time:1000,
                area: ['150px', '50px']
            });
        }


        this.init();
    })
</script>
@endsection
