<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:43
 */

namespace App\Repositories\Traits;


trait MenuBelongsToManyTrait
{
    public function menus(){

        return $this->belongsToMany('App\Models\Menu');
    }
}