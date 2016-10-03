<?php
date_default_timezone_set('PRC');

define('APP_DEBUG',1);
define('ROOT_PATH','/home/liuweidong/project/merchant.bluepay');
define('APP_NAME','api');
define('APP_DOMAIN','api.merchant.bluepay.com');

require_once ROOT_PATH.'/src/config/config.php';
require_once ROOT_PATH.'/src/autoload/auto_load.php';

LoaderSvc::init();
register_shutdown_function(array('SysinfoSvc','handleFatal'));

/**
$_GET  $_POST  $_COOKIE  $_REQUEST 
*/
$_GET = RequestfilterSvc::addslashes_deep($_GET);
$_POST = RequestfilterSvc::addslashes_deep($_POST);
$_COOKIE = RequestfilterSvc::addslashes_deep($_COOKIE);

$_GET = RequestfilterSvc::htmlspecialcharsRecursive($_GET);
$_POST = RequestfilterSvc::htmlspecialcharsRecursive($_POST);
$_COOKIE = RequestfilterSvc::htmlspecialcharsRecursive($_COOKIE);

/**
Parse URI
*/
$_URL_ = 'http'.'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
$_URIS_ = parse_url($_URL_);

if(is_array($_URIS_)){
	$_URI_ = explode('/',$_URIS_['path']);
	switch(count($_URI_)){
		case 2:
			$_SERVER['_C_'] = (strlen($_URI_['1']) > 0) ? $_URI_['1'] : 'index';
			$_SERVER['_A_'] = 'index';
			break;
		case 3:
			$_SERVER['_C_'] = $_URI_['1'];
			$_SERVER['_A_'] = (strlen($_URI_['2']) > 0) ? $_URI_['2'] : 'index';
			break;
		case 4:
			$_SERVER['_C_'] = $_URI_['1'];
			$_SERVER['_A_'] = $_URI_['2'];
			break;
		default:
			$_SERVER['_C_'] = 'index';
			$_SERVER['_A_'] = 'index';
			break;	
	}
	$_SERVER['_T_'] = isset($_GET['_t']) ? trim($_GET['_t']) : '';
	unset($_URL_,$_URIS_,$_URI_);
	$_L_F = ROOT_PATH.DIRECTORY_SEPARATOR.'src/application/controller'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.$_SERVER['_C_'].DIRECTORY_SEPARATOR.$_SERVER['_A_'].DIRECTORY_SEPARATOR.'index.php';
	if(file_exists($_L_F)){
		$lang = UserSvc::getAppLang() ? UserSvc::getAppLang() : RequestSvc::Request('lang');
		$lang = in_array($lang,['zh-CN','en-US']) ? $lang : 'en-US';
		include_once ROOT_PATH.'/src/application/lang/'.$lang.'.php';
		require_once($_L_F);
	}else {
		header("HTTP/1.1 404 Not Found");
		exit;
	}
}else{
	die('Parse URI Fail');
}


