<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/27
 * Time: 11:21 下午
 */


namespace RmTop\RmExpress\lib\yt;

use RmTop\RmExpress\lib\TopExpressConfigManage;

/**
 * Class YtOrderCreateParam
 * @package RmTop\RmExpress\lib\yt
 * 散单创建接口参数
 */

class YtOrderCreateParam
{

    protected  $Config;
    protected  $params;
    protected  $method;

    /**
     * @throws \think\db\exception\DbException
     */
    public function __construct($configId)
    {
        $this->Config = TopExpressConfigManage::getConfig($configId);
    }


    /**
     * @return array
     * 输出请求体
     */
    function get_body(): array
    {
        $body['timestamp']  = time();
        $body['param'] = self::getParams($this->params);
        $body['sign'] = YtSign::create_sign(self::getParams($this->params),$this->method,$this->Config['version'],$this->Config['key']);
        $body['format'] = "JSON";
        return $body;
    }


    /**
     * @param string $method
     */
    function create_method(string $method){
        $this->method  = $method;
    }



    /**
     * 设置请求参数
     * @param array $params
     */
    function create_params(array $params){
        $this->params['channelCode'] = $this->Config['clientId'];
        $this->params['logisticsNo'] = $params['logisticsNo'];
        $this->params['remark'] = $params['remark']??"";
        $this->params['gotCode'] = $params['gotCode']??"";
        $this->params['increments'] = $params['increments']??"";
        $this->params['goods'] = $params['goods']??"";
        $this->params['bookingStartTime'] = $params['bookingStartTime']??"";
        $this->params['bookingEndTime'] = $params['bookingEndTime']??"";
        $this->params['settlementType'] = $params['settlementType']??"";
        $this->params['cstBusinessType'] = $params['cstBusinessType']??"";
        $this->params['cstOrderNo'] = $params['cstOrderNo']??"";
        $this->params['weight'] = $params['weight']??"";
    }


    /**
     * 创建发货人
     * @param array $sender
     */
    function create_sender(array $sender){
        $this->params['senderName'] = $sender['senderName'];
        $this->params['senderProvinceName'] = $sender['senderProvinceName'];
        $this->params['senderCityName'] = $sender['senderCityName'];
        $this->params['senderCountyName'] = $sender['senderCountyName'];
        $this->params['senderTownName'] = $sender['senderTownName'];
        $this->params['senderMobile'] = $sender['senderMobile'];
    }


    /**
     * 收货人
     * @param array $receiver
     */
    function create_receiver(array $receiver){
        $this->params['recipientName'] = $receiver['recipientName'];
        $this->params['recipientProvinceName'] = $receiver['recipientProvinceName'];
        $this->params['recipientCityName'] = $receiver['recipientCityName'];
        $this->params['recipientCountyName'] = $receiver['recipientCountyName'];
        $this->params['recipientTownName'] = $receiver['recipientTownName'];
        $this->params['recipientAddress'] = $receiver['recipientAddress'];
        $this->params['recipientMobile'] = $receiver['recipientMobile'];

    }



    /**
     * 订单取消
     * @param $cancelParams
     */
    function create_order_cancel_params($cancelParams){
        $this->params['channelCode'] = $cancelParams['channelCode'];
        $this->params['logisticsNo'] = $cancelParams['logisticsNo'];
        $this->params['cancelDesc'] = $cancelParams['cancelDesc'];
    }



    /**
     * 生成请求地址
     * @param string $Url
     * @return string
     */
    function getApiUrl(string $Url = ""): string
    {
        if(empty($Url)){
            return $this->Config['apiUrl']."/".$this->method."/".$this->Config['version'].'/TIErGi/'.$this->Config['clientId'];
        }else{
            return $Url;
        }
    }


    /**
     * 格式化参数
     * @param $params
     * @return false|string
     */
    static  function getParams($params){
        return  json_encode($params, JSON_UNESCAPED_UNICODE);
    }


}