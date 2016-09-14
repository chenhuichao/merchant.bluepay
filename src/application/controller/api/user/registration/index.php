<?php
include dirname(dirname(__DIR__)).'/header.php';

$mobile = (UtlsSvc::checkMobile(RequestSvc::Request('mobile')) == true) ? RequestSvc::Request('mobile') : '';
$passwd = RequestSvc::Request('passwd');
$sms = RequestSvc::Request('sms');

$data = unserialize($_r);
if(empty($data['sms']) || $data['sms'] != $sms){
	$_RESULT = array(
		'code'=>'ERR_SMS_VERIFY_FAIL'
	);
	echo json_encode($_RESULT);
	exit;
}

if(strlen($passwd) < 6){
	$_RESULT = array(
		'code'=>'ERR_PASSWD_TOO_SHORT'
	);
	echo json_encode($_RESULT);
	exit;
}

$param = array(
	'mobile'=>$mobile,
	'passwd'=>substr($passwd,0,250),
);

if(strlen($mobile) > 0){
	$r = UserSvc::registration($param);
	if(false === $r){
		$_RESULT = array(
			'code'=>'ERR_MOBILE_NOT_UNIQUE'
		);
	}
}
else{
	$_RESULT = array(
		'code'=>'ERR_MOBILE_FORMAT_WRONG'
	);
}

echo json_encode($_RESULT);
