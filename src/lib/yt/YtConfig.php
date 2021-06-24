<?php


namespace RmTop\RmExpress\lib\yt;


use RmTop\RmExpress\model\TopExpressConfig;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class YtConfig
{


    /**
     * 创建圆通配置
     * @param string $clientId
     * @param string $key
     * @return TopExpressConfig|\think\Model
     */
    static function addConfig(string $apiUrl,string $clientId,string $key,string $version){
        $data['identify'] = 'YT';
        $config['apiUrl'] = $apiUrl;
        $config['version'] = $version;
        $config['clientId'] = $clientId;
        $config['key'] = $key;
        $data['config'] = serialize($config);
        return   TopExpressConfig::create($data);
    }


    /**
     * 修改配置
     * @param int $id
     * @param string $clientId
     * @param string $key
     * @return bool
     * @throws DataNotFoundException
     * @throws DbException
     * @throws ModelNotFoundException
     */
    static  function editConfig(string $apiUrl,int $id,string $clientId,string $key,string $version): bool
    {
       $find =  TopExpressConfig::find($id);
       $find->config = serialize([
           'apiUrl'=>$apiUrl,
           'clientId'=>$clientId,
           'key'=>$key
           ,'version'=>$version
       ]);
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
        return unserialize($find->config);
    }


    /**删除配置项
     * @param int $id
     * @return bool
     */
    static  function deleteConfig(int $id): bool
    {
        return TopExpressConfig::where(['id'=>$id])->delete();
    }

// ---------------------------------------------- 圆通数据处理  ---------------------------------------

    /**
     * 加密数据
     * @param string $data
     * @param string $key
     * @return string
     */
    function getSign(string $data,string $key): string
    {
      return base64_encode(md5($data.$key));
    }



}