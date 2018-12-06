<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminGroup.
 *
 * @package namespace App\Models;
 */
class AdminGroup extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = 'admin_group';

    protected $primaryKey = 'group_id';

    /**
     * 定义用户与组的关系
     */
    public function hasUser()
    {
        return $this->hasMany("App\Models\AdminUser","group_id","group_id");
    }

    /**
     * 获取用户群组单例
     */
    public static function groupInfo($group_id)
    {
        return self::where(["group_id"=>$group_id])->first();
    }

    /**
     * 更新或者添加
     */
    public function addOrUpdateGroupInfo($data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
        return $this->save();
    }

    /**
     * 删除群组
     */
    public function deleteGroup($group_id)
    {
        return $this->where(['group_id'=>$group_id])->delete();
    }

}
