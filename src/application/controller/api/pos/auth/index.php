<?php
include dirname(dirname(__DIR__)).'/header.php';
include dirname(dirname(__DIR__)).'/require-login.php';
include ROOT_PATH.'/src/helper/crypt/des.php';

$fname = RooT_PATH.'/logs/pos_auth_3des.log';
$merchant_id = $_SESS['merchant_id'];
$encypt_data = RequestSvc::Request('encypt_data');

// 3DES方式
$key = 'sfe023f_sefiel#fi32lf3e!';
$encrypter = new DesCrypter($key,MCRYPT_3DES);
// DES 方式
// $encrypter = new DesCrypter();
//$data = 'polaris@studygolang';
//$result = $encrypter->encrypt($data);
//var_dump(base64_encode($result));
$data = rtrim($encrypter->decrypt($encypt_data));
$encrypter->close();
$sn = substr($data,0,strlen($data) - 8);

$log = '3des encrypt_data=>'.$encrypt_data.'|data=>'.$data.'|sn=>'.$sn;
LogSvc::fileLog($fname,$log);
$pos = PosSvc::getBySn($sn);
if(empty($pos) || $pos['merchant_id'] != $merchant_id || $pos['user_id'] != $uid){
	$_RESULT = array(
		'code'=>'ERR_POS_AUTH_FAIL'
	);
}

outPut($_RESULT);





