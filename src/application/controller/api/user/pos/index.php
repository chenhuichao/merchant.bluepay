<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';

if($_SESS['is_default'] == User::IS_DEFAULT_YES){
	$results = PosSvc::getByMerchantId($_SESS['merchant_id']);
}else $results = PosSvc::getByUid($uid);

$_RESULT['data'] = $results;
outPut($_RESULT);



