<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:49
 */
namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Contracts\Routing\Middleware;
use App\Models\AdminUser;
use App\Models\AdminRule;
use Illuminate\Http\Request;
/**
 * 检查后台用户登陆中间件
 */
class AdminApi
{
    //后台用户信息
    protected $adminUser = null;

    //规则信息
    protected $rulesInfo = null;

    protected $request = '';
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->request =$request;
        // 取得用户的Cookie
        $token = Cookie::get("token");
        // 如果有Cookie
        if(!isset($token)) {
            return redirect('/admin');
        }
        // 将cookie值转为json对象数组
        $user = json_decode($token);
        // 往下执行
        if(!$this->checkResource($user)){
            return response(['code'=>403,'msg'=>'没有权限']);
            //return dd(Redirect::route('admin.forbidden'));
        }
        return $next($request);
    }

    public function checkResource($user){
        $this->adminUser = AdminUser::getAdminInfo($user->auth_id);
        if($this->adminUser->group_id!=0){
            $groupInfo = $this->adminUser->userGroup()->first();
        }else{
            return true;
            $groupInfo =(object)['rules'=>'all'];
        }
        $adminRule = new AdminRule();
        $this->rulesInfo = $adminRule->getDataAllByRule($groupInfo->rules);
        $resource =[];
        foreach($this->rulesInfo as $k=>$val){
            $resource[]='admin/'.$val->name;
        }//var_dump($resource);exit;
        $path =$this->getPath();
        if(strpos($path,'api')){
            if(in_array($path,$resource)){
                return true;
            }
            return false;
        }
        return true;
    }

    public function getPath(){
        $path =$this->request->segments();
        return implode('/',$path);
    }
}