<?php
/**
 * 用户类服务层
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:53
 */

namespace App\Services;

use App\Repositories\Eloquent\UsersRepositoryEloquent;

class User
{
    protected $users;

    public function __construct(UsersRepositoryEloquent $repository)
    {
        $this->users = $repository;
    }


    public function getUsers(array $data){

        $field = ['id','user_id','nickname','vest','vest_price'];
        if(!empty($data['user_id'])){
            $result['users'] = $this->users->findByField("user_id",$data['user_id'],$field);
        }else{
            $result['users'] = $this->users->scopeQuery(function($query){
                return $query->orderBy('vest_price','desc')->where(['vest'=>1]);
            })->all($field);
        }

        return $result;

    }
}