<?php
include dirname(dirname(__DIR__)).'/header.php';

$mobile = RequestSvc::Request('mobile');
$mobile = (UtlsSvc::checkMobile($mobile) == true) ? $mobile : '';

if(strlen($mobile) == 0){
	$_RESULT = array(
		'code'=>'ERR_MOBILE_FORMAT_WRONG'
	);
	echo json_encode($_RESULT);
	exit;
}

$rand = UtlsSvc::random(6,6,0);
$content = '尊敬的用户，本次验证码为：'.$rand.'，非常感谢使用我们服务！';
UtlsSvc::sms($mobile,$content);

$data = unserialize($_r);
$data['sms'] = $rand;
$r = MemCachedDriver::mcache('SESSION_')->set($sid,serialize($data),86400);
if($r === false){
	$desc = '<pre style="color:red;">
[Memcache Set SMS Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($data,true).
'</pre>';
	SysinfoSvc::log($desc);
}

$_RESULT['sms'] = $rand;
echo json_encode($_RESULT);
