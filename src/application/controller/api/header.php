<?php
include __DIR__.'/funcs.php';

$_RESULT = array(
	'code'=>'OK',
	'msg'=>''
);

$sid = UserSvc::getAppSessionId();

if(!is_null($sid)){
	$_r = MemCachedDriver::mcache('S_')->get($sid);
	if($_r === false){
		SysinfoSvc::log('API URI['.$_SERVER['REQUEST_URI'].'] CODE[ERR_SID_NOT_FOUND] SID['.$sid.']');
	}
	$_SESS = unserialize($_r);
}else $sid = UtlsSvc::uuid();

$_SESS = is_array($_SESS) ? $_SESS : [];