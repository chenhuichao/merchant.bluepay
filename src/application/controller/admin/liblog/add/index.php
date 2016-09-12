<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if('do' == $action){

	$wid = intval($_POST['wid']);
    $branch = $_POST['branch'];
    if($branch){
        $branch='/'.$branch;
    }
    $version = $_POST['version'];
    if($version){
        $version=' '.'-r'.' '.$version;
    }
    //同步id
    $lib_id = $_POST['lib_id'];

    if($wid){
        $path = LIB_PATH.'/'.date("YmdHis");
        $web = WebsiteSvc::getById($wid);

        if($web->control == 'SVN'){
            $cmd = 'svn co '.$web->cpath.$branch.$version.' '.$path;
        }elseif($web->control == 'GIT'){
            $cmd = 'git clone'.' '.$web->cpath.' '.$path;
        }

        $params = array(
            'wid'=>$wid,
            'cmd'=>$cmd,
            'type'=>Liblog::TYPE_CO,
            'result'=>'',
            'uid'=>$uid,
            'cat'=>$web->control,
            'state'=>Liblog::STATE_INITIAL,
        );
        $params2 = array(
            'pid'=>$wid,
            'version'=>0,
            'path'=>$path,
            'state'=>Lib::STATE_CO,
        );
        $lib = LibSvc::add($params2);
        $params['lid'] = $lib->id;
        LiblogSvc::add($params);
        $info = show_msg('操作成功', 'succ');
    }elseif($lib_id){
        $up_wid = $_POST['up_wid'];
        $path = LIB_PATH.'/'.$_POST['path'];
        $web = WebsiteSvc::getById($up_wid);
        $cmd = 'cd'.' '.$path.PHP_EOL;
        if($web->control == 'SVN'){
            $cmd .= 'svn up --username robots --password robots ';
        }elseif($web->control == 'GIT'){
            $cmd .= 'git pull';
        }

        $params = array(
            'wid'=>$up_wid,
            'lid'=>$lib_id,
            'cmd'=>$cmd,
            'type'=>Liblog::TYPE_UP,
            'result'=>'',
            'uid'=>$uid,
            'cat'=>$web->control,
            'state'=>Liblog::STATE_INITIAL,
        );
        $params2 = array(
            'utime'=>date("Y-m-d H:i:s"),
            'state'=>Lib::STATE_UP,
        );
        LiblogSvc::add($params);
        LibSvc::updateById($lib_id,$params2);
        $flag = array('code'=>1,'msg'=>'操作成功');
        echo json_encode($flag);
        exit();
    }

}

LoaderSvc::loadSmarty()->assign('info',$info);
LoaderSvc::loadSmarty()->display('lib/pull.tpl');
