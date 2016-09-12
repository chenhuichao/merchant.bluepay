<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$del_id = $_POST['del_id'];
if($del_id){

    $res = WebsiteSvc::getById($del_id);
    if($res->uid == $uid){
        WebsiteSvc::delRecordById($del_id);
        $res=array('code'=>0,'msg'=>'移除成功');
    }

    echo json_encode($res);
    exit();
}

$request = array();
$request['wname'] = RequestSvc::Request('wname');
$request['startime'] = RequestSvc::Request('startime');
$request['endtime'] = RequestSvc::Request('endtime');

$results = WebsiteSvc::lists($request,array('page'=>RequestSvc::Request('p',1,'int'),'baseurl'=>'/website/?'));
//var_dump();die();

LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('website/index.tpl');
