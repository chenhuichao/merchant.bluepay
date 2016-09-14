<?php
$sid = RequestSvc::Request('sid');
$_r = MemCachedDriver::mcache('SESSION_')->get($sid);
if($_r === false){
	$_RESULT = array(
		'code'=>'ERR_SID_NOT_FOUND'
	);
	SysinfoSvc::log('API URI['.$_SERVER['REQUEST_URI'].'] CODE[ERR_SID_NOT_FOUND] SID['.$sid.']');
	echo json_encode($_RESULT);
	exit;
}

$_SESS = unserialize($_r);
if(empty($_SESS) || $_SESS['logined'] != 1){
	$_RESULT = array(
		'code'=>'ERR_USER_NOT_LOGGED'
	);
	echo json_encode($_RESULT);
	exit;
}