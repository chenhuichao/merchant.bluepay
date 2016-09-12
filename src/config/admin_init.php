<?php
date_default_timezone_set('PRC');

define('APP_DEBUG',1);
define('ROOT_PATH','/home/liuweidong/project/merchant.bluepay');
define('APP_NAME','admin');
define('APP_DOMAIN','admin.merchant.bluepay.com');

define('ENV_ROOT_URL','http://admin.merchant.bluepay.com:9100');
define('ENV_STATIC_URL','http://admin.merchant.bluepay.com:9100/static');

require_once ROOT_PATH.'/src/config/config.php';
require_once ROOT_PATH.'/src/autoload/auto_load.php';

LoaderSvc::init();
LoaderSvc::regSess( 'SID' );
//register_shutdown_function('sess_gc');
register_shutdown_function(array('SysinfoSvc','handleFatal'));

/**
Smarty Config
*/
LoaderSvc::loadSmarty()->setTemplateDir(ROOT_PATH.'/src/application/view/'.APP_NAME);
LoaderSvc::loadSmarty()->setCompileDir('/data/applogs/'.APP_DOMAIN.'/'.APP_NAME.'/smarty/compile');
//LoaderSvc::loadSmarty()->setConfigDir(ROOT_PATH.'/src/application/view/configs/');
LoaderSvc::loadSmarty()->setCacheDir('/data/applogs/'.APP_DOMAIN.'/'.APP_NAME.'/smarty/cache');
//LoaderSvc::loadSmarty()->force_compile = true;
//LoaderSvc::loadSmarty()->debugging = true;
LoaderSvc::loadSmarty()->caching = false;
//LoaderSvc::loadSmarty()->cache_lifetime = 120;

LoaderSvc::loadSmarty()->assign('_STATIC_',ENV_STATIC_URL);
LoaderSvc::loadSmarty()->assign('_ROOT_URL_',ENV_ROOT_URL);

/**
Http Referer
*/
$_RERERE_EXCEPT = array(
);

if (isset($_SERVER['HTTP_REFERER'])){
	if(strlen($_SERVER['HTTP_REFERER']) > 0){
		if(stristr($_SERVER['HTTP_REFERER'],APP_DOMAIN) === false && !in_array($_SERVER['HTTP_REFERER'],$_RERERE_EXCEPT)){
			die("Referer Unverified");
		}
		LoaderSvc::loadSmarty()->assign('_REFER_',$_SERVER['HTTP_REFERER']);
	}
}

/**
_DEBUG_
*/
if (isset($_REQUEST['_DEBUG_'])){
	LoaderSvc::loadSmarty()->assign('_DEBUG_',$_REQUEST['_DEBUG_']);
}

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

	LoaderSvc::loadSmarty()->assign('_C_',$_SERVER['_C_']);
	LoaderSvc::loadSmarty()->assign('_A_',$_SERVER['_A_']);
	LoaderSvc::loadSmarty()->assign('_T_',$_SERVER['_T_']);
	unset($_URL_,$_URIS_,$_URI_);

	$_L_F = ROOT_PATH.DIRECTORY_SEPARATOR.'src/application/controller'.DIRECTORY_SEPARATOR.APP_NAME.DIRECTORY_SEPARATOR.$_SERVER['_C_'].DIRECTORY_SEPARATOR.$_SERVER['_A_'].DIRECTORY_SEPARATOR.'index.php';
	if(file_exists($_L_F)){
		require_once($_L_F);
	}else {
		UtlsSvc::displayErr($_SERVER["REQUEST_URI"],404);
	}
}else{
	die('Parse URI Fail');
}

/**
Exception Access
*/
if(defined(WARNING_NOTIFICATION_EMAIL)){
	if(!UtlsSvc::inCompany()){
		$desc = '<pre style="color:purple;">Exception Access:FORWARD_IP['.UtlsSvc::getClientIp().']   URI:['.$_SERVER["REQUEST_URI"].']    REMOTE_ADDR:['.$_SERVER["REMOTE_ADDR"].']	HTTP_USER_AGENT:['.$_SERVER["HTTP_USER_AGENT"].']	['.date('Y-m-d H:i:s').']</pre>';
		UtlsSvc::sendMail(array(WARNING_NOTIFICATION_EMAIL),$desc);
	}
}


