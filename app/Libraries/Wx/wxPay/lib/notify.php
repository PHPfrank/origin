<?php
ini_set('date.timezone', 'Asia/Shanghai');
error_reporting(E_ERROR);

require_once "WxPay.Api.php";
require_once 'WxPay.Notify.php';
require_once 'log.php';

//初始化日志
// $logHandler = new CLogFileHandler("../logs/" . date('Y-m-d') . '.log');
// $log = WXLog::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify {
    //查询订单
    public function Queryorder($transaction_id, $step) {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        //WXLog::DEBUG("---step" . $step . ":(查询订单)_____" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS") {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg) {
        if (!array_key_exists("transaction_id", $data)) {
            WXLog::WARN("---step2.1:(输入参数)_____错误");
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"], 2)) {
            WXLog::WARN("---step2.2:(订单真实性)_____错误");
            return false;
        }
        return true;
    }
}
