<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$path = $_POST['path'];
if($path){

    $path = LIB_PATH.'/'.$path;

    if(is_dir($path)){
        //$path = '/tmp/20150811180512';
        $handler  = opendir($path);
        //$filename = readdir($handler);
        while( ($filename = readdir($handler)) !== false )  {

            if($filename != "." && $filename != ".." && $filename != ".svn" && $filename != ".git") {
                $file[] = $filename;
            }
        }
        $flag = array('code'=>1,'data'=>$file);
    }else{
        //$myfile = fopen($path, "r") or die("Unable to open file!");
        //$contents = fread($myfile,filesize($path));
        //fclose($myfile);
        $contents = htmlspecialchars(file_get_contents($path));
        //var_dump($contents);
        $flag = array('code'=>2,'data'=>$contents);
    }

    echo json_encode($flag);
    exit();
}

$request = array();
$request['pid'] = RequestSvc::Request('pid');
$request['state'] = RequestSvc::Request('state');
$request['startime'] = RequestSvc::Request('startime');
$request['endtime'] = RequestSvc::Request('endtime');

$user = AdminuserSvc::getById($uid);
$auth = explode(',',$user->wid);
$results = LibSvc::lists($request,array('page'=>RequestSvc::Request('p',1,'int'),'baseurl'=>'/lib/?'));
foreach($results['record'] as $key=>&$row){

    if(!in_array($row['pid'],$auth)){
        unset($results['record'][$key]);
    }

    $record = WebsiteSvc::getById($row['pid']);
    $row['pname'] = (is_object($record) ? $record->wname : 'Err');
    $row['sname'] = Lib::$STATE_CONF[$row['state']]['NAME'];
    $row['path'] = str_replace(LIB_PATH.'/','',$row['path']);
}

$website = WebsiteSvc::lists(array());
foreach($website['record'] as $key=>$val){
    if(!in_array($val['id'],$auth)){
        unset($website['record'][$key]);
    }
}
LoaderSvc::loadSmarty()->assign('website',$website);
LoaderSvc::loadSmarty()->assign('status',Lib::$STATE_CONF);
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('results',$results);
LoaderSvc::loadSmarty()->display('lib/index.tpl');
