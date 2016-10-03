<?php

class Adminuser extends Entity
{
	const ID_OBJ = 'adminuser';

	const STATUS_DISABLE = '0';
	const STATUS_ENABLE = '1';

	static $STATUS_STV = array(
		'STATUS_DISABLE' => self::STATUS_DISABLE,
		'STATUS_ENABLE' => self::STATUS_ENABLE,
	);

	static $STATUS_OPTIONS = array(
		self::STATUS_DISABLE,
		self::STATUS_ENABLE,
	);

	const RID_ADMIN = -400;
	const RID_ROOT = -500;

	static $RID_CONF = array(
		self::RID_ADMIN => array('NAME' => 'adminuser.entity.rid.admin'),
		self::RID_ROOT => array('NAME' => 'adminuser.entity.rid.root'),
	);

	static $RID_STV = array(
		'RID_ADMIN' => self::RID_ADMIN,
		'RID_ROOT' => self::RID_ROOT,
	);

	static $RID_OPTIONS = array(
		self::RID_ADMIN,
		self::RID_ROOT,
	);

	public static function createByBiz($param)
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->name = is_null($param['name']) ? '' : $param['name'];
		$obj->ename = is_null($param['ename']) ? '' : $param['ename'];
		$obj->email = is_null($param['email']) ? '' : $param['email'];
		$obj->depart = is_null($param['depart']) ? '' : $param['depart'];
		$obj->position = is_null($param['position']) ? '' : $param['position'];
		$obj->salt = $param['salt'];
		$obj->role = is_null($param['role']) ? '' : $param['role'];
		$obj->rid = in_array($param['rid'], self::$RID_OPTIONS) ? $param['rid'] : self::RID_GENERAL_STAFF;
		$obj->status = in_array($param['status'], self::$STATUS_OPTIONS) ? $param['status'] : self::STATUS_ENABLE;
		$obj->passwd = $param['passwd'];
		$obj->remark = is_null($param['remark']) ? '' : $param['remark'];
		
		return $obj;
	}
}