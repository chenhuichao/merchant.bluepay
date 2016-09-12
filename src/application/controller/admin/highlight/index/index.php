<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';
$_LANG_ = array(
	'php',
);

$lang = RequestSvc::Get('lang','php');
$lang = in_array($lang,$_LANG_ ) ? $lang : '';

$pid = RequestSvc::Get('pid');
//$record = ProjectSvc::getById($pid);

//$path = is_object($record) ? $record->path : '-';
//$file = LIB_ROOT_PATH.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.RequestSvc::Get['filepath'];
$file = LIB_PATH.'/'.$_GET['filepath'];
if(is_file($file )){
	$code = '';
	$code = file_get_contents($file);
	if(in_array($lang,array('php'))){
		$code = str_replace('<','&lt;',$code);
		$code = str_replace('>','&gt;',$code);
	}

	$result = array(
		'lang'=>$lang,
		'code'=>$code,
	);
	LoaderSvc::loadSmarty()->assign('result',$result);
	LoaderSvc::loadSmarty()->display('highlight/index.tpl');
}else{
	echo 'File Not Found!';
}

/*
<html>
<body>
<?php
highlight_file(ROOT_PATH.'/src/application/models/bizservice/adminuser_svc.php');
?>
</body>
</html>
*/
