<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

$merchant_id = $_SESS['merchant_id'];
$type = RequestSvc::Request('type');

$pos_auth_rand = UtlsSvc::random(8,8);

if($type == 'auth'){
	$res = ['pos_auth_rand'=>$pos_auth_rand];
}else{
	$res = [];
}

$_RESULT['result'] = $res;//for response
$_SESS = array_merge($_SESS,$res);
$r = MemCachedDriver::mcache('S_')->set($sid,serialize($_SESS),86400);
if($r === false){
	$desc = '<pre style="color:red;">
[Memcache Set POS rand Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($_SESS,true).
'</pre>';
	SysinfoSvc::log($desc);
}

outPut($_RESULT);





