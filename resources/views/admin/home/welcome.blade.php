@extends('admin.master')
@section('content')
<script src="/static/js/highcharts/highcharts.js"></script>
<div class="right_col" role="main">
    <div style="margin-top: 5px;margin-bottom: 20px;">
        <span id="title" style="font-size: 26px;">今日统计</span>

        <span id="time" style="margin-left: 10px; font-size: 20px;"></span>
    </div>
    <div class="">
        <div class="clearfix"></div>
        <div class="row top_tiles">

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                  <a href="/admin/base_user">  <div class="icon"><i class="fa fa-female"></i></div>
                    <div class="count" id="register_all">0</div>
                    <h3>平台注册数</h3>
                    <br>
                    </a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/base_user"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="register_ios">0</div>
                        <h3>ios注册数</h3>
                        <br></a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/base_user"> <div class="icon"><i class="fa fa-user"></i></div>
                    <div class="count" id="register_android">0</div>
                    <h3>android注册数</h3>
                    <br></a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="vip_all">0</div>
                        <h3>平台vip订单数</h3>
                        <br></a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="vip_ios">0</div>
                        <h3>苹果vip会员订单</h3>
                        <br></a>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="vip_android">0</div>
                        <h3>安卓vip会员订单</h3>
                        <br></a>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="income_all">0</div>
                        <h3>平台vip收入</h3>
                        <br></a>
                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="income_ios">0</div>
                        <h3>苹果vip收入</h3>
                        <br></a>
                </div>
            </div>

            <div class="animated flipInY col-lg-3 col-md-3 col-sm-3 col-xs-3" style="width:33%;">
                <div class="tile-stats">
                    <a href="/admin/order"> <div class="icon"><i class="fa fa-user"></i></div>
                        <div class="count" id="income_android">0</div>
                        <h3>安卓vip收入</h3>
                        <br></a>
                </div>
            </div>

    </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        var _this={};
        _this.page=1;
        this.init=function(){
           fetch();
        },
        fetch=function(){
            $.ajax({
                url:'/admin/today_data',
                dataType:"json",
                type:'get',
                data:_this,
                success:function(result){
                    $("#register_all").html(result.data.result.register_all);
                    $("#register_ios").html(result.data.result.register_ios);
                    $("#register_android").html(result.data.result.register_android);
                    $("#vip_all").html(result.data.result.vip_all);
                    $("#vip_ios").html(result.data.result.vip_ios);
                    $("#vip_android").html(result.data.result.vip_android);
                    $("#income_all").html(result.data.result.income_all);
                    $("#income_ios").html(result.data.result.income_ios);
                    $("#income_android").html(result.data.result.income_android);
                    $("#time").html('最后统计时间：'+ result.data.result.time);
                }
            });
        };
        this.init();
    })
</script>
@endsection
