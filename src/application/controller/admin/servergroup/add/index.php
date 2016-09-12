<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$edit_id = $_GET['edit_id'];
if($edit_id){

    $result = ServergroupSvc::getById($edit_id);
    $res = array(
        "id"=>$result->id,
        "sgname"=>$result->sgname,
        "wid"=>$result->wid,
        "status"=>$result->status,
        "remark"=>$result->remark,
    );

    LoaderSvc::loadSmarty()->assign('result',$res);

}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
$save_id = $_POST['save_id'];
if('save' == $action){
	$sgname = $_POST['sgname'];
    $wid = $_POST['wid'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    if(strlen(trim($sgname)) > 0){

        $params = array(

            'sgname'=>$sgname,
            'wid'=>$wid,
            'status'=>$status,
            'remark'=>$remark
        );

        if($save_id){
            $params['utime'] = date("Y-m-d H:i:s");
            ServergroupSvc::updateById($save_id,$params);
            $params['id'] = $save_id;
        }else{
            $group = ServergroupSvc::add($params);
            $params['id'] = $group->id;
        }

        $info = show_msg('添加成功','succ');

    }else{
        $info = show_msg('服务器组名不能为空','err');
    }

    LoaderSvc::loadSmarty()->assign('result',$params);
}

$website = WebsiteSvc::lists(array());
$user = AdminuserSvc::getById($uid);
$auth = explode(',',$user->wid);
foreach($website['record'] as $key=>$val){
    if(!in_array($val['id'],$auth)){
        unset($website['record'][$key]);
    }
}
LoaderSvc::loadSmarty()->assign('website',$website);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('servergroup/add.tpl');
