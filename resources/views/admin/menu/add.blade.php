@extends('admin.tips') @section('content')
    <div class="right_col" role="main">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form id="authedit" class="form-horizontal form-label-left" novalidate>
                        <?php if($info&&$info['level']==2||$info&&$info['level']==3){?>
                        <div class="item form-group" >
                            <label class="control-label col-md-3 col-sm-3 col-xs-2" for="name">上级菜单
                            </label><?=$menu['title']?>
                        </div>
                            <?php }?>
                            <input type="hidden" value="<?php if($menu){?><?=$menu['id']?><?php }?>" id="pid">
                            <input type="hidden" value="<?php if($info){?><?=$info['id']?><?php }?>" id="id">
                            <input type="hidden" value="<?php if($info){?><?=$info['level']?><?php } else {?><?=$level?><?php } ?>" id="level">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-2" for="name">菜单名
                                <span class="required"></span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <input id="title" class="form-control col-md-9 col-xs-7"
                                       data-validate-length-range="6" data-validate-words="2"
                                       name="title" placeholder="" required="required" type="text" value="<?php if($info){?><?=$info['title']?><?php }?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2"
                                   class="control-label col-md-3 col-sm-3 col-xs-2">代码</label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <input id="name" type="text" name="name"
                                       data-validate-length="6,8"
                                       class="form-control col-md-7 col-xs-7" required="required" value="<?php if($info){?><?=$info['name']?><?php }?>">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="password2"
                                   class="control-label col-md-3 col-sm-3 col-xs-2">排序</label>
                            <div class="col-md-9 col-sm-9 col-xs-7">
                                <input id="sort" type="text" name="sort"
                                       class="form-control col-md-7 col-xs-7" style="width: 50px;" value="<?php if($info){?><?=$info['sort']?><?php }?>" >
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-2"
                                   for="textarea">状态 <span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-7" style="padding-top: 7px;">
                                <label> <input type="radio" checked="checked" value="0" <?php if($info){?><?php if($info['status']==0){?>checked="checked"<?php }}?> id="optionsRadios1" name="status"> 启用</label>
                                <label><input type="radio"  value="-1" <?php if($info){?><?php if($info['status']==-1){?>checked="checked"<?php }}?> id="optionsRadios1" name="status"> 禁用</label>
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
		</div>
	</div>

<script type="text/javascript">
	$(function(){
        $("#tijiao").on("click",function(e){
            var title = $.trim($("#title").val());
            if(title==''){
                layer.msg('请输入菜单名', {icon: 2,time: 1000 });
                return false;
            }
            var pid =$("#pid").val();
            var name = $.trim($("#name").val());
            if(name==''){
                layer.msg('请输入代码', {icon: 2,time: 1000 });
                return false;
            }
            var status =$("input[type='radio']:checked").val();
            var sort = $.trim($("#sort").val());
            var id = $.trim($("#id").val());
            var level = $.trim($("#level").val());
            $.ajax({
                url:'/admin/api/addmenu',
                type:"post",
                dataType:"json",
                data:{title:title,pid:pid,name:name,status:status,sort:sort,id:id,level:level},
                success:function(data){
                   if(data.error==0){
                       window.parent.location.reload();
                       parent.layer.closeAll();
                   }else{
                       layer.msg(data.msg, {icon: 2,time: 1000 });
                   }
                }
            });
        });
        $("#cancel").on("click",function(e){
            parent.layer.closeAll();
        })
    })
</script>
@endsection
