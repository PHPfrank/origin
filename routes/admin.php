<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 14:43
 */

Route::any('/', [
    "uses" => "PublicController@loginPage"
]);

//登录页面
Route::get('/login',[
    "uses" => "PublicController@loginPage"
])->name('for_login');

//权限提示
Route::get('/forbidden',[
    "uses" => "AdminController@forbidden"
]);

//登录操作
Route::any('/do_login',[
    "uses" => "PublicController@do_login"
]);

$router->group(['middleware' => 'AdminLogin'], function ($router) {

    //首页
    $router->any('/upload',[
        "uses" => "PublicController@upload"
    ]);

    //首页
    $router->any('/home',[
        "uses" => "AdminController@homePage"
    ]);
    //退出登录
    $router->any('/login_out',[
        "uses" => "PublicController@LoginOut"
    ]);

    //修改密码
    $router->any('/edit_pwd',[
        "uses" => "AuthController@edit_pwd"
    ]);

    //后台用户管理
    $router->any('/authManage',[
        "uses" => "AuthController@authPage"
    ]);

    //后台用户添加与编辑页面
    $router->any('/authAdd',[
        "uses" => "AuthController@authEditPage"
    ]);

    //后台用户编辑操作
    $router->any('/api/do_authedit',[
        "uses" => "AuthController@do_authEdit"
    ]);

    //后台用户删除操作
    $router->any('/api/do_authDel',[
        "uses" => "AuthController@do_authDel"
    ]);

    //群组管理
    $router->any('/groupManage',[
        "uses" => "GroupController@groupPage"
    ]);

    //群组用户列表
    $router->any('/groupUser',[
        "uses" => "GroupController@userList"
    ]);

    //群组分配权限
    $router->any('/assignRule',[
        "uses" => "GroupController@assignRulePage"
    ]);

    //群组添加或者修改权限
    $router->any('/api/do_assignrule',[
        "uses" => "GroupController@do_assignRule"
    ]);

    //删除群组
    $router->any('/api/do_groupDel',[
        "uses" => "GroupController@do_groupDel"
    ]);

    //菜單管理
    $router->any('/menuManage',[
        "uses" => "MenuController@Welcome"
    ]);
    //菜單管理
    $router->any('/menu_list',[
        "uses" => "MenuController@menuList"
    ]);
    //添加管理
    $router->any('/menu_add',[
        "uses" => "MenuController@add"
    ]);

    //修改菜单
    $router->any('/menu_edit',[
        "uses" => "MenuController@edit"
    ]);
    //修改菜单
    $router->any('/api/delmenu',[
        "uses" => "MenuController@del"
    ]);

    //菜單管理
    $router->any('/api/addmenu',[
        "uses" => "MenuController@addmenu"
    ]);

    //基础用户信息
    $router->any('/base_user',[
        "uses" => "UserInfoController@BaseUser"
    ]);

});