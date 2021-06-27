<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/24
 * Time: 12:36 上午
 */


namespace RmTop\RmExpress\core;


use GuzzleHttp\Exception\GuzzleException;
use RmTop\RmExpress\lib\TopClient;
use RmTop\RmExpress\lib\yt\YtBaseParam;
use RmTop\RmExpress\lib\yt\YtKorderCreateParam;
use RmTop\RmExpress\lib\yt\YtOrderCreateParam;
use RmTop\RmExpress\lib\yt\YtWaybillInternal;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class TopExpress
{

    /**
     * 圆通电子面单取号
     * @param int $configId   //配置信息
     * @param string $apiUrl  //api接口
     * @param array $sender //发件信息
     * @param array $receiver //收件信息
     * @param array $logistics //寄件详细信息
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_waybill_internal_adapter(int $configId,string $apiUrl,array $sender,array $receiver,array $logistics): array
    {
        $TopParams = new YtWaybillInternal($configId);
        $TopParams->create_sender($sender);//发货人
        $TopParams->create_receiver($receiver);//收货人
        $TopParams->create_logistics_interface($logistics);
        $TopParams->create_method('waybill_internal_adapter');
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**
     * 订单创建接口
     * @param int $configId  //配置参数
     * @param string $apiUrl  //请求地址
     * @param array $sender    //发货人
     * @param array $receiver  //收货人
     * @param array $params   //详细信息
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_korder_create_adapter(int $configId,string $apiUrl,array $sender,array $receiver,array $params): array
    {
        $TopParams = new YtKorderCreateParam($configId);
        $TopParams->create_method('korder_create_adapter');
        $TopParams->create_sender($sender);
        $TopParams->create_receiver($receiver);
        $TopParams->create_params($params);
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**
     * 订单取消
     */
    function yt_korder_cancel_adapter(int $configId,string $apiUrl,array $params): array
    {
        $TopParams = new YtKorderCreateParam($configId);
        $TopParams->create_method('korder_create_adapter');
        $TopParams->create_korder_cancel_params($params);
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**
     * 散单创建
     * @param int $configId
     * @param string $apiUrl
     * @param array $sender
     * @param array $receiver
     * @param array $params
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_order_create_adapter(int $configId,string $apiUrl,array $sender,array $receiver,array $params): array
    {
        $TopParams = new YtOrderCreateParam($configId);
        $TopParams->create_method('order_create_adapter');
        $TopParams->create_sender($sender);
        $TopParams->create_receiver($receiver);
        $TopParams->create_params($params);
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**
     * 散单取消
     * @param int $configId
     * @param string $apiUrl
     * @param array $params
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_order_cancel_adapter(int $configId,string $apiUrl,array $params){
        $TopParams = new YtOrderCreateParam($configId);
        $TopParams->create_method('order_cancel_adapter');
        $TopParams->create_order_cancel_params($params);
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**
     * 电子面单余额查询接
     * @param int $configId
     * @param string $apiUrl
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_waybill_balance_adapter(int $configId,string $apiUrl){
        $TopParams = new YtBaseParam($configId);
        $TopParams->create_method('waybill_balance_adapter');
        $TopParams->create_params();
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }


    /**标准运价查询接口
     * @param int $configId
     * @param string $apiUrl
     * @param array $param
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function yt_charge_adapter(int $configId,string $apiUrl,array $param){
        $TopParams = new YtBaseParam($configId);
        $TopParams->create_method('charge_adapter');
        $TopParams->charge_params($param);
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }

}