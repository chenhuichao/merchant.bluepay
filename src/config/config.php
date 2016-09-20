<?php
define('APP_ENV','');
define('PER_PAGE',30);


//define('WARNING_NOTIFICATION_EMAIL','');
$_SERVER['MEMCACHED_SETS'] = array (
        '_' => array (
            array('127.0.0.1', 11212),
        ),
        'SESSION_' => array (
            array('127.0.0.1', 11212),
        )
);
/*
$_SERVER['REDIS_SETS'] = array (
    '_' => array (
        array('host'=>'localhost','port'=> 6379),
    )
);*/

if(isset($_SERVER['REMOTE_ADDR'])){
	if(isset($argv) || in_array($_SERVER['REMOTE_ADDR'],array('127.0.0.1')) || substr($_SERVER['REMOTE_ADDR'],0,8)=='192.168.')
	{
		error_reporting(E_ALL & ~E_NOTICE & ~ E_STRICT);
	}elseif(APP_DEBUG == 1){
		error_reporting(E_ALL & ~E_NOTICE & ~ E_STRICT);
	}else{
		error_reporting(0);
	}
}


$ini = parse_ini_file(ROOT_PATH.'/src/config/.env'.APP_ENV.'.ini');
foreach($ini as $k=>$v)
{
	$_SERVER[$k]=$v;
}

if(isset($argv))
{
	$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__).'/../../').DIRECTORY_SEPARATOR.APP_NAME;
	error_reporting(E_ALL & ~E_NOTICE & ~ E_STRICT);
}else{
	$_SERVER['ENV_APPLOGS_DIR'] = ROOT_PATH.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.APP_NAME;
	$_SERVER['ENV_DATA_DIR'] = ROOT_PATH.DIRECTORY_SEPARATOR.'data';
	$_SERVER['READONLY_MODE'] = 0;
	$_SERVER['DOCUMENT_ROOT'] = ROOT_PATH.DIRECTORY_SEPARATOR.APP_NAME;
	
	$_SERVER['CAPTCHA_FONT_FILE'] = ROOT_PATH.'/src/application/models/bizdomain/knowledge/verdana.ttf';
}


