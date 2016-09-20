<?php
include dirname(dirname(__DIR__)).'/header.php';

$mobile = RequestSvc::Request('mobile');
$mobile = (UtlsSvc::checkMobile($mobile) == true) ? $mobile : '';

if(strlen($mobile) == 0){
	$_RESULT = array(
		'code'=>'ERR_MOBILE_FORMAT_WRONG'
	);
	outPut($_RESULT);
}

$rand = UtlsSvc::random(6,6,0);
UtlsSvc::sms($mobile,0,['CODE'=>$rand]);

$_SESS['sms'] = $rand;
$r = MemCachedDriver::mcache('S_')->set($sid,serialize($_SESS),86400);
if($r === false){
	$desc = '<pre style="color:red;">
[Memcache Set SMS Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($_SESS,true).
'</pre>';
	SysinfoSvc::log($desc);
}

$_RESULT['sms'] = $rand;
outPut($_RESULT);
