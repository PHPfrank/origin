<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AdminUser.
 *
 * @package namespace App\Models;
 */
class AdminUser extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected $table = 'admin_user';

    protected $primaryKey = 'auth_id';

    /**
     * 定义用户与组的关系
     */
    public function userGroup()
    {
        return $this->belongsTo("App\Models\AdminGroup","group_id","group_id");
    }

    /**
     * 获取后台用户信息
     */
    public function loginAdminInfo($userName,$pwd)
    {
        return $this->whereRaw("auth_name = ? and auth_pwd = md5(concat(?,pwd_code))",array($userName,$pwd))->first();
    }

    /**
     * 通过用户ID获取用户信息
     * @return AdminUser
     */
    public static function getAdminInfo($auth_id)
    {
        return self::where(['auth_id'=>$auth_id])->first();
    }

    /**
     * 添加用户
     */
    public function addOrUpdateUser($data)
    {
        if(isset($data['auth_pwd']) && $data['auth_pwd']) {
            $this->pwd_code = rand(1000,9999);
            $this->auth_pwd = md5($data['auth_pwd'].$this->pwd_code);
            unset($data['auth_pwd']);
        }

        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
        return $this->save();
    }

    /**
     * 删除用户操作
     */
    public function deleteUser($auth_id)
    {
        return $this->where(['auth_id'=>$auth_id])->delete();
    }
}
