<?php
return array(
	/* 数据库配置信息 */
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'tpswoole', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '123456', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'tb_', // 数据库表前缀
	
	'URL_MODEL'=>0,//URL模式
	
	'ROUTE'		=> array(
		'/user_list'=>['User','user_list'],//获取用户列表;request_method:GET;传入参数: ;返回结果: ;
		'/user_info'=>['User','user_info'],//获取用户信息;request_method:GET;传入参数: ;返回结果: ;
	),
);