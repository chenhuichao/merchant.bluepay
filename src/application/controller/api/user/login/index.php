<?php
include dirname(dirname(__DIR__)).'/header.php';

$mobile = RequestSvc::Request('mobile');
$mobile = (UtlsSvc::checkMobile($mobile) == true) ? $mobile : '';
$passwd = RequestSvc::Request('passwd');
$sms = RequestSvc::Request('sms');

if(strlen($mobile) == 0){
	$_RESULT = array(
		'code'=>'ERR_MOBILE_FORMAT_WRONG'
	);
	outPut($_RESULT);
}

//=======>>>>Dynamic SMS Login Begin<<<<=======
if(strlen($sms)){
    if(empty($_SESS['sms']) || $_SESS['sms'] != $sms){
		$_RESULT = array(
			'code'=>'ERR_SMS_VERIFY_FAIL'
		);
		outPut($_RESULT);
    }
    unset($_SESS['sms']);
    $_SESS = is_array($_SESS) ? $_SESS : array();
    $userinfo = UserSvc::getUserInfoByMobile($mobile);
    $uid = $userinfo['id'];
    $merchant_id = $userinfo['merchant_id'];
	$merchant = MerchantSvc::getById($merchant_id);
    $sid = Utls::uuid();
    $res = array(
		'logined'=>1,
		'user_id'=>$uid,
		'merchant_id'=>$merchant_id,
		'is_default'=>$userinfo['is_default'],
		'type'=>$merchant->type,
		'mobile'=>$userinfo['mobile'],
		'sid'=>$sid,
    );

    if($merchant->type == Merchant::TYPE_PERSONAL){
		$res['real_name'] = $merchant->real_name;
	}elseif($merchant->type == Merchant::TYPE_COMPANY){
		$res['company_name'] = $merchant->company_name;
	}
    
    $_RESULT['result'] = $res;//for response
    $_SESS = array_merge($_SESS,$res);
    $r = MemCachedDriver::mcache('S_')->set($sid,serialize($_SESS),86400);
    if($r === false){
		$desc = '<pre style="color:red;">
[Memcache Set SMS Login Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($_SESS,true).
'</pre>';
		SysinfoSvc::log($desc);
    }

    outPut($_RESULT);
}
//=======>>>>Dynamic SMS Login End<<<<=======

$param = array(
	'mobile'=>$mobile,
	'passwd'=>substr($passwd,0,250),
);

$r = UserSvc::login($param);
if(is_numeric($r)){
	$_RESULT = array(
		'code'=>User::$ERR_CONF_MSG[$r],
	);
}elseif(is_array($r)){
	$sid = UtlsSvc::uuid();
	$_SESS = [];
	$_SESS['logined'] = 1;

	$r['sid'] = $sid;
    $_SESS = array_merge($_SESS,$r);

	$_RESULT['result'] = $r;//for response

	$r = MemCachedDriver::mcache('S_')->set($sid,serialize($_SESS),86400);
	if($r === false){
		$desc = '<pre style="color:red;">
[Memcache Set Login Fail'.$_SERVER['REQUEST_URI'].']
Time:'.date('Y-m-d H:i:s').'
Data:'.var_export($_SESS,true).
	'</pre>';
		SysinfoSvc::log($desc);
	}
}

outPut($_RESULT);


