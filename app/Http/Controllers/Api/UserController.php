<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:43
 */
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\User;

class UserController extends Controller
{
    protected $users;

    public function __construct(User $userServices)
    {
        parent::__construct();

        $this->users = $userServices;
    }

    /**我的信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function getMyInfo(Request $request)
    {
        $user = $this->checkUser();
//        //转数组
//        $result = $user->toArray();
        $result['user'] = $user;
        //数据返回
        return $this->wantsJson($result);
    }

    public function getUserList(Request $request)
    {
        //接收参数
        $data = [];
        $field =  ["uid","nickname","status","sex"];
        foreach ($field as $key){
            if ($request->has($key)){
                $data[$key] = $request->input($key);
            }
        }
        //获取用户列表
        $list = $this->users->getList($data);
        //数据返回
        return $this->wantsJson($list);
    }


}