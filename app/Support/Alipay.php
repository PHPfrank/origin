<?php
/**
 * 支付宝支付辅助类
 * Created by PhpStorm.
 * User: frank
 * Date: 2018/12/4
 * Time: 16:39
 */
namespace App\Support;

class AliPay
{
    /**
     * 单笔转账到支付宝账户（提现）
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public static function fundTransToaccountTransfer(array $data){

        $base_path = app_path("Libraries/Alipay/aop");

        require_once($base_path . "/AopClient.php");

        $aop = new \AopClient();
        $aop->gatewayUrl            = config("alipay.gatewayUrl");
        $aop->appId                 = config("alipay.app_id");
        $aop->rsaPrivateKey         = config("alipay.merchant_private_key");
        $aop->alipayrsaPublicKey    = config("alipay.alipay_public_key");
        $aop->apiVersion            = "1.0";
        $aop->signType              = config("alipay.sign_type");
        $aop->postCharset           = config("alipay.charset");
        $aop->format                = "json";

        require_once($base_path . "/request/AlipayFundTransToaccountTransferRequest.php");

        $request = new \AlipayFundTransToaccountTransferRequest();

        $biz_content = array(
            "out_biz_no"        => isset($data["order_no"]) ? $data["order_no"] : "",//商户转账唯一订单号
            "payee_type"        => "ALIPAY_LOGONID",//收款方账户类型
            "payee_account"     => isset($data["account"]) ? trim($data["account"]) : "",//收款方账户
            "amount"            => isset($data["amount"]) ? $data["amount"] : 0,//转账金额
            "payer_show_name"   => isset($data["show_name"]) ? $data["show_name"] : "柠檬盒退款",//付款方姓名
            "payee_real_name"   => isset($data["real_name"]) ? $data["real_name"] : "",//收款方真实姓名
            "remark"            => isset($data["remark"]) ? $data["remark"] : "柠檬盒退款",
        );

        $request->setBizContent(json_encode($biz_content));
        $result = $aop->execute($request);
        $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
        return (array)$result->$responseNode;
    }

    /**
     * 创建支付宝订单（H5支付）
     * @param array $data
     * @return string|\提交表单HTML文本
     * @throws \Exception
     */
    public static function createOrder(array $data)
    {
        $base_path = app_path("Libraries/Alipay/aop");

        require_once($base_path . "/AopClient.php");

        $aop = new \AopClient();
        $aop->gatewayUrl            = config("alipay.gatewayUrl");
        $aop->appId                 = config("alipay.app_id");
        $aop->rsaPrivateKey         = config("alipay.merchant_private_key");
        $aop->alipayrsaPublicKey    = config("alipay.alipay_public_key");
        $aop->apiVersion            = "1.0";
        $aop->signType              = config("alipay.sign_type");
        $aop->postCharset           = config("alipay.charset");
        $aop->format                = "json";

        require_once($base_path . "/request/AlipayTradeWapPayRequest.php");

        $request_pay = new \AlipayTradeWapPayRequest();

        //订单信息组装
        $data_alipay = array(
            'out_trade_no' => $data['order_no'],//我方订单号
            'subject' => '支付会员卡',//商品的标题/交易标题/订单标题/订单关键字等。
            #订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
            'total_amount' => $data['order_amount'],
            'body' => 'rss',//商品描述
            'timeout_express' => '1m',//该笔订单允许的最晚付款时间，逾期将关闭交易。
        );


        $configs = array(
            'NotifyUrl' => env('APP_URL').'/v1/pay/callback',
            'ReturnUrl' => env('APP_URL').'/v1/pay/return_pay',
        );

        $request_pay->setBizContent(json_encode($data_alipay));

        $request_pay->setNotifyUrl($configs['NotifyUrl']);

        $request_pay->setReturnUrl($configs['ReturnUrl']);

        //准备提交支付宝

        $res = $aop->pageExecute($request_pay);

        return $res;
    }

    /**
     * 创建支付宝订单（app支付）
     * @param array $data
     * @return string
     */
    public static function createAppOrder(array $data)
    {
        //引入alipay文件
        $base_path = app_path("Libraries/Alipay/aop");

        require_once($base_path . "/AopClient.php");

        //实例化alipay Aop类
        $aop = new \AopClient();
        $aop->gatewayUrl            = config("alipay.gatewayUrl");
        $aop->appId                 = config("alipay.app_id");
        $aop->rsaPrivateKey         = config("alipay.merchant_private_key");
        $aop->alipayrsaPublicKey    = config("alipay.alipay_public_key");
        $aop->apiVersion            = "1.0";
        $aop->signType              = config("alipay.sign_type");
        $aop->postCharset           = config("alipay.charset");
        $aop->format                = "json";

        require_once($base_path . "/request/AlipayTradeAppPayRequest.php");

        $request_pay = new \AlipayTradeAppPayRequest();

        //订单信息组装
        $data_alipay = array(
            'out_trade_no' => $data['order_no'],//我方订单号
            'subject' => '支付会员卡',//商品的标题/交易标题/订单标题/订单关键字等。
            #订单总金额，单位为元，精确到小数点后两位，取值范围[0.01,100000000]
            'total_amount' => (string)$data['order_amount'],
            'body' => 'rss',//商品描述
            'timeout_express' => '1m',//该笔订单允许的最晚付款时间，逾期将关闭交易。
            'product_code'  => 'QUICK_MSECURITY_PAY',
        );

        $configs = array(
            'NotifyUrl' => env('APP_URL').'/v1/pay/callback',
            'ReturnUrl' => env('APP_URL').'/v1/pay/return_pay',
        );

        $request_pay->setBizContent(json_encode($data_alipay));

        $request_pay->setNotifyUrl($configs['NotifyUrl']);

        //准备提交支付宝

        $res = $aop->sdkExecute($request_pay);

        return $res;
    }

}