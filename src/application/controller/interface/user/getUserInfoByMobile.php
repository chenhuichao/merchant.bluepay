<?php
$mobile = $_REQUEST['mobile'];
$r = UserSvc::getUserInfoByMobile($mobile);

if(empty($r)){
	$_RESULT = array(
		'code'=>User::$ERR_CONF_MSG[User::ERR_USER_NOT_FOUND]
	);
}else{
	$_RESULT['result'] = $r;
}
