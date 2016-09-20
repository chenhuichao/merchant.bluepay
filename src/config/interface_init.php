<?php
date_default_timezone_set('PRC');

define('APP_DEBUG',1);
define('ROOT_PATH','/home/liuweidong/project/merchant.bluepay');
define('APP_NAME','interface');
define('APP_DOMAIN','interface.merchant.bluepay.com');

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



