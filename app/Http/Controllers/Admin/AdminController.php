<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:54
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminUser;


class AdminController extends Controller
{
    /**
     * 后台首页
     */
    public function homePage(Request $request)
    {
        $this->getMemuData();
        $this->data['sider'] ='home';
        return view('admin.home.welcome',$this->data);
    }

    /**
     * 权限设置
     */
    public function rulesPage()
    {

    }

    /**
     * 用户管理
     */
    public function userPage(Request $request)
    {
        $this->getMemuData();
        return view('admin.user',$this->data);
    }

    public function forbidden(){
        $this->getMemuData();
        $this->data['sider'] ='home';
        return view('admin.forbidden',$this->data);
    }
}