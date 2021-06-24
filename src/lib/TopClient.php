<?php


namespace RmTop\RmExpress\lib;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
use RmTop\RmExpress\lib\yt\YtConfig;
use RmTop\RmExpress\lib\yt\YtParams;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

/**
 * 客户请求客户端
 * Class TopClient
 * @package RmTop\RmExpress\lib
 *
 */
class TopClient
{

    public string $identify ;
    public string $configId ;
    public string $action ;
    public string $apiUrl ;
    public array  $params;


    /**
     * @return array
     * @throws DataNotFoundException
     * @throws DbException
     * @throws GuzzleException
     * @throws ModelNotFoundException
     */
    function Client(): array
    {
        $client = new Client();
        // Grab the client's handler instance.
        $clientHandler = $client->getConfig('handler');
        // Create a middleware that echoes parts of the request.
        $tapMiddleware = Middleware::tap(function ($request) {

        });
        $result = $client->request('POST', $this->apiUrl, [
            'http_errors' => false,
            'headers' => [ 'Accept' => 'application/json','User-Agent' => 'rmtop'],
            'handler' => $tapMiddleware($clientHandler),
            'json' => $this->Content(),//获取请求体
        ]);
        $res['StatusCode'] = $result->getStatusCode();
        $res['ReasonPhrase'] = $result->getReasonPhrase();
        $res['Content'] =json_decode($result->getBody(),true);
        return $res ;
    }


    /**
     * @param string $action
     */
    function setAction(string $action){
        $this->action = $action;
    }



    /**
     * @param string $apiUrl
     */
    function setApiUrl(string $apiUrl){
        $this->apiUrl = $apiUrl;
    }



    /**
     * 设置读取配置的ID
     * @param int $configId
     */
    function setConfigId(int $configId){
         $this->configId = $configId;
    }



    /**
     * @return array
     */
    function Content(): array
    {
        if(strtoupper($this->identify ) == "YT"){
           return (new YtParams($this->configId))->get_body();
        }else{
           return [];
        }
    }

}