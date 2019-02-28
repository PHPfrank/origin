<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;
use App\Repositories\Eloquent\UsersRepositoryEloquent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $header = ["Content-Type"=>"application/json;charset=utf-8"];

    //请求的数据
    protected $requestData;

    protected $users;

    protected $id;

    protected $user_id;

    protected $user;

    public function __construct()
    {
        //取出登陆用户信息
        if ($token = $this->requestHeader("token")){
            if ($this->users = app(UsersRepositoryEloquent::class)->firstWhere(["token" => $token])){

                $this->id = $this->users->id;

                $this->user_id = $this->users->user_id;

                $this->user =  $this->users;
            }
        }
    }
    /**
     * 检查用户是否登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkUser(){

        if (empty($this->id) && $this->id <= 0){
            return $this->wantsJson(-1013);
        }else{
            return $this->user;
        }
    }
    /**
     * 头文件数据
     */
    public function requestHeader($key = null,$default = null)
    {
        return Request::header($key,$default);
    }
    /**
     * 请求数据
     * @param null $key
     * @param null $default
     * @return mixed
     */
    public function requestData($key = null, $default = null)
    {
        return Request::input($key,$default);
    }
    /**
     * 输出
     * @param string $data
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function wantsJson($data = ""){
        if (is_array($data)){
            //返回json数据
            return $this->returnJson($data);
        } elseif ($data == 1){
            //返回操作成功
            return $this->stringJson();
        } else{
            //返回错误信息
            return $this->errorJson($data);
        }
    }
    /**
     * 控制层数据返回json消息
     * @param string $msg
     * @param int $type
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function stringJson($msg = "操作成功",$type = 0,$status = 200){

        $data  = array(
            "msg"   => $msg,
            "error" => $type,
            "data"  => new \stdClass(),
        );

        return response()->json($data,$status,$this->header);
    }
    /**
     * 控制层数据返回json消息
     * @param string $content
     * @param int $type
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function returnJson($content= "",$type = 0,$status =200){

        $content = array_replacement($content);

        if ($content === "") $content = new \stdClass();

        $data = array(
            "msg"   => trans('msg.'.$type),
            "error" => $type,
            "data"  => $content,
        );

        return response()->json($data,$status,$this->header);
    }
    /**
     * 控制层错误返回json消息
     * @param int $type
     * @param string $msg
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorJson($type=-1000,$msg="",$status=200){

        $data = array(
            "msg" => $msg ? $msg : trans('msg.'.$type),
            "error"  => $type,
            "data" => new  \stdClass(),
        );

        return response()->json($data,$status,$this->header);
    }
}
