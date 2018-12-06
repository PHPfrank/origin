<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 15:16
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminRule;


/**
 * 后台菜單管理
 * @author cjf
 */
class MenuController extends Controller
{

    /**
     * 后台菜單管理(页面)
     */
    public function Welcome(Request $request)
    {
        $this->getMemuData();
        $this->data['sider'] ='menuManage';
        return view('admin.menu.welcome',$this->data);
    }

    /**
     * 获取菜单详情(页面)
     */

    public function menuList(){
        $menu =AdminRule::getMenu();
        return $this->ajaxJson($menu);
    }

    /**
     * 添加菜单(页面)
     */

    public function add(Request $request){
        $id =$request->input('id','');
        $this->data['menu']=[];
        $this->data['info']=[];
        $this->data['level']=1;
        if($id!=0){
            $menu =AdminRule::select('id','name','title','level')->where(['id'=>$id])->first()->toArray();
            $this->data['menu'] =$menu;
            $this->data['level'] =$menu['level']==1?2:3;
        }
        return view('admin.menu.add',$this->data);
    }

    /**
     * 添加菜单(页面)
     */
    public function addmenu(Request $request){
        $data=[
            'title'=>$request->input('title'),
            'name'=>$request->input('name'),
            'status'=>$request->input('status'),
            'sort'=>$request->input('sort'),
            'pid'=>$request->input('pid')?$request->input('pid'):0,
            'level'=>$request->input('level'),
            'create_time'=>time()
        ];
        $id =$request->input('id','');
        if(!$id){
            AdminRule::insertGetId($data);
        }else{
            AdminRule::where(['id'=>$id])->update($data);
        }
        return $this->ajaxJson(['status'=>0]);
    }

    /**
     * 添加菜单(页面)
     */

    public function edit(Request $request){
        $id =$request->input('id','');
        $this->data['menu']=[];
        $this->data['info']=[];
        if($id!=0){
            $info=AdminRule::select('id','name','title','sort','status','level','pid')->where(['id'=>$id])->first()->toArray();
            $this->data['info'] = $info;
            $this->data['menu'] =$info['pid']>0?AdminRule::select('id','name','title')->where(['id'=>$info['pid']])->first()->toArray():[];
        }
        return view('admin.menu.add',$this->data);
    }

    /**
     * 删除菜单(页面)
     */
    public function del(Request $request){
        $id =$request->input('id','');
        if(AdminRule::where(['pid'=>$id])->first()){
            return $this->errorJson(-1004);
        }
        AdminRule::where(['id'=>$id])->delete();
        return $this->ajaxJson(['status'=>0]);
    }
}