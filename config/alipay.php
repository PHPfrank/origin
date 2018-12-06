<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/4
 * Time: 16:43
 */
return [
    //应用ID,您的APPID。
    "app_id"                    => env("ALIPAY_APP_ID", ""),
    //商户私钥，您的原始格式RSA私钥
    "merchant_private_key"      => env("ALIPAY_MERCHANT_PRIVATE_KEY", ""),
    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    "alipay_public_key"         => env("ALIPAY_PUBLIC_KEY", ""),
    //异步通知地址
    "notice_url"    => env("APP_URL","")."/v1/pay/alipay_notify_url",
    //同步跳转
    "return_url"    => env("APP_URL","")."/v1/pay/alipay_return",
    //编码格式
    "charset"       => "UTF-8",
    //签名方式
    "sign_type"     => "RSA2",
    //支付宝网关
    "gatewayUrl"    => "https://openapi.alipay.com/gateway.do",
];