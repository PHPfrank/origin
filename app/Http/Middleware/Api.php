<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 9:53
 */

namespace App\Http\Middleware;
use Closure;
use Request;

class api
{
    public function handle($request, Closure $next)
    {
        $uri =  substr($request->getRequestUri(),4);

        $url = array("pay/callback","pay/test",'test');//过滤回调路由

        if (Request::getMethod() == "OPTIONS") {
            return response(['code' => 200, 'msg' => '成功','data'=>(object)[]]);
        }

        if (config('api_auth.status') === 'on' && !in_array($uri,$url)) {

            $timestamp      = $request->header('timestamp');//时间戳
            $os             = $request->header('os');//来源
            $signature      = $request->header('signature');//加密签名
            /**
             * 获取 errorJson 函数
             */
            $errorJson = config('api_auth.errorJson');

            if (!is_callable($errorJson)) {

                return self::errorJson(-994,'errorJson is not function !');

            }

            if (empty($timestamp) || empty($access_key) || empty($os) || empty($signature)) {

                return self::errorJson(-999);
            }

            $roles = config('api_auth.roles');

            if (!isset($roles[$os])) {

                return self::errorJson(-998); // 角色不存在

            }

            $encrypting = config('api_auth.encrypting');

            if (!is_callable($encrypting)) {

                return self::errorJson(-994,'encrypting is not function !');
            }

            $rule = config('api_auth.rule');

            if (!is_callable($rule)) {

                return self::errorJson(-994,'rule is not function !');
            }

            $server_signature = call_user_func_array($encrypting, [$roles[$os]['secret_key'], $os, $timestamp]);

            if (!call_user_func_array($rule, [$roles[$os]['secret_key'], $signature, $server_signature])) {

                return self::errorJson(-997);// 签名不一致
            }

            $timeout = config('api_auth.timeout', 60);

            if (time() - $timestamp > $timeout) {

                return self::errorJson(-996); // 签名失效
            }
            //短信这块可以用，或者某些路由可以用
            /*if (!is_null(cache()->pull('api_auth:' . $signature))) {
                return self::errorJson(-995);  // 签名重复(已存在该签名记录)
            } else {
                cache()->put('api_auth:' . $signature, $request->getClientIp(), $timeout / 60);
            }*/
            /**
             * 添加 role_name 到 $request 中
             */
            if ($request->has('client_role')) {
                $request->offsetSet('_client_role', $request->get('client_role'));
            }
            $request->offsetSet('client_role', $roles[$access_key]['name']);
        }

        $header = $request->header();

        $input = $request->input();

        if (isset($header['cookie'])) unset($header['cookie']);

        $data = array(
            "app_version" => $request->header("version"),
            "devices" => $request->header("devices"),
            "uri" => $request->getRequestUri(),
            "method" => $request->method(),
            'header' => json_encode($header,JSON_UNESCAPED_UNICODE),
            'content' => json_encode($input,JSON_UNESCAPED_UNICODE),
            "signature" => $request->header("signature"),
            "timestamp" => $request->header("timestamp"),
        );

        return $next($request);
    }
    /**
     * @param $secret_key
     * @param $signature
     * @param $server_signature
     * @return bool
     */
    public static function rule($secret_key='', $signature, $server_signature)
    {
        return $signature === $server_signature;
    }
    /**
     * @param $secret_key
     * @param $channel
     * @param $timestamp
     * @return string
     */
    public static function encrypting($secret_key, $os, $timestamp)
    {
        $tmpArr = array($secret_key,$timestamp, $os);

        //sort($tmpArr, SORT_STRING);

        $tmpStr = implode( $tmpArr );

        $tmpStr = sha1( $tmpStr );

        return $tmpStr;
    }
    /**
     * 控制层错误返回json消息
     * @param int $type
     * @param string $content
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorJson($type=-1000,$content="",$status=200){

        if ($content === "") $content = new \stdClass();

        $data = array(
            "msg"    =>  isset($type) ? self::_lang($type) : "参数错误",
            "error"  => $type,
            "data"   => $content,
        );

        return response()->json($data,$status,["Content-Type" => "application/json;charset=utf-8"]);
    }

    /**
     * 返回对应错误
     * @param $type
     * @return mixed|string
     */
    private static function _lang($type){
        $lang  = array(
            "-999" => "缺少参数",
            "-998" => "access_key错误",
            "-997" => "签名错误",
            "-996" => "签名失效",
            "-995" => "签名重复",
            "-994" => "服务端错误",
        );
        return isset($lang[$type]) ? $lang[$type] : "未知错误";
    }

}
