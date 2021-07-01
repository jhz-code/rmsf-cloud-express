# rmsf-cloud-express
快递-开放平台--数据调用

##### 快递接口插件安装
~~~
composer require rmtop/rmsf-cloud-express
~~~


#### 基础配置
~~~

  一：发布圆通快递配置文件 
  
  php think  rmtop:publish_express  
 
 二：自动迁移数据表

  php think migrate:run

~~~



##### 快递配置项
~~~
 //例子  创建快递配置
 TopExpressConfigManage::addConfig('圆通快递','YT','http://openuat.yto56.com.cn/open','K21000119','u2Z1F7Fh','v1');

 //获取快递配置列表
 TopExpressConfigManage::getExpressConfigList($where,15);

~~~


#### 圆通快递
     

~~~
电子面单取号接口
 
        $sender['name']= "张天野";
        $sender['postCode']="655603";
        $sender['phone']= "";
        $sender['mobile']= "18xx882xx01";
        $sender['prov']="云南";
        $sender['city']= "昆明";
        $sender['address']= "五华区金鼎科技园18号";
        
        $recive['name']= "张天野";
        $recive['postCode']="655603";
        $recive['phone']= "";
        $recive['mobile']= "18xx882xx01";
        $recive['prov']="云南";
        $recive['city']= "昆明";
         $recive['address']= "五华区金鼎科技园18号";
        $client =  TopExpress::yt_waybill_internal_adapter(1,$sender,$recive,[
            'txLogisticID' => 'm123343mm',
            'orderType' => 1,
            'serviceType' => 1,
        ]);
        var_dump($client);
        
        
        
        
        
        查询面单余额：
        
        $result =  TopExpress::yt_waybill_balance_adapter(1);
        halt($result);
        
        
        
~~~


