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
    public function getUsers(Request $request)
    {
        $user = $this->checkUser();
//        //转数组
//        $result = $user->toArray();
        $result['user'] = $user;
        //数据返回
        return $this->wantsJson($result);
    }

}