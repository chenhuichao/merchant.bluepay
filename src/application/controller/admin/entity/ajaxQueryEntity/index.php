<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$entity = $_REQUEST['entity'];

//echo ROOT_PATH.'/src/application/models/bizdomain/entity/'.$entity.'.php';die();
if(file_exists(	ROOT_PATH.'/src/application/models/bizdomain/entity/'.$entity.'.php'))
{
	echo json_encode(array('code'=>'fail'));
	exit;
}else
{
	echo json_encode(array('code'=>'succ'));
	exit;
}