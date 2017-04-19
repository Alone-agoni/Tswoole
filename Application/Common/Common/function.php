<?php
function curlPt($curlUrl,$curlData = "")
{
	$query = makeQuery($curlData);
	$ch = curl_init(); // 启动一个CURL会话
	curl_setopt($ch, CURLOPT_URL, $curlUrl); // 要访问的地址
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	curl_setopt($ch, CURLOPT_POST, 1); // 发送一个常规的Post请求
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query); // Post提交的数据包
	curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$outPut = curl_exec($ch); // 执行操作
	if (curl_errno($ch)) {
	   echo 'Errno'.curl_error($ch);//捕抓异常
	}
	curl_close($ch); // 关闭CURL会话
	return json_decode($outPut, true);
}

function curlGt($curlUrl, $curlData = "")
{
	$query =  makeQuery($curlData);
	$ch = curl_init(); // 启动一个CURL会话
	curl_setopt($ch, CURLOPT_URL, $curlUrl.'?'.$query); // 要访问的地址
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	curl_setopt($ch, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$outPut = curl_exec($ch); // 执行操作
	if (curl_errno($ch)) {
	   echo 'Errno'.curl_error($ch);//捕抓异常
	}
	curl_close($ch); // 关闭CURL会话
	return json_decode($outPut, true);
}

function makeQuery($data = "")
{
	$query = '';
	if($data != ""){
		$query .= "params=".$data;
	}
	return $query;
}