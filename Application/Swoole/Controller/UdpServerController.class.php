<?php
namespace Swoole\Controller;

class UdpServerController extends Server
{
	protected $host = '127.0.0.1';
    protected $port   = 9504;
	protected $serverType = 'udp';	
	protected $mode = SWOOLE_PROCESS;
	protected $sockType = SWOOLE_SOCK_UDP;
	
	public function onPacket($serv, $data, $clientInfo)
	{
		$serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
		var_dump($clientInfo);
	}
}

/*
 * 启动服务
 * php index.php Swoole/UdpServer/start
 */
 
/*
 * UDP服务器可以使用netcat -u 来连接测试
 * netcat -u 127.0.0.1 9504
 * hello
 * Server: hello
 */