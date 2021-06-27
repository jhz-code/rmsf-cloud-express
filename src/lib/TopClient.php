<?php


namespace RmTop\RmExpress\lib;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
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

    public string $apiUrl ;
    public $content;


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
            'json' => $this->content,//获取请求体
        ]);
        $res['StatusCode'] = $result->getStatusCode();
        $res['ReasonPhrase'] = $result->getReasonPhrase();
        $res['Content'] =json_decode($result->getBody(),true);
        return $res ;
    }





    /**
     * @param $content
     * @return void
     */
    function setContent($content)
    {
        $this->content = $content;
    }


    function setApiUrl(string $apiUrl){
        $this->apiUrl = $apiUrl;
    }

}