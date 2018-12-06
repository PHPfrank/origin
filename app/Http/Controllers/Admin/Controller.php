<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:55
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Cookie;
use App\Models\AdminRule;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //后台用户信息
    protected $adminUser = null;

    //规则信息
    protected $rulesInfo = null;

    //传递视图数据
    protected $data = array();

    /**
     * 获取导航栏数据
     */
    public function getMemuData()
    {
        $cookieUser = $this->adminUser();
        $this->adminUser = AdminUser::getAdminInfo($cookieUser['auth_id']);
        if($this->adminUser->group_id!=0){
            $groupInfo = $this->adminUser->userGroup()->first();
        }else{
            $groupInfo=(object)['rules'=>'all'];
        }
        $adminRule = new AdminRule();
        $this->rulesInfo = $adminRule->getDataByRule($groupInfo->rules);
        $this->data = ['adminUser'=>$this->adminUser,"rulesInfo"=>$this->rulesInfo];
    }

    /**
     * 获取后台用户信息
     */
    public function adminUser()
    {
        if($adminUser = Cookie::get("token")) {
            return json_decode($adminUser,true);
        }
        return false;
    }

    /**
     * 控制层AJAX请求返回json消息
     */
    public function ajaxJson($content = "",$type = 0,$status = 200,$cookie = "")
    {
        $data = array(
            "desc" => $this->_lang($type),
            "error" => $type,
            "data" => $content
        );
        return $cookie ? response()->json($data,$status)->withCookie($cookie) : response()->json($data,$status);
    }

    /**
     * 控制层错误返回
     * @param unknown $type
     * @return string
     */
    public function errorJson($type = -1000,$status = 200,$desc = "")
    {
        $data = array(
            "desc" 	=> $desc ? $desc : $this->_lang($type),
            "error" => $type,
            "data"  => new \stdClass()
        );
        return response()->json($data,$status);
    }

    protected  function _lang($type)
    {
        $lang = array(
            "0" => "成功",
            "-1000" => "您没有权限，不能操作",
            "-1001" => "后台用户编辑错误",
            "-1002" => "记录ID不存在",
            "-1003" => "该用户不存在",
            "-1004" => "请先删除子菜单",
            "-1005" => "上传失败",
            "-1006" => "更新失败",
            "-1007"=>"短信发送失败，一次发送号码不能超过10W个",
            "-1008"=>"短信发送失败,发送手机为空",
            "-1009" => "消息发送失败",
            "-1010" => "提现记录不存在",
            "-1011" => "该用户收益余额不足",
            "-1012" => "付款人次与实际人次不匹配",
            "-1013" => "付款金额不匹配",
            "-1014" => "参数不合法",
            "-1050" => "操作错误，请稍后再试",
            "-1051" => "原密码错误",
            "-1052" => "重复密码不一致",
            "-1053" => "重复设置",
            "-1054" => "管理员超出上限（".Config::get('app.ADMIN_NUM')."）",
            "-1055" => "配色参数格式错误",
            "-1056" => "缺少必填项",
            "-1057" => "退款失败",
            "-1058" => "不允许重复退款",
            "-1059" => "退款邮箱格式错误",

            "-2000" => "昵称已被使用",
            "-2001" => "操作失败",
            "-2002" => "马甲库用完了",


            "-3000" => "余额不足",
            "-3001" => "已经达到今日付款总额上限/已达到付款给此用户额度上限",
            "-4001" => "商品详情最多五张图片",
        );
        return isset($lang[$type]) ? $lang[$type] : "未知错误，请联系客服人员";
    }


}