<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/28
 * Time: 1:20 上午
 */


namespace RmTop\RmExpress\lib\yt;


class YtBaseParam
{

    protected  $Config;
    protected  $params;
    protected  $method;


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
        $body['param'] = self::getParams($this->params);
        $body['sign'] = YtSign::create_sign(self::getParams($this->params),$this->method,$this->Config['verison'],$this->Config['key']);
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
     */
    function create_params(){
        $this->params['clientId'] = $this->Config['clientId'];
        $this->params['requestDate'] = date("YMD");
    }


    function charge_params($params){
        $this->params['fromCountry'] = $params['fromCountry'];
        $this->params['country'] = $params['country'];
        $this->params['startProv'] = $params['startProv'];
        $this->params['startCity'] = $params['startCity'];
        $this->params['startCountry'] = $params['startCountry'];
        $this->params['startTown'] = $params['startTown'];
        $this->params['startAddress'] = $params['startAddress'];

        $this->params['endProv'] = $params['endProv'];
        $this->params['endCity'] = $params['endCity'];
        $this->params['endCountry'] = $params['endCountry'];
        $this->params['endTown'] = $params['endTown'];
        $this->params['endAddress'] = $params['endAddress'];
        $this->params['weight'] = $params['weight'];
        $this->params['length'] = $params['length'];
        $this->params['width'] = $params['width'];
        $this->params['height'] = $params['height'];
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