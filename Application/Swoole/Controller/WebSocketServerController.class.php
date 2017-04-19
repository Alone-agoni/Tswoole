<?php
namespace Swoole\Controller;

class WebSocketServerController extends Server
{
	protected $host = '127.0.0.1';
	protected $port = 9502;
	protected $serverType = 'socket';
	
	public function onOpen($server, $request)
	{
		echo "connection open: ".$request->fd ."\n";
	}
	
	public function onMessage($server, $frame)
	{
		echo "message: ".$frame->data;
		$server->push($frame->fd, json_encode(["hello", "world"]));
	}
	
	public function onClose($server, $fd)
	{
		echo "connection close: ".$fd ."\n";
	}
}

/*
 * 启动服务
 * php index.php Swoole/WebsocketServer/start
 */
 
 /*
  * 测试
  * 可以使用Chrome浏览器进行测试，JS代码为：
  
	var wsServer = 'ws://127.0.0.1:9502';
	var websocket = new WebSocket(wsServer);
	websocket.onopen = function (evt) {
		console.log("Connected to WebSocket server.");
	};

	websocket.onclose = function (evt) {
		console.log("Disconnected");
	};

	websocket.onmessage = function (evt) {
		console.log('Retrieved data from server: ' + evt.data);
	};

	websocket.onerror = function (evt, e) {
		console.log('Error occured: ' + evt.data);
	};
	
 */