<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 15:01
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Support\Common;
use Illuminate\Support\Facades\Redirect;
use Cookie;


class PublicController extends Controller
{

    /**
     * 后台登录操作
     */
    public function do_login(Request $reqeust)
    {
        $name = $reqeust->input("username","");
        $pwd = $reqeust->input("pwd","");
        $adminUser = new AdminUser();
        if($adminUserInfo = $adminUser->loginAdminInfo($name,$pwd)) {
            //设置cookie
            $cookie = Cookie::make("token", json_encode($adminUserInfo), 2*3600);
            //整个http流程一定要走完
            return $this->ajaxJson($adminUserInfo,0,200,$cookie);
        }
        return $this->errorJson(-1000);
    }

    /**
     * 后台登录页面
     */
    public function loginPage(Request $request)
    {
        return view('admin.login');
    }

    public function LoginOut(){
        //Cookie::queue("token", '', -600);
        $cookie = Cookie::forget('token');
        return Redirect::route('for_login')->withCookie($cookie);
    }



    /**
     * 上传图片
     */
    public function upload(Request $request)
    {
        if($_FILES['file']) {
            $data = array('pic'=>curl_file_create(realpath($_FILES['file']['tmp_name']),$_FILES['file']['type'],$_FILES['file']['name']));
            $url  = config("common.pic_url");
            $header_data[] = "channel".":".config('common.pic_channel');
            $ch  = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            if (curl_errno($ch)) {
                return "";
            }
            $return_data = json_decode(curl_exec($ch), true);

            curl_close($ch);

            if (isset($return_data['items'])) {

                if (count($return_data['items'])) {

                    return $this->ajaxJson($return_data['items'][0]);
                }
            }
        }
        return $this->errorJson(-1005);
    }



}