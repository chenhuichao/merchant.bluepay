<?php
require_once dirname(dirname(dirname(__FILE__))).'/header.php';

$f_type = $_REQUEST['f_type'];
$f_name = $_REQUEST['f_name'];
$f_attr = $_REQUEST['f_attr'];
$f_default = $_REQUEST['f_default'];


//var_dump($_REQUEST);die();
//建立entity
$id_genter_start = $_REQUEST['id_genter_start'] ? $_REQUEST['id_genter_start'] : 0;
$entity = strtolower($_REQUEST['entity']);
$entity_ucfirst = ucfirst($entity);

$admin_index_file = EntitySvc::createAdminIndexFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);
$admin_add_file = EntitySvc::createAdminAddFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);
$admin_edit_file = EntitySvc::createAdminEditFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);


$entity_file  = EntitySvc::createEntityFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);

$create_sql = EntitySvc::createSQLFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);

$svc_file = EntitySvc::createSvcFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);

$dao_file = EntitySvc::createDaoFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);



$admin_index_tpl_file = EntitySvc::createAdminIndexTplFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);
$admin_add_tpl_file = EntitySvc::createAdminAddTplFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);
$admin_edit_tpl_file = EntitySvc::createAdminEditTplFile($f_type,$f_name,$f_attr,$f_default,$entity,$entity_ucfirst,$id_genter_start);

file_put_contents('/tmp/'.$entity.'_svc.php',$svc_file);
file_put_contents('/tmp/'.$entity.'_dao.php',$dao_file);
file_put_contents('/tmp/'.$entity.'.php',$entity_file);
file_put_contents('/tmp/'.$entity.'.sql',$create_sql);

if(!file_exists('/tmp/'.$entity)) mkdir('/tmp/'.$entity);
if(!file_exists('/tmp/'.$entity.'/index')) mkdir('/tmp/'.$entity.'/index');
file_put_contents('/tmp/'.$entity.'/index/index.php',$admin_index_file);

if(!file_exists('/tmp/'.$entity.'/add')) mkdir('/tmp/'.$entity.'/add');
file_put_contents('/tmp/'.$entity.'/add/index.php',$admin_add_file);

if(!file_exists('/tmp/'.$entity.'/edit')) mkdir('/tmp/'.$entity.'/edit');
file_put_contents('/tmp/'.$entity.'/edit/index.php',$admin_edit_file);

if(!file_exists('/tmp/view')) mkdir('/tmp/view');
if(!file_exists('/tmp/view/'.$entity)) mkdir('/tmp/view/'.$entity);
file_put_contents('/tmp/view/'.$entity.'/index.tpl',$admin_index_tpl_file);
file_put_contents('/tmp/view/'.$entity.'/add.tpl',$admin_add_tpl_file);
file_put_contents('/tmp/view/'.$entity.'/edit.tpl',$admin_edit_tpl_file);


//$move_file = 'mkdir '.ROOT_PATH.'/src/application/views/admin/'.$entity."\n";
$move_file.= 'cp -fr /tmp/view/'.$entity.'  '.ROOT_PATH.'/src/application/view/admin/'."\n";
$move_file.= 'cp -fr /tmp/'.$entity.'  '.ROOT_PATH.'/src/application/controller/admin/'."\n";

$move_file.= 'cp -f /tmp/'.$entity.'_svc.php '.ROOT_PATH.'/src/application/models/bizservice/'.$entity.'_svc.php'."\n";
$move_file.= 'cp -f /tmp/'.$entity.'_dao.php '.ROOT_PATH.'/src/application/models/bizdomain/dao/'.$entity.'_dao.php'."\n";
$move_file.= 'cp -f /tmp/'.$entity.'.php '.ROOT_PATH.'/src/application/models/bizdomain/entity/'.$entity.'.php'."\n";
$move_file.= 'cp -f /tmp/'.$entity.'.sql '.ROOT_PATH.'/src/database/'.$entity.'.sql'."\n";
file_put_contents('/tmp/'.$entity.'.sh',$move_file);
$rs = system('chmod 777 /tmp/'.$entity.'.sh');
if(0 == $rs){
	echo 'SUCC';
}else echo 'FAIL';
exit;

