<?php


namespace RmTop\RmExpress\lib\yt;


class YtParams extends YtConfig
{

    protected $sender;
    protected $receiver;
    protected $logistics;
    protected $Config;
    protected $method;

    public function __construct($configId)
    {
        $this->Config = YtConfig::getConfig($configId);
    }


    /**
     * @return array
     * 输出请求体
     */
    function get_body(): array
    {
       $body['timestamp']  = time();
       $body['param'] = self::getParams($this->logistics);
       $body['sign'] = YtSign::create_sign(self::getParams($this->logistics),$this->method,$this->Config['verison'],$this->Config['key']);
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
     * @param array $logistics
     */
    function create_logistics_interface(array $logistics){
        $this->logistics['clientID'] = $this->Config['clientId'];
        $this->logistics['logisticProviderID'] = "YTO";
        $this->logistics['customerId'] = $this->Config['clientId'];;
        $this->logistics['txLogisticID'] = $logistics['txLogisticID'];
        $this->logistics['tradeNo'] = $this->Config['clientId'];
        $this->logistics['orderType'] = $logistics['orderType'];
        $this->logistics['serviceType'] = $logistics['serviceType'];
        $this->logistics['flag'] = $logistics['flag'];
        $this->logistics['sendStartTime'] = $logistics['sendStartTime'];
        $this->logistics['sendEndTime'] = $logistics['sendEndTime'];
        $this->logistics['goodsValue'] = $logistics['goodsValue'];
        $this->logistics['totalValue'] = $logistics['totalValue'];
        $this->logistics['agencyFund'] = $logistics['agencyFund'];
        $this->logistics['itemsValue'] = $logistics['itemsValue'];
        $this->logistics['itemsWeight'] = $logistics['itemsWeight'];
        $this->logistics['itemName'] = $logistics['itemName'];
        $this->logistics['number'] = $logistics['number'];
        $this->logistics['itemValue'] =$logistics['itemValue'];
        $this->logistics['special'] = $logistics['special'];
        $this->logistics['remark'] = $logistics['remark'];
        $this->logistics['sender'] = $this->sender;
        $this->logistics['receiver'] =$this->receiver;
    }



    /**
     * 设置用户发货地址
     */
    function create_sender(array $sender)
    {
        $this->sender['name']= $sender['name'];
        $this->sender['postCode']=$sender['postCode'];
        $this->sender['phone']= $sender['phone'];
        $this->sender['mobile']= $sender['mobile'];
        $this->sender['prov']= $sender['prov'];
        $this->sender['city']= $sender['city'];
        $this->sender['address']= $sender['address'];
    }


    /**
     * 设置用户收货地址
     */
    function create_receiver(array $receiver){
        $this->receiver['name'] = $receiver['name'];
        $this->receiver['postCode'] = $receiver['postCode'];
        $this->receiver['phone'] = $receiver['phone'];
        $this->receiver['mobile'] = $receiver['mobile'];
        $this->receiver['prov'] = $receiver['prov'];
        $this->receiver['city'] = $receiver['city'];
        $this->receiver['address'] = $receiver['address'];
    }



    /**
     * 生成请求地址
     * @param string $Url
     * @return string
     */
    function getApiUrl(string $Url): string
    {
       return "";
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