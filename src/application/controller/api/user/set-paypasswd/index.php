<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

$pay_passwd = RequestSvc::Request('pay_passwd');

if(strlen($pay_passwd) != 6){
	$_RESULT = array(
		'code'=>'ERR_PAY_PASSWD_LENGTH_WRONG'
	);
	outPut($_RESULT);
}

UserSvc::setPayPasswd($uid,$pay_passwd);
outPut($_RESULT);
