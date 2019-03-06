<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//此路由为V1版本接口路由
/**----------------------------公共模块------------------------------------**/
//测试
Route::any('test',['uses' => 'PublicController@test']);
//socket
Route::any('start',['uses' => 'PublicController@startSocket']);
//queue
Route::any('queue',['uses' => 'PublicController@queue']);
//patch
Route::patch('patch',['uses' => 'PublicController@testPatch']);

/**----------------------------END---------------------------------------**/
//我的信息
Route::get('my_info',['uses' => 'UserController@getMyInfo']);
//用户列表
Route::get('user_list',['uses' => 'UserController@getUserList']);