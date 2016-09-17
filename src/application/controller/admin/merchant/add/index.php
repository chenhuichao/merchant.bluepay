<?php
require_once dirname(dirname(dirname(__FILE__))) . '/header.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$info = '';
if ($action == 'do') {
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

ret:
$request = array();
$request['STATE_CONF'] = User::$STATE_CONF;
$request['TYPE_CONF'] = User::$TYPE_CONF;
$request['STATE_STV'] = User::$STATE_STV;
$request['TYPE_STV'] = User::$TYPE_STV;
LoaderSvc::loadSmarty()->assign('request',$request);
LoaderSvc::loadSmarty()->assign('info', $info);
LoaderSvc::loadSmarty()->display('merchant/add.tpl');