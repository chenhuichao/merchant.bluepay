<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$edit_id = $_GET['edit_id'];
if($edit_id){

    $result = ServerSvc::getById($edit_id);
    $res = array(
        "id"=>$result->id,
        "sgid"=>$result->sgid,
        "ip"=>$result->ip,
        "spath"=>$result->spath,
        "stype"=>$result->stype,
        "port"=>$result->port,
        "sname"=>$result->sname,
        "spass"=>$result->spass,
        "status"=>$result->status,
    );
    if($result->exclude){
        $res['exclude'] = implode("\n",unserialize($result->exclude));
    }

    LoaderSvc::loadSmarty()->assign('result',$res);

}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
$save_id = $_POST['save_id'];
if('save' == $action){
	$sgid = intval($_POST['sgid']);
	$ip = $_POST['ip'];
	$spath = $_POST['spath'];
	$stype = $_POST['stype'];
	$port = intval($_POST['port']);
	$sname = $_POST['sname'];
	$spass = $_POST['spass'];
    $exclude = $_POST['exclude'];
    if(!empty($exclude)){
        $exclude = (explode("\n",$exclude));
        foreach($exclude as $key=>&$val){
            $val = trim($val);
        }
        $exclude = serialize($exclude);
    }
    //var_dump($exclude);die;
    //$exclude = ' '.'--exclude'.' '.implode(' --exclude ',$exclude);
	$status = intval($_POST['status']);
    $params = array(
        'sgid'=>$sgid,
        'ip'=>$ip,
        'spath'=>$spath,
        'stype'=>$stype,
        'port'=>$port,
        'sname'=>$sname,
        'spass'=>$spass,
        'edition'=>'',
        'exclude'=>$exclude,
        'status'=>$status,
    );
    if($sgid && $ip && $spath && $stype && $port && $sname && $spass){

        if($save_id){
            $params['utime'] = date("Y-m-d H:i:s");
            ServerSvc::updateById($save_id,$params);
            $params['id'] = $save_id;
        }else{
            $server = ServerSvc::add($params);
            $params['id'] = $server->id;
        }

        $info = show_msg('操作成功', 'succ');

    }else {
        $info = show_msg('操作失败', 'err');
    }
    if(!empty($exclude)){
        $params['exclude'] = implode("\n",unserialize($exclude));
    }
    LoaderSvc::loadSmarty()->assign('result',$params);
}
$request = array(
    'status'=>1
);
$group = ServergroupSvc::lists($request);
LoaderSvc::loadSmarty()->assign('group',$group);
LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('server/add.tpl');
