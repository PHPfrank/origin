<?php
/**
 * 微信支付辅助类
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/4
 * Time: 16:39
 */
namespace App\Support;

use Config;
use Request;

class WxPay
{
    /*
    配置参数
    */
    private $appid;

    private $mch_id;

    private $api_key;

    private $notify_url;

    /**
     * 初始化配置
     */
    public function __construct() {
        $this->appid = env("WX_APP_ID", "");
        $this->mch_id = env("WX_MCH_ID", "");
        $this->api_key = env("WX_API_KEY", "");
        $this->notify_url = env('APP_URL').'/v1/pay/wx_notify';
    }

    /**
     * 统一创建订单
     * @param array $order_info
     * @return string
     */
    public function getPrePayOrder(array $order_info){

        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        //回调地址
        $notify_url = $this->notify_url;

        $onoce_str = $this->createNoncestr();

        $data["appid"] = $this->appid;
        //商品描述
        $data["body"] = $order_info['body'];
        $data["mch_id"] = $this->mch_id;
        $data["nonce_str"] = $onoce_str;
        $data["notify_url"] = $notify_url;
        //商户订单号
        $data["out_trade_no"] = $order_info['out_trade_no'];
        //终端IP
        $data["spbill_create_ip"] = $this->get_client_ip();
        //总金额
        $data["total_fee"] = $order_info['total_fee'] * 100;
        $data["trade_type"] = $order_info['trade_type'];
        $data["scene_info"] = '{"h5_info": {"type":"Wap","wap_url": "https://pay.qq.com","wap_name": "会员充值"}}';
        $sign = $this->getSign($data);
        $data["sign"] = $sign;

        $xml = $this->arrayToXml($data);
        $response = $this->postXmlCurl($xml, $url);

        //将微信返回的结果xml转成数组
        $response = $this->xmlToArray($response);

        if ($response === false) {
            return -1011;
        }
        //app支付（需要二次加密）
        if($order_info['trade_type'] == 'APP')
        {
            if ($response['return_code'] == 'FAIL') {
                return $response['return_msg'];            // 如果微信返回错误码为FAIL，则代表请求失败，返回失败信息；
            } else {
                //如果上一次请求成功，那么我们将返回的数据重新拼装，进行第二次签名
                $resignData = array(
                    'appid'    =>    $response['appid'],
                    'partnerId'    =>    $response['mch_id'],
                    'prepayId'    =>    $response['prepay_id'],
                    'nonceStr'    =>    $response['nonce_str'],
                    'timeStamp'    =>    time(),
                    'package'    =>    'Sign=WXPay'
                );
                //二次签名；
                $sign = $sign = $this->getSign($resignData);
                $resignData['sign'] = $sign;
                return $resignData;
            }
        }else{
            if($order_info['os'] == 'ios'){
                $redirect_url = 'm.travelbaby.cn://?order_id='.$order_info['order_id'];
                $wx_url = $response['mweb_url'].'&redirect_url='.urlencode($redirect_url);
            }else{
                $redirect_url = 'http://m.travelbaby.cn/Nm/callback.html?order_id='.$order_info['order_id'];
                $wx_url = $response['mweb_url'].'&redirect_url='.urlencode($redirect_url);
            }
            return $wx_url;
        }


    }

    /**
     * 生成签名
     * @param $Obj
     * @return string
     */
    public function getSign($Obj){
        foreach ($Obj as $k => $v){
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        $key = $this->api_key;
        $String = $String."&key=".$key;
        //echo "【string2】".$String."</br>";
        //签名步骤三：MD5加密
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        //echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     *  作用：产生随机字符串，不长于32位
     */
    public function createNoncestr( $length = 32 ){
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * array转Xml
     * @param $arr
     * @return string
     */
    public function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    /**
     *  作用：将xml转为array
     */
    public function xmlToArray($xml){
        //将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }
    /**
     *  作用：以post方式提交xml到对应的接口url
     */
    public function postXmlCurl($xml,$url,$second=30){
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        //这里设置代理，如果有的话
        //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        $data = curl_exec($ch);
        //返回结果

        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            curl_close($ch);
            return false;
        }
    }


    /*
    获取当前服务器的真实IP
    */
    public function get_client_ip(){
//REMOTE_ADDR 是你的客户端跟你的服务器“握手”时候的IP。
//如果使用了“匿名代理”，REMOTE_ADDR将显示代理服务器的IP。
//HTTP_CLIENT_IP 是代理服务器发送的HTTP头。
//如果是“超级匿名代理”，则返回none值。同样，REMOTE_ADDR也会被替换为这个代理服务器的IP。
//$_SERVER['REMOTE_ADDR']; //访问端（有可能是用户，有可能是代理的）IP
// $_SERVER['HTTP_CLIENT_IP']; //代理端的（有可能存在，可伪造）
//$_SERVER['HTTP_X_FORWARDED_FOR']; //用户是在哪个IP使用的代理（有可能存在，也可以伪造

        $IPaddress = '';
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $IPaddress = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $IPaddress = getenv("HTTP_CLIENT_IP");
            } else {
                $IPaddress = getenv("REMOTE_ADDR");
            }
        }
        return $IPaddress;
    }


    /**
     *  作用：格式化参数，签名过程需要使用
     */
    public function formatBizQueryParaMap($paraMap, $urlencode){
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v){
            if($urlencode){
                $v = urlencode($v);
            }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar = '';
        if (strlen($buff) > 0){
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }

}