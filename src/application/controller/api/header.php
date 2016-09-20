<?php
include __DIR__.'/funcs.php';

$_RESULT = array(
	'code'=>'OK'
);

$sid = UserSvc::getAppSessionId() ? UserSvc::getAppSessionId() : UtlsSvc::uuid();
$_r = MemCachedDriver::mcache('SESSION_')->get($sid);
$_SESS = unserialize($_r);
$_SESS = is_array($_SESS) ? $_SESS : [];