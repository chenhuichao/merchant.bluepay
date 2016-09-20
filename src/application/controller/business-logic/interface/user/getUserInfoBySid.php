<?php
$sid = $_REQUEST['sid'];
$r = UserSvc::getUserInfoBySid($sid);

if(empty($r)){
	$_RESULT = array(
		'code'=>'ERR_SID_NOT_FOUND',
	);
}else{
	$_RESULT['result'] = $r;
}
