<?php
require_once dirname(dirname(dirname(__FILE__))) . '/header.php';

$type = isset($_GET['type']) ? $_GET['type'] : null;

$id = $_REQUEST['id'] > 0 ? $_REQUEST['id'] : 0;
$record = AdminuserSvc::getById($id);

$info = '';
if ($type == 'save' && is_object($record)) {
    $name = trim($_POST['name']);
    $ename = trim($_POST['ename']);
    $depart = $_POST['depart'];
    $position = $_POST['position'];
    if (isset($_POST['passwd'])) {
        $passwd = trim($_POST['passwd']);
    }

    $email = trim($_POST['email']);
    $rid = ($_POST['rid'] > 0 || in_array($_POST['rid'],Adminuser::$RID_OPTIONS)) ? intval($_POST['rid']) : 0;
    if(($rid == Adminuser::RID_ROOT || $record->rid == Adminuser::RID_ROOT)&& (AdminuserSvc::getById($uid)->rid != Adminuser::RID_ROOT)){
        $info = show_msg('权限拒绝', 'err');
    }else{
        $rrecord = RoleSvc::getById($rid);
        $role = is_object($rrecord) ? $rrecord->name : '-';

        $status = in_array($_POST['status'], array(
            Adminuser::STATUS_DISABLE,
            Adminuser::STATUS_ENABLE
        )) ? $_POST['status'] : Adminuser::STATUS_DISABLE;
        $remark = $_POST['remark'];

        if (!empty($name) && !empty($email)) {
            $arr = AdminuserSvc::getByEmail($email);
            if(!empty($arr) && $arr['id'] !=$id){
                $info = show_msg('用户已存在', 'err');
            }else{
                $params = array(
                    'name' => $name,
                    'ename' => $ename,
                    'status' => $status,
                    'depart' => $depart,
                    'position' => $position,
                    'email' => $email,
                    'rid' => $rid,
                    'role' => $role,
                    'remark' => $remark,
                );
                if(strlen($passwd) >=6){
                    $params['passwd'] = md5($passwd.md5($record->salt));
                }
                AdminuserSvc::UpdateById($id, $params);
                $record = AdminuserSvc::getById($id);
                $info = show_msg('操作成功', 'succ');
            }

        }else{
            $info = show_msg('操作失败', 'err');
        }
    }
}
$request = array();
$request['RID_CONF'] = Adminuser::$RID_CONF;
$request['RID_STV'] = Adminuser::$RID_STV;
LoaderSvc::loadSmarty()->assign('rid',$rid);
LoaderSvc::loadSmarty()->assign('request',$request);

LoaderSvc::loadSmarty()->assign('info', $info);
LoaderSvc::loadSmarty()->assign('record', $record);
LoaderSvc::loadSmarty()->display('admin-user/edit.tpl');
