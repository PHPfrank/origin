<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/5
 * Time: 9:38
 */
use App\Http\Middleware\api;

return [
    'status' => 'off', // 状态，on 或者 off

    'roles' => [
        'ios' => [
            'access' => 'fXWGgIN5OKvekMB8lVJq0SuijbLmQ6P3',        // 角色名字，例如 ios
            'secret_key' => 'jMSId72vmmpzb9iIt660tJgoT8TDciX3',
        ],
        'android' => [
            'access' => 'EueDCvzCP2pJrxXWINaoCDwwcM9WT21c',        // 角色名字，例如 android
            'secret_key' => 'ovQcVIao4ciJTpBGISR74I7LXge8u2pt',
        ],
        'h5' => [
            'access' => 'gq6lApjQIONpteLuwVbRf0FKxfq3JpIv',         // 角色名字，例如 h5
            'secret_key' => 'NRCFg67gVdcoVCpw3q9oaut8GZRz5Seu',
        ]
    ],

    'timeout' => 60, // 签名失效时间，单位: 秒

    'encrypting' => [api::class, 'encrypting'], // 自定义签名方法

    'rule' => [api::class, 'rule'], // 判断签名正确的规则，默认是相等

    'errorJson' => [api::class, 'errorJson'], // 签名错误处理方法。
];