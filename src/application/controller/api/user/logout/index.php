<?php
include dirname(dirname(__DIR__)).'/header.php';

$r = MemCachedDriver::mcache('SESSION_')->delete($sid);
if($r === false){
	$_RESULT = array(
		'code'=>'ERR_LOGOUT_FAIL'
	);
}

echo json_encode($_RESULT);



