<?php
date_default_timezone_set('PRC');
define('ROOT_PATH','/data/htdocs/deployer.wanglibao.com');
define('APP_NAME','admin');

require_once ROOT_PATH.'/src/config/config.php';
require_once ROOT_PATH.'/src/autoload/auto_load.php';
LoaderSvc::init();
