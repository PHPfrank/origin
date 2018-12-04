<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:43
 */

namespace App\Repositories\Traits;


trait ActionBelongsToManyTrait
{
    public function actions()
    {
        return $this->belongsToMany('App\Models\Action');
    }
}