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
use RmTop\RmExpress\lib\yt\YtParams;
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
        $TopParams = new YtParams($configId);
        $TopParams->create_sender($sender);//发货人
        $TopParams->create_receiver($receiver);//收货人
        $TopParams->create_logistics_interface($logistics);
        $TopParams->create_method('waybill_internal_adapter');
        $TopParams->get_body();
        $TopClient = new TopClient();
        $TopClient->setApiUrl($apiUrl);
        $TopClient->setContent($TopParams->get_body());
        return $TopClient->Client();
    }

}