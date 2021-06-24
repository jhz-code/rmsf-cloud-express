<?php

namespace RmTop\RmExpress;

use RmTop\RmExpress\command\PublishExpressFile;
use think\Service;

/**
 */
class RmExpressService extends Service
{
    /**
     * Register service.
     *
     * @return void
     */
    public function register()
    {
        // 注册数据迁移服务
        $this->app->register(\think\migration\Service::class);
    }

    /**
     * Boot function.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(['rmtop:publish_express' => PublishExpressFile::class,]);
    }


}
