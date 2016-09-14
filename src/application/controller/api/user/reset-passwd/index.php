<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

$sms = RequestSvc::Request('sms');
$mobile = RequestSvc::Request('mobile');

if(empty($_SESS['sms']) || $_SESS['sms'] != $sms){
	$_RESULT = array(
		'code'=>'ERR_SMS_VERIFY_FAIL'
	);
	echo json_encode($_RESULT);
	exit;
}

unset($_SESS['sms']);
$_SESS = is_array($_SESS) ? $_SESS : array();
$r = MemCachedDriver::mcache('SESSION_')->set($sid,serialize($_SESS),86400);
if($r === false){
	$desc = '<pre style="color:red;">
[Memcache Set Reset Passwd SMS Clear Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($_SESS,true).
'</pre>';
	SysinfoSvc::log($desc);
}

$passwd = RequestSvc::Request('passwd');
if(strlen($passwd) < 6){
	$_RESULT = array(
		'code'=>'ERR_PASSWD_TOO_SHORT'
	);
	echo json_encode($_RESULT);
	exit;
}

if($mobile != $_SESS['mobile']){
	$_RESULT = array(
		'code'=>'ERR_RESET_MOBILE_INVALID'
	);
	echo json_encode($_RESULT);
	exit;
}

$userinfo = UserSvc::getUserInfoByMobile($mobile);
$uid = $userinfo['id'];

UserSvc::resetPasswd($passwd,$uid);
/*
if($r == 0){
	$_RESULT = array(
		'code'=>'ERR_RESET_PASSWD_FAIL'
	);
	echo json_encode($_RESULT);
	exit;
}*/

echo json_encode($_RESULT);

