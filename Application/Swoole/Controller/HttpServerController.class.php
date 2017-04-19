<?php
namespace Swoole\Controller;

class HttpServerController extends Server
{
	protected $host = '127.0.0.1';
	protected $port = 9501;
	protected $serverType = 'http';
	
	public function onRequest($request, $response)
	{
		// 解决浏览器两次请求
		if($server['path_info'] == "/favicon.ico"){
			return $response->end();
		}
		$response->write(json_encode($request));
	}
}

/*
 * 启动服务
 * php index.php Swoole/HttpServer/start
 */
 
/*
 * 测试
 * 可以打开浏览器，访问http://127.0.0.1:9501查看程序的结果。
 */