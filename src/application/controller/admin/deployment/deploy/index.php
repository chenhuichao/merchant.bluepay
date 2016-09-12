<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';
include ROOT_PATH.'/src/helper/lang_check_syntax.php';

$wid = $_POST['wid'];
if($wid){

    $lib = LibSvc::lists(array('pid'=>$wid));
    foreach($lib['record'] as $key=>&$lval){
        $lval['path'] = end(explode('/',$lval['path']));
    }
    $group = ServergroupSvc::lists(array('wid'=>$wid,'status'=>Servergroup::STATE_SUCC));
    $server = array();
    foreach($group['record'] as $key=>$val){
        $result = ServerSvc::lists(array("sgid"=>$val['id'],'status'=>Server::STATE_SUCC));
        $server[$val['sgname']]=$result['record'];
    }
    $data = array(
        'lib'=>$lib['record'],
        'server'=>$server
    );
    $flag = array('code'=>1,'data'=>$data);
    echo json_encode($flag);
    exit();
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if($action == 'save'){

    $add_wid = $_POST['add_wid'];
    $web = WebsiteSvc::getById($add_wid);
    $add_lib = $_POST['lib'];
    $lib = LibSvc::getById($add_lib);
    $add_server = $_POST['server'];
    $r = check_syntax($lib->path,'php',$out);
    if($add_wid && $add_lib && $add_server && $r){

         $params = array();
         //$exclude = '';
         foreach($add_server as $key=>$val){

             $ser = ServerSvc::getById($val);
             if($ser->exclude){
                 $ser->exclude = ' '.'--exclude'.' "'.implode('" --exclude "',unserialize($ser->exclude)).'"';
             }

             $params['wid'] = $web->id;
             $params['lid'] = $lib->id;
             $params['cmd'] = 'rsync -avu --delete'.$ser->exclude.' '.'-e ssh'.' '.$lib->path.'/ '.RSYNC_NAME.'@'.$ser->ip.':'.$ser->spath;
             $params['type'] = Liblog::TYPE_SSH;
             $params['result'] = '';
             $params['uid'] = $uid;
             $params['cat'] = $web->control;
             $params['state'] = Liblog::STATE_INITIAL;

             LiblogSvc::add($params);
         }
         $info = show_msg('操作成功', 'succ');

     }else {
        $syntax = '';
        if(!$r){
            if(is_array($out)){
                foreach ($out as $key => $row) {
                    $syntax .=  '<br/>['.$key.']==>';
                    if(is_array($row)){
                        foreach($row as $k=>$v){
                             $syntax .=  '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;['.$k.']==>['.$v.']';
                        }
                    }
                        
                }
            }   
         }
         $info = show_msg('操作失败'.$syntax, 'err');
     }
    LoaderSvc::loadSmarty()->assign('add_wid',$add_wid);
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
LoaderSvc::loadSmarty()->display('deployment/deploy.tpl');
