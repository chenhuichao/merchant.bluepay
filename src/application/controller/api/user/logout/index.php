<?php
include dirname(dirname(__DIR__)).'/header.php';

$r = MemCachedDriver::mcache('S_')->delete($sid);
if($r === false){
	$_RESULT = array(
		'code'=>'ERR_LOGOUT_FAIL'
	);
}

outPut($_RESULT);



