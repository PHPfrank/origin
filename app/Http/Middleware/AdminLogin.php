<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:45
 */
namespace App\Http\Middleware;

use Closure;
use Cookie;
use Redirect;
use Illuminate\Contracts\Routing\Middleware;

/**
 * 检查后台用户登陆中间件
 */
class AdminLogin
{

    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 取得用户的Cookie
        $token = Cookie::get("token");
        // 如果有Cookie
        if(isset($token)) {
            // 将cookie值转为json对象数组
            $user = json_decode($token);
            // 往下执行
            if(!$this->checkResource($user)){
                return redirect()->action("Admin\AdminController@forbidden");
                //return dd(Redirect::route('admin.forbidden'));
            }
            return $next($request);
        }
        else {
            // 如果取不到用户的cookie，跳转到用户登陆页面
            return Redirect::action("PublicController@loginPage", ["path" => $request->fullUrl()]);
        }
    }

    public function checkResource($user){
        return true;
    }
}