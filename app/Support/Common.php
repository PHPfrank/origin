<?php
/**
 * 通用函数类
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/3
 * Time: 10:53
 */

namespace App\Support;

class Common
{
    /**
     * 上传文件（图片）
     * @param string $file
     * @return string
     */
    public static function upload($file="")
    {
        $data  = array(
            'file' => curl_file_create(realpath($file['tmp_name']),$file['type'],$file['name'])
        );

        $url  = config("common.pic_url");
        $header[] = "channel".":".config('common.pic_channel');

        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (curl_errno($ch)) {
            return "";
        }
        $return_data = json_decode(curl_exec($ch), true);

        curl_close($ch);

        if (isset($return_data['items'])) {

            if (count($return_data['items'])) {

                return $return_data['items'][0];
            }
        }
        return "";
    }
    /**
     * 短信验证码
     * @param $url
     * @param array $params
     * @return mixed
     */
    public static function curl_sms($url,$params=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    /**
     * 生存唯一用户uuid
     * @return bool|string
     */
    public static function getUid()
    {
        if (function_exists('com_create_guid')) {
            $uuid = com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);// "}"
        }
        return substr($uuid, 1, -1);
    }

    /**
     * 生成唯一订单号
     * @param $uid下单用户ID
     * @return string
     */
    public static function makePaySn($uid)
    {
        return mt_rand(100, 999)
        . sprintf('%010d', time() - 946656000)
        . sprintf('%03d', (float)microtime() * 1000)
        . sprintf('%03d', (int)$uid % 1000);
    }

    /**
     * 格式化金额
     * @param $str
     * @param int $ws
     * @return string
     */
    public static function getRealamount($str, $ws = 2)
    {
        return sprintf("%.{$ws}f", round($str, $ws));
    }

    /**
     * 根据经纬度获取距离
     * @param $lng1
     * @param $lat1
     * @param $lng2
     * @param $lat2
     * @return float
     */
    static public function GetInstance($lng1, $lat1, $lng2, $lat2){
        // 将角度转为狐度
        $radLat1 = deg2rad((float)$lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad((float)$lat2);
        $radLng1 = deg2rad((float)$lng1);
        $radLng2 = deg2rad((float)$lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137 * 1000;
        $res = round($s/1000,3);
        return $res;
    }

    /**
     * 数组根据某字段排序
     * @param $array
     * @param $field
     * @param bool $desc
     * @return array
     */
    static public function sortArrByOneField(&$array, $field, $desc = false)
    {
        $array    = self::object2array($array);
        $fieldArr = [];
        foreach ($array as $k => $v) {
            $fieldArr[$k] = $v[$field];
        }
        $sort = $desc == false ? SORT_ASC : SORT_DESC;
        array_multisort($fieldArr, $sort, $array);
        return $array;
    }

    /**
     * 对象转数组
     * @param $object
     * @return array
     */
    static public function object2array($object)
    {
        $array = [];
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        } else {
            $array = $object;
        }
        return $array;
    }

    /**
     * 微信curl请求
     * @param $url
     * @return mixed
     */
    public static function httpGet($url) {
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

    /**生成短连接
     * @param $url
     * @return string
     */
    public static function dwz($url)
    {
//        $long_url = "http://suo.im/api.php?url=".$url;
//        return self::httpGet($long_url);
        define('SINA_APPKEY', '1681459862');
        $url = 'http://api.t.sina.com.cn/short_url/shorten.json?source=' . SINA_APPKEY . '&url_long=' . $url;
        //获取请求结果
        $result = self::httpGet($url);
        //下面这行注释用于调试，
        //print_r($result);exit();
        //解析json
        $json = json_decode($result);
        //异常情况返回false
        if (isset($json->error) || !isset($json[0]->url_short) || $json[0]->url_short == '')
            return false;
        else
            return $json[0]->url_short;
    }
//        $url = "http://jump.sinaapp.com/api.php?url_long=" . $url;
//
//        $res = json_decode(self::httpGet($url),true);
//        return $res['url_short'];
//    }

    /**
     * 获取客户端IP地址
     */
    public static function getIPaddress()
    {
        $IPaddress='';
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $IPaddress = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
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
     * 标准curl请求（微信）
     * @param $url
     * @param array $post
     * @param string $cookie
     * @param int $returnCookie
     * @return mixed
     */
    public static function curl_request($url,$post=[],$cookie='', $returnCookie=0){
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
     * 模拟post进行url请求(优先)
     * @param string $url
     * @param string $param
     */
     public static function  request_post($url, $method, $postfields = NULL) {
         $ci = curl_init();
         /* Curl settings */
         $headers = array('Content-Type'=>'application/x-www-form-urlencoded');
         curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
         curl_setopt($ci, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
         curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
         curl_setopt($ci, CURLOPT_TIMEOUT, 30);
         curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
         curl_setopt($ci, CURLOPT_ENCODING, "");
         curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 2);
         curl_setopt($ci, CURLOPT_HEADER, FALSE);
         //curl_setopt($ci,CURLOPT_COOKIE,'X-User-Token=PrOY0ypaWnaq3z7TtZ56EZWsoYmyRyGy');
         //curl_setopt($ci,CURLOPT_COOKIE,'PHPSESSID=5cj5djrts40ca8unvtq68hpack; _ga=GA1.2.1756271746.1544753964; _gid=GA1.2.1001883130.1544753964; ANGSESSID=24o7hdrerk55tp9ac6febq7780');
         switch ($method) {
             case 'POST':
                 curl_setopt($ci, CURLOPT_POST, TRUE);
                 if (!empty($postfields)) {
                     curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                 }
                 break;
         }

         curl_setopt($ci, CURLOPT_URL, $url);
         curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);

         $response = curl_exec($ci);
         $httpCode = curl_getinfo($ci, CURLINFO_HTTP_CODE);
         $httpInfo = curl_getinfo($ci);

         curl_close($ci);
         return $response;
    }

    /**
     * 获取数组中最近的时间
     * @param array $data
     */
    public static function getLastTime(array $data)
    {
        $near = array_reduce($data, function($a, $b){
            return abs((time() - strtotime($a))) < abs((time() - strtotime($b))) ? $a : $b;
        });

        echo $near;


    }

    /**
     * 获取网站中的所有图片
     * @param $url :url链接;
     * @param null $target_dir :目录
     */
    public function downImageFromUrl($url, $target_dir = null)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            return false;
        }
        if(!$target_dir) {
            $target_dir = './download';
        }

        $root_url = pathinfo($url);

        $html = file_get_contents($url);            //主要
        preg_match_all('/<img[^>]*src="([^"]*)"[^>]*>/i',$html, $matchs);   //主要

        $images = $matchs[1];

        foreach ($images as $img) {
            $img_url = parse_url($img);
            if(! array_key_exists('host', $img_url)) {
                $img_url = $root_url['dirname'] . DIRECTORY_SEPARATOR . $img;
            } else {
                $img_url = $img;
            }

            $img_path = array_key_exists('path', $img_url) ? $img_url['path'] : $img;
            $save = $target_dir . DIRECTORY_SEPARATOR . $img_path;
            $save_path = pathinfo($save);

            if(!is_dir($save_path['dirname'])) {
                mkdir($save_path['dirname'], 0777, true);
            }

            file_put_contents($save,file_get_contents($img_url));   //主要
        }
        return true;
    }

    /**
     * 拆分数组
     * @param $list
     * @param $num
     * @return array
     */
    public static function chunk($list, $num)
    {
        $temp = [];
        //判断数组
        if (!is_array($list)) {
            return false;
        }
        //判断数量是否小于列数   小于 直接返回第一列
        if (count($list) < $num) {
            return $temp[] = $list;
        }
        //向上取整
        $argv = ceil(count($list) / $num);
        //循环切片
        for ($i = 1; $i <= $num; $i++) {
            $temp[$i] = array_slice($list, $argv * ($i - 1), $argv);
        }
        return $temp;
    }

    /**
     * 梯度式算法
     * @param $useNum,用户使用的数值
     * @return $price,费用的计算结果
     */
    public static function calculate($useNum)
    {
        if ($useNum < 1) {
            return 0;
        }
        // 价格及其范围的配置定义 | 此梯度可抽出来独立配置
        $degrees = [10, 20, 50, 100, 300];
        $prices  = [1, 1.2, 1.4, 1.8, 2.4, 5];

        // 判断是否达到最贵的价格梯度并计算其价格
        $beyondNum = $useNum - end($degrees);
        $price     = ($beyondNum >= 0 ? $beyondNum : 0) * end($prices);

        // 上一层价格峰值
        $prePeak = 0;
        foreach ($degrees as $key => $value) {
            if ($useNum <= $value) {
                $price += ($useNum - $prePeak) * $prices[$key];
                break;
            }
            $price   += ($value - $prePeak) * $prices[$key];
            $prePeak = $value;
        }
        unset($degrees, $prices, $beyondNum, $prePeak);

        return $price;
    }


}