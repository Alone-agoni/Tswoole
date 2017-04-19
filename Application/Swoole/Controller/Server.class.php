<?php
namespace Swoole\Controller;

use swoole_server;
use swoole_http_server;
use swoole_websocket_server;

/*Abstract class指的是用关键字abstract修饰的类，
 *叫做抽象类，是不允许实例化的类，不能直接创建对象，
 *必须要通过子类创建才能使用abstract类的方法。
 */
abstract class Server
{
	protected $host   = '0.0.0.0';
    protected $port   = 9501;
	protected $swoole;
	protected $serverType;
	protected $mode;
	protected $sockType;	
    protected $option = [];
	
	/*
	 *构造函数
	 */
	public function __construct()
	{
		// 实例化 Swoole 服务
		switch($this->serverType)
		{
			case 'http':
				$this->swoole = new swoole_http_server($this->host, $this->port);
				$eventList = ['Request'];
				break;
				
			case 'socket':
				$this->swoole = new swoole_websocket_server($this->host, $this->port);
				$eventList = ['Open', 'Message', 'Close'];
				break;
				
			case 'tcp':
				$this->swoole = new swoole_server($this->host, $this->port);
				$eventList = ['Connect', 'Receive', 'Close'];
				break;
				
			case 'udp':
				$this->swoole = new swoole_server($this->host, $this->port, $this->mode, $this->sockType);
				$eventList = ['Packet'];
				break;
				
			default:
				$this->swoole = new swoole_server($this->host, $this->port, $this->mode, $this->sockType);
				$eventList    = ['Start', 'ManagerStart', 'ManagerStop', 'PipeMessage', 'Task', 'Packet', 
								'Finish', 'Receive', 'Connect', 'Close', 'Timer', 'WorkerStart', 'WorkerStop',
								'Shutdown', 'WorkerError'];
		}
		
		// 参数设置
		if(!empty($this->option))
		{
			$this->swoole->set($this->option);
		}
		
		// 设置回调
		foreach($eventList as $event)
		{
			if(method_exists($this, 'on'.$event))
			{
				$this->swoole->on($event, array($this, 'on'.$event));
			}
		}
    }
	
	public function start()
	{
		// Run worker
		$this->swoole->start();
	}
	
	public function stop()
	{
		$this->swoole->stop();
	}
	
	// 魔术方法 有不存在的操作的时候执行
	public function __call($method, $args)
	{
		call_user_func_array(array($this->swoole, $method), $args);
	}
}