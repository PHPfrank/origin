<?php
/**
* 	配置账号信息(微信公众号支付)
*/

class WxPayConfig
{
//	//appId (研品社)
//	const APPID = 'wx2ce2f945cd54b817';
//	//应用秘钥（AppSecret）
//	const APPSECRET = 'c77de6185a0633c5275fdcdc96bc3868';
//	//商户号
//	const MCHID = '1503669511';
//	//api秘钥（ApiSecret）
//	const KEY = 'dq3pld09639rlb51ov8o2hhtlahij9rc';

    //appId （侍库）
    const APPID = 'wx6feafcfd6fb79af9';
    //应用秘钥（AppSecret）
    const APPSECRET = '491e1cd485043f4d44071a6161a4e727';
    //商户号
    const MCHID = '1393408602';
    //api秘钥（ApiSecret）
    const KEY = 'f284686a6c8c46b43da1aaa8a4a8e04e';


	const SSLCERT_PATH = '../cert/apiclient_cert.pem';
	const SSLKEY_PATH = '../cert/apiclient_key.pem';
	//=======【curl代理设置】===================================
	const CURL_PROXY_HOST = "0.0.0.0";
	const CURL_PROXY_PORT = 0;
	//=======【上报信息配置】===================================
	const REPORT_LEVENL = 1;
}
