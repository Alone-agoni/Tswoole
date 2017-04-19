<?php
namespace Swoole\Controller;

class TcpServerController extends Server
{
	protected $host = '127.0.0.1';
	protected $port = 9503;
	protected $serverType = 'tcp';
	protected $option = array(
		'worker_num' => 4,    // 工作进程数量
		'daemonize' => false, // 是否作为守护进程
	);
	
	public function onConnect($serv, $fd)
	{
		echo "Client:Connect.\n";
	}
	
	public function onReceive($serv, $fd, $from_id, $data)
	{
		$serv->send($fd, 'Swoole: '.$data);
		$serv->close($fd);
	}
	
	public function onClose($serv, $fd)
	{
		echo "Client: Close.\n";
	}
}

/*
 * 启动服务
 * php index.php Swoole/TcpServer/start
 */
 
/*
 * TCP服务器可以使用telnet来连接测试
 * telnet 127.0.0.1 9503
 * hello
 * Server: hello
 */