<?php
/**
 * Created by YnRmsf.
 * User: zhuok520@qq.com
 * Date: 2021/6/27
 * Time: 8:32 下午
 */


namespace RmTop\RmExpress\lib\yt;

/**
 * Class YtSign
 * @package RmTop\RmExpress\lib\yt
 * 通讯数据加密
 */

class YtSign
{

    /**
     * 加密数据
     * @param $param  //加密参数
     * @param string $method //请求方法
     * @param string $version  //接口版本
     * @param string $key //通讯密匙
     * @return string
     */
    static function create_sign($param,string $method,string $version,string $key): string
    {
        return base64_encode(md5($param.$method.$version.$key));
    }


}