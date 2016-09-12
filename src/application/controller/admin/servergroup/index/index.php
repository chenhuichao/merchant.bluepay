<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$del_id = $_POST['del_id'];
$type = $_POST['type'];
if($del_id){

    if($type == 0){
        ServergroupSvc::delRecordById($del_id);

    }elseif($type == 1){
        $params = array(
            'utime' => date("Y-m-d H:i:s"),
            'status'=>Servergroup::STATE_FAIL
        );
        ServergroupSvc::updateById($del_id,$params);
    }else{
        $params = array(
            'utime' => date("Y-m-d H:i:s"),
            'status'=>Servergroup::STATE_SUCC
        );
        ServergroupSvc::updateById($del_id,$params);
    }
    $flag = array('code'=>0,'msg'=>'操作成功');
    echo json_encode($flag);
    exit();
}

$request = array();
$id = RequestSvc::Request('id',-1,'int');

if($id > 0){
	$request['id'] = $id;
}

$results = ServergroupSvc::lists($request,array('page'=>RequestSvc::Request('p',1,'int'),'baseurl'=>'/servergroup/?'));
foreach($results['record'] as $key=>&$val){
    $val['sname'] = Servergroup::$STATE_CONF[$val['status']]['NAME'];
}

LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('servergroup/index.tpl');
