<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminRule.
 *
 * @package namespace App\Models;
 */
class AdminRule extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = 'admin_rule';

    /**
     * 通过规则ID获取规则信息
     * @param string $rule
     */
    public function getDataByRule($rules)
    {
        $where=[];
        if($rules!='all'){
            $arrayRules = explode(",", $rules);
            $where=function($query)use($arrayRules){
                $query->whereIn('id',$arrayRules);
            };
        }

        return $this->where($where)->where('status','=',0)->where('level','<=',2)->orderBy('sort','asc')->get();
    }

    /**
     * 通过规则ID获取规则信息
     * @param string $rule
     */
    public function getDataAllByRule($rules)
    {
        $where=[];
        if($rules!='all'){
            $arrayRules = explode(",", $rules);
            $where=function($query)use($arrayRules){
                $query->whereIn('id',$arrayRules);
            };
        }

        return $this->where($where)->where('status','=',0)->orderBy('sort','asc')->get();
    }

    /**
     * 獲取菜單的所有信息
     * @param string $rule
     */

    public static function getMenu(){
        $menu =self::where(['level'=>1])->orderBy('sort','asc')->get();
        $child =self::where(['level'=>2])->orderBy('sort','asc')->get();
        $schild =self::where(['level'=>3])->orderBy('sort','asc')->get();
        if($menu->toArray()){
            $menu =  $menu->toArray();
        }
        if($child->toArray()){
            $child =  $child->toArray();
        }
        if($schild->toArray()){
            $schild =  $schild->toArray();
        }

        foreach($menu as $k=>$val){
            foreach($child as $j=>$item){
                if($val['id'] ==$item['pid']){
                    $menu[$k]['child'][]=$item;
                }
            }
        }
        foreach($menu as $k=>$val){
            if(isset($val['child'])){
                foreach($val['child'] as $i=>$item){
                    foreach($schild as $j=>$u){
                        if($item['id']==$u['pid']){
                            $menu[$k]['child'][$i]['schild'][]=$u;
                        }
                    }
                }
            }
        }
        return $menu;
    }

}
