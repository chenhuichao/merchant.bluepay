<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

$merchant_id = $_SESS['merchant_id'];
$sn = RequestSvc::Request('sn');
$pos = PosSvc::getBySn($sn);
if(empty($pos) || $pos['user_id'] != $uid){
	$_RESULT = array(
		'code'=>'ERR_POS_UNBIND_FAIL'
	);
}else{
	$id = $pos['id'];
	PosSvc::updateById($id,['user_id'=>0,'merchant_id'=>0,'utime'=>date('Y-m-d H:i:s')]);
}

outPut($_RESULT);



