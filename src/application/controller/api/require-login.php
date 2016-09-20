<?php
if(empty($_SESS) || $_SESS['logined'] != 1){
	$_RESULT = array(
		'code'=>'ERR_USER_NOT_LOGGED'
	);
	outPut($_RESULT);
}
$uid = $_SESS['uid'];
