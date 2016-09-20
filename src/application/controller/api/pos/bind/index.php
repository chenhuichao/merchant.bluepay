<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

$merchant_id = $_SESS['merchant_id'];
$sn = RequestSvc::Request('sn');
$pos = PosSvc::getBySn($sn);
if(empty($pos) || $pos['merchant_id'] != $merchant_id || $uid > 0){
	$_RESULT = array(
		'code'=>'ERR_POS_BIND_FAIL'
	);
}else{
	$id = $pos['id'];
	PosSvc::updateById($id,['user_id'=>$uid,'utime'=>date('Y-m-d H:i:s')]);
}

outPut($_RESULT);



