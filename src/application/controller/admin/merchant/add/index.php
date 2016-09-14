<?php
require_once dirname(dirname(dirname(__FILE__))) . '/header.php';

$type = isset($_GET['type']) ? $_GET['type'] : null;
$info = '';
if ($type == 'save') {
    $name = trim($_POST['name']);
    $ename = trim($_POST['ename']);
    $depart = $_POST['depart'];
    $position = $_POST['position'];
    $passwd = $_POST['passwd'];
    $email = trim($_POST['email']);
    $remark = $_POST['remark'];

    if (! empty($name) && ! empty($email) && ! empty($passwd)) {
        $arr = AdminuserSvc::getByEmail($email);
        if(!empty($arr)){
            $info = show_msg('用户已存在', 'err');
        }else{
             $salt = UtlsSvc::random(5);
            $params = array(
                'name' => $name,
                'ename' => $ename,
                'status' => $status,
                'depart' => $depart,
                'position' => $position,
                'email' => $email,
                'rid' => $rid,
                'role' => $role,
                'salt' => $salt,
                'passwd' => md5($passwd . md5($salt)),
                'remark' => $remark,
            );
            AdminuserSvc::add($params);
            $info = show_msg('操作成功', 'succ');
        }
    }else {
        $info = show_msg('操作失败', 'err');
    }
    
}


$request = array();
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('info', $info);
LoaderSvc::loadSmarty()->display('merchant/add.tpl');