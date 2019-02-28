<?php
/**
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/4
 * Time: 16:54
 */
namespace App\Support;
use App\Libraries\Union;
use Illuminate\Support\Facades\Redis;

class WxCommon
{
    //微信
    private $appId;
    private $appSecret;
    //小程序
    private $xcx_appId;
    private $xcx_appSecret;

    //初始化配置
    public function __construct() {
        $this->appId = config('app.wx.appId');
        $this->appSecret = config('app.wx.appSecret');
        $this->xcx_appId = config('app.xcx_appId');
        $this->xcx_appSecret = config('app.xcx_appSecret');
    }

    /**
     * 获取小程序union_id
     * @param array $data
     * @return array|mixed
     */
    public function getUnionId(array $data)
    {
        //如果开发者拥有多个移动应用、网站应用、和公众帐号（包括小程序），可通过unionid来区分用户的唯一性.
        //因为只要是同一个微信开放平台帐号下的移动应用、网站应用和公众帐号（包括小程序），用户的unionid是唯一的。
        //换句话说，同一用户，对同一个微信开放平台下的不同应用，unionid是相同的。
        $encryptedData = rawurldecode(urldecode($data['enc']));
        $iv = rawurldecode(urldecode($data['iv']));
        $url = "https://api.weixin.qq.com/sns/jscode2session?grant_type=authorization_code&appid=".$this->xcx_appId."&secret=".$this->xcx_appSecret."&js_code=" . $data['js_code'];
        $res = json_decode($this->httpGet($url), true);
        if($res){
            $sessionKey = $res['session_key'];
            if(!empty($sessionKey)){
                $pc = new Union\WXBizDataCrypt($this->xcx_appId,$sessionKey);
                $errCode = $pc->decryptData($encryptedData, $iv, $info);
                if ($errCode == 0) {
                    $result = $info;
                } else {
                    //返回错误码信息
                    $result = $errCode;
                }
            }else {
                //返回res结果
                $result = $res;
            }
        }else{
            //返回传入的参数（调试bug）
            $result = $data;
        }
        return $result;
    }

    /**
     * 微信签名
     * @param array $data
     * @return array
     */
    public function getSignPackage(array $data) {
        $jsapiTicket = $this->getJsApiTicket();

        if (empty($data["url"])){
            // 注意 URL 一定要动态获取，不能 hardcode.
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        }else{
            $url = $data["url"];
        }

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    /**
     * 获取小程序签名
     * @param array $data
     * @return mixed
     */
    public function getXcxSign(array $data)
    {
        $js_code = $data['js_code'];
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->xcx_appId."&secret=".$this->xcx_appSecret."&js_code=".$js_code."&grant_type=authorization_code";
        //获取签名
        $result = $this->httpGet($url);
        return $result;
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 获取微信jsTicket
     * @return mixed
     */
    private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        //$data = json_decode($this->get_php_file("jsapi_ticket.php"));
        $time = Redis::get('wx_ticket_time');
        if ($time < time()) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                //redis缓存
                Redis::set('wx_ticket',$ticket);
                Redis::set('wx_ticket_time',time() + 7000);
            }
        } else {
            $ticket = Redis::get('wx_ticket');
        }

        return $ticket;
    }

    /**
     * 微信access_token（redis缓存）
     * @return mixed
     */
    private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $time = Redis::get('wx_token_time');
        if ($time < time()) {
            // 如果是企业号用以下URL获取access_token
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                //redis缓存
                Redis::set('wx_token',$access_token);
                Redis::set('wx_token_time',time() + 7000);
            }
        } else {
            $access_token = Redis::get('wx_token');
        }
        return $access_token;
    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }

    /**
     * 获取微信授权
     * @param array $data
     * @return mixed
     */
    public function getWxAuth(array $data)
    {
        //第一步：通过code换取网页授权access_token
        $au_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appSecret."&code=".$data['code']."&grant_type=authorization_code";
        $auth = json_decode($this->httpGet($au_url),true);
        //拉取用户信息(需scope为 snsapi_userinfo)
        if($auth['scope'] == "snsapi_userinfo"){
            $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$auth['access_token']."&openid=".$auth['openid']."&lang=zh_CN";
            $info = json_decode($this->httpGet($info_url),true);
        }
        //数据返回
        $result = isset($info) ? $info : $auth;
        return $result;
    }

    /**
     * 获取小程序access_token（redis缓存）
     * @param array $data
     * @return mixed
     */
    public function getXcxAccessToken(array $data)
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        if(!empty($data['event'])){
            $obj = 'event';
        }else{
            $obj = 'xcx';
        }
        $time = Redis::get($obj.'_token_time');
        if ($time < time()) {
            // 如果是企业号用以下URL获取access_token
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$data['appId']."&secret=".$data['appSecret'];
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                //redis缓存
                Redis::set($obj.'_token',$access_token);
                Redis::set($obj.'_token_time',time() + 7000);
            }
        } else {
            $access_token = Redis::get($obj.'_token');
        }
        return $access_token;
    }

    /**
     * curl请求（json）
     * @param $url
     * @param $data
     * @param $type
     * @return int|mixed
     */
    public function https_curl_json($url,$data,$type){
        if($type=='json'){
            $headers = array("Content-type: application/json;charset=UTF-8","Accept: application/json","Cache-Control: no-cache", "Pragma: no-cache");
            $data=json_encode($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($curl);
        if (curl_errno($curl)) {
            return -1015;
        }
        curl_close($curl);
        return $output;
    }

    /**
     * 小程序发送推送
     * @param array $data（）
     * @return mixed
     */
    public function sendMsg(array $data){
        //推送内容
        $post = [
            'touser' => $data['touser'], //目标
            'template_id' => $data['template_id'], //(消息的模板ID)
            'page'=> $data['page'] ? $data['page'] : '/pages/home/home',//(推送的跳转链接)
            'form_id' => $data['form_id'],//form_id(点击事件或者支付行为获取)
            'data' => $data['data'], //内容
        ];
        //拿到小程序access_token(多个小程序则用参数区分)
        $token = $this->getXcxAccessToken($data);
        $url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=";
        return self::curl_request($url.$token,$post);
    }


    //参数1：访问的URL，参数2：post数据(不填则为GET)，参数3：提交的$cookies,参数4：是否返回$cookies
    /**
     * 微信标准curl
     * @param $url
     * @param string $post
     * @param string $cookie
     * @param int $returnCookie
     * @return mixed
     */
    public static function curl_request($url,$post='',$cookie='', $returnCookie=0){
        $headers =[];
        $header = array('Content-Type'=>'application/x-www-form-urlencoded');
        foreach ($header as $key => $value) {
            $headers[] = $key . ":" . $value;
        }
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
//        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if($post) {
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        }
        if($cookie) {
            curl_setopt($curl, CURLOPT_COOKIE, $cookie);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);

        //https请求 不验证证书和host
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if($returnCookie){
            list($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie']  = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        }else{
            return $data;
        }
    }

    /**
     * 发送小程序模板消息
     * @param array $data（模板类型，keywords）
     * @return array
     */
    public function create_pranked_data(array $data){

        //选择模板类型
        switch($data['type']){
            //支付成功（拼团中，待分享）
            case 1:
                $res = [
                    'keyword1'=>['value'=>$data['keyword1']],
                    'keyword2'=>['value'=>$data['keyword2']],
                    'keyword3'=>['value'=>$data['keyword3']],
                    'keyword4'=>['value'=>$data['keyword4']],
                ];
                break;
            //待使用（拼团成功）
            case 2:
                $res = [
                    'keyword1'=>['value'=>$data['keyword1']],
                    'keyword2'=>['value'=>$data['keyword2']],
                    'keyword3'=>['value'=>$data['keyword3']],
                ];
                break;
            //拼团倒计时提醒
            case 3:
                $res = [
                    'keyword1'=>['value'=>$data['keyword1']],
                    'keyword2'=>['value'=>$data['keyword2']],
                    'keyword3'=>['value'=>$data['keyword3']],
                    'keyword4'=>['value'=>$data['keyword4']],
                ];
                break;
            //提醒付款
            case 4:
                $res = [
                    'keyword1'=>['value'=>$data['keyword1']],
                    'keyword2'=>['value'=>$data['keyword2']],
                    'keyword3'=>['value'=>$data['keyword3']],
                    'keyword4'=>['value'=>$data['keyword4']],
                ];
                break;
            //提醒消费
            case 5:
                $res = [
                    'keyword1'=>['value'=>$data['keyword1']],
                    'keyword2'=>['value'=>$data['keyword2']],
                    'keyword3'=>['value'=>$data['keyword3']],
                    'keyword4'=>['value'=>$data['keyword4']],
                ];
                break;
            default:
                $res = [
                    'keyword1'=>['value'=>'火拼'],
                    'keyword2'=>['value'=>'春风十里'],
                    'keyword3'=>['value'=>'拼点好的'],
                    'keyword4'=>['value'=>'2018-10-10'],
                ];
                break;
        }
//        $data['page'] = 'pages/myCheat/myCheat?from=msg';
//        $data['big_keyword'] = 1;
        return $res;
    }

}