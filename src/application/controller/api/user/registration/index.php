<?php
include dirname(dirname(__DIR__)).'/header.php';

$mobile = (UtlsSvc::checkMobile(RequestSvc::Request('mobile')) == true) ? RequestSvc::Request('mobile') : '';
$passwd = RequestSvc::Request('passwd');
$sms = RequestSvc::Request('sms');

if(empty($_SESS['sms']) || $_SESS['sms'] != $sms){
	$_RESULT = array(
		'code'=>'ERR_SMS_VERIFY_FAIL'
	);
	outPut($_RESULT);
}

if(strlen($passwd) < 6){
	$_RESULT = array(
		'code'=>'ERR_PASSWD_TOO_SHORT'
	);
	outPut($_RESULT);
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

outPut($_RESULT);
