@extends('admin.master') 
@section('content')
    <link href="/static/js/datetimepicker/css/datetimepicker.css" rel="stylesheet">
    <link href="/static/css/lightbox.css" rel="stylesheet">
    <script type="text/javascript" src="/static/js/datetimepicker/datetimepicker.js"></script>
    <script type="text/javascript" src="/static/js/datetimepicker/datepicker.zh-CN.js"></script>
    <script type="text/javascript" src="/static/js/lightbox.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="page-title">
				<div class="title_left">
					<h3>{{$title}}</h3>
				</div>
				<a class="btn btn-default" style="float: right;" href="javascript:void(0);" onClick="window.location.href=document.referrer;">返回</a>
				
			</div>
			<div class="row">
				<div id="info-content" >
			    </div>

            </div>
        </div>
    </div>
    <div class="x_panel" style="border-top: 1px solid #dddddd;margin-top: 10px;">       
        <form method='post' name='edit' action='api/vip_good_edit'>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">原价title:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="title_1" class="form-control col-md-3 col-xs-12" value="{{$info->title_1}}">
                </div>
            </div> 
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">特惠title:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="title_2" class="form-control col-md-3 col-xs-12" value="{{$info->title_2}}">
                </div>
            </div> 
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">实际售价:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="real_price" class="form-control col-md-3 col-xs-12" value="{{$info->real_price}}">
                </div>
            </div>   
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">原价:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="orig_price" class="form-control col-md-3 col-xs-12" value="{{$info->orig_price}}">
                </div>
            </div>   
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">VIP有效期:
                    <span class="">[>0-天，-1 - 终身会员]</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="day" class="form-control col-md-3 col-xs-12" value="{{$info->day}}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">优惠价格效果展示:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="radio" name='sale_banner' @if($info->sale_banner==1) checked @endif  value='1'>展示
                    <input type="radio" name='sale_banner' @if($info->sale_banner==2) checked @endif value='2'>不展示
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">是否可见:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="radio" name='status' @if($info->status==1) checked @endif  value='1'>可见
                    <input type="radio" name='status' @if($info->status==2) checked @endif value='2'>不可见
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">会员类型:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="radio" name='is_vip_forever' @if($info->is_vip_forever==1) checked @endif  value='1'>终身会员
                    <input type="radio" name='is_vip_forever' @if($info->is_vip_forever==2) checked @endif value='2'>普通会员
                </div>
            </div>
            <div class="form-group col-md-12">
                <label class="control-label col-md-3 col-sm-3 col-xs-3" for="last-name" style="padding-top: 8px; text-align: right;">排序:
                    <span class=""></span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-8" style="">
                    <input type="text" id="" name="order_by" class="form-control col-md-3 col-xs-12" value="{{$info->order_by}}">
                </div>
            </div>

            <label class="control-label col-md-8 col-sm-8 col-xs-8" for="last-name" style="padding-top: 8px; text-align: right;">
                <input type='submit' id="" class="btn btn-sm btn-success" style="float: right;"  value="提交">
            </label>
                
            <input type='hidden' name='id' id='' value="{{$info->id}}">
        </form>
    </div>
</div>
    
@endsection
