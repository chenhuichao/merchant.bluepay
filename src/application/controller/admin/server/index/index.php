<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$del_id = $_POST['del_id'];
$type = $_POST['type'];
if($del_id){

    if($type == 0){
        ServerSvc::delRecordById($del_id);
    }elseif($type == 1){
        $params = array(
            'utime' => date("Y-m-d H:i:s"),
            'status'=>Server::STATE_FAIL
        );
        ServerSvc::updateById($del_id,$params);
    }else{
        $params = array(
            'utime' => date("Y-m-d H:i:s"),
            'status'=>Server::STATE_SUCC
        );
        ServerSvc::updateById($del_id,$params);
    }

    $res=array('code'=>0,'msg'=>'移除成功');

    echo json_encode($res);
    exit();

}


$request = array();
$request['sgid'] = RequestSvc::Request('sgid','','int');
$request['status'] = RequestSvc::Request('status');
$request['startime'] = RequestSvc::Request('startime');
$request['endtime'] = RequestSvc::Request('endtime');

$results = ServerSvc::lists($request,array('page'=>RequestSvc::Request('p',1,'int'),'baseurl'=>'/server/?'));
//var_dump();die();
foreach($results['record'] as $key=>&$val){

    $group = ServergroupSvc::getById($val['sgid']);
    $val['sgname'] = $group->sgname;
    $val['stname'] = Servergroup::$STATE_CONF[$val['status']]['NAME'];

}
$group = ServergroupSvc::lists(array());
LoaderSvc::loadSmarty()->assign('group',$group);
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('server/index.tpl');
