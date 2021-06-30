<?php


namespace RmTop\RmExpress\lib;


use RmTop\RmExpress\model\TopExpressConfig;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;
use think\Paginator;

class TopExpressConfigManage
{


    /**
     * 创建圆通配置
     * @param string $expressName //快递配置名称
     * @param string $identify  //标识符
     * @param string $apiUrl
     * @param string $clientId
     * @param string $key
     * @param string $version
     * @return TopExpressConfig|Model
     */
    static function addConfig(string $expressName,string $identify, string $apiUrl,string $clientId,string $key,string $version){
        $data['title'] = $expressName;
        $data['identify'] = $identify;
        $config['apiUrl'] = $apiUrl;
        $config['version'] = $version;
        $config['clientId'] = $clientId;
        $config['key'] = $key;
        $data['config'] = serialize($config);
        return   TopExpressConfig::create($data);
    }


    /**
     * 修改配置
     * @param string $expressName
     * @param string $identify
     * @param string $apiUrl
     * @param int $id
     * @param string $clientId
     * @param string $key
     * @param string $version
     * @return bool
     */
    static  function editConfig(int $id,string $expressName,string $identify, string $apiUrl,string $clientId,string $key,string $version): bool
    {
        $find =  TopExpressConfig::find($id);
        $find->config = serialize([
            'apiUrl'=>$apiUrl,
            'clientId'=>$clientId,
            'key'=>$key,
            'version'=>$version
        ]);
        $find->title = $expressName;
        $find->identify = $identify;
        return $find->save();
    }


    /**
     * 返回配置项
     * @param int $id
     * @return mixed
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    static   function getConfig(int $id){
        $find =  TopExpressConfig::find($id);
        return unserialize($find['config']);
    }


    /**删除配置项
     * @param int $id
     * @return bool
     */
    static  function deleteConfig(int $id): bool
    {
        return TopExpressConfig::where(['id'=>$id])->delete();
    }

    /**
     * 获取配置列表
     * @param int $where  查询
     * @param int $limit   每页输出
     * @return Paginator
     * @throws DbException
     */
    static function getExpressConfigList($where = 1,int $limit = 12): Paginator
    {
        return TopExpressConfig::where($where)->paginate($limit);
    }

// ---------------------------------------------- 圆通数据处理  ---------------------------------------

}