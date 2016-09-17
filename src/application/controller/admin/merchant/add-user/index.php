<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if('do' == $action){
	$merchant_id = RequestSvc::Request('merchant_id');
	$mobile = RequestSvc::Request('mobile');
	$email = RequestSvc::Request('email');
	$pay_passwd = RequestSvc::Request('pay_passwd');
	$passwd = RequestSvc::Request('passwd');
	$state = RequestSvc::Request('state');
	$is_default = RequestSvc::Request('is_default');


	$state = in_array($state, array(
            User::STATE_DISABLE,
            User::STATE_ENABLE
    )) ? $state : User::STATE_DISABLE;

    $is_default = in_array($is_default, array(
            User::IS_DEFAULT_NO,
            User::IS_DEFAULT_YES
    )) ? $is_default : User::IS_DEFAULT_NO;

    $ret = UserSvc::encodePasswd($passwd);
    $passwd = $ret['hash'];
    $salt = $ret['salt'];

    if(strlen($merchant_id) > 0){
    	$merchant = MerchantSvc::getById($merchant_id);
    	if(!is_object($merchant)){
    		$info = show_msg($_LANG_['response.message.merchant_not_found'], 'err');
    		goto ret;
    	} 
    	
    }
	
	$params = array(
		'merchant_id'=>$merchant_id,
		'mobile'=>$mobile,
		'email'=>$email,
		'passwd'=>$passwd,
		'state'=>$state,
		'salt'=>$salt,
		'is_default'=>$is_default,
	);
	$obj = UserSvc::add($params);

	if(is_object($obj)){
		 $info = show_msg($_LANG_['response.message.success'], 'succ');
	}else{
		 $info = show_msg($_LANG_['response.message.error'], 'err');
	}
}

ret:
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('merchant/add-user.tpl');
