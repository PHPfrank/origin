<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:57
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\AdminGroup;
use Illuminate\Support\Facades\Cookie;

/**
 * 后台用户管理
 * @author zyf
 */
class AuthController extends Controller
{

    /**
     * 后台用户管理(页面)
     */
    public function authPage(Request $request)
    {
        $this->getMemuData();
        $adminUser = new AdminUser();
        if($this->data['adminUserList'] = $adminUser->get()) {
            foreach ($this->data['adminUserList'] as $k => $v) {
                $this->data['adminUserList'][$k]->group = $v->userGroup()->first();
            }
        }
        $this->data['sider']='authManage';
        return view('admin.auth.auth',$this->data);
    }

    /**
     * 后台用户编辑
     */
    public function authEditPage(Request $request)
    {
        if($auth_id = $request->input("auth_id")) {
            $this->data['authInfo'] = AdminUser::getAdminInfo($auth_id);
        }
        $this->data['adminGroup'] = AdminGroup::get();
        return view('admin.auth.authedit',$this->data);
    }

    /**
     * 后台编辑操作
     */
    public function do_authEdit(Request $request)
    {
        $data['auth_name'] = $request->input("name");
        $data['auth_pwd'] = $request->input("pwd");
        $data['group_id'] = $request->input("group");
        $data['status'] = $request->input("status");
        $adminUser = new AdminUser();

        if($auth_id = $request->input("id")) {
            $adminUser = $adminUser::getAdminInfo($auth_id);
            if($data['auth_pwd'] == $adminUser->auth_pwd) {
                unset($data['auth_pwd']);
            }
        }
        if($adminUser->addOrUpdateUser($data)) {
            return $this->ajaxJson($adminUser);
        }
        return $this->errorJson(-1001);
    }

    /**
     * 删除后台用户操作
     */
    public function do_authDel(Request $request)
    {
        if($auth_id = $request->input("auth_id")) {
            $adminUser = new AdminUser();
            if($adminUser->deleteUser($auth_id)) {
                return $this->ajaxJson("删除成功");
            }
        }
        return $this->errorJson(-1003);
    }

    /*全局修改管理员密码*/
    public function edit_pwd(Request $request){
        $data['old_pwd'] = $request->input("old_pwd");
        $data['new_pwd'] = $request->input("new_pwd");
        $data['new_pwd_too'] = $request->input("new_pwd_too");

        if($data['new_pwd'] != $data['new_pwd_too'])
            return $this->errorJson(-1052);
        $admin =json_decode(Cookie::get('token'),true);
        $adminUser = AdminUser::getAdminInfo($admin['auth_id']);
        if($adminUser->auth_pwd==md5($data['old_pwd'].$admin['pwd_code'])){
            $adminUser->auth_pwd = md5($data['new_pwd'].$admin['pwd_code']);
//			dd($adminUser);
            $adminUser->save();
            return $this->ajaxJson("密码修改成功");
        }else{
            return $this->errorJson(-1051);
        }



    }


}