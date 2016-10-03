<?php
if(!(LoaderSvc::loadSess()->get('uid') && LoaderSvc::loadSess()->get('APP_NAME') == APP_NAME)) die('Not Logged In');

$path = $_SERVER['ENV_DATA_DIR'].'/upload';
$r = UtlsSvc::uploadFile('Filedata',$path,array('jpg','gif','jpeg','png','zip','rar','docx'));
$status = $r['status'];
if($status == 0){
	$key = UtlsSvc::uuid();
	$b_path = str_replace($path,'',$r['data']['path']);
	Filepool::set($key,array('path'=>$b_path,'type'=>$_FILES['Filedata']['type'],"filename"=>$_FILES["Filedata"]["name"]));
	$data = array(
		'status'=>$status,
	    'key'=>$key,
	    'filename'=>$_FILES['Filedata']['name'],
	);
	if(in_array($_FILES['Filedata']['type'],array('image/jpg','image/jpeg','image/gif','image/png'))){
		//生成缩略图
		include_once ROOT_PATH.'/src/helper/file/ImageResize.php';
		$s_path = $r['data']['path'].'_small.jpg';

		$image = new \Eventviva\ImageResize($r['data']['path']);
		$image->resizeToBestFit(400, 300);
		$image->save($s_path);

		$s_key = 's_'.$key;
		$s_path = str_replace($path,'',$s_path);
		$s_name = $_FILES["Filedata"]["name"].'small.jpg';
		Filepool::set($s_key,array('path'=>$s_path,'type'=>$_FILES['Filedata']['type'],"filename"=>$s_name));

	    $data['type']='img';
	}else{
	    $data['type']='doc';
	}
}else{
	$data = array(
		'status'=>$status,
	);
}

echo json_encode($data);

