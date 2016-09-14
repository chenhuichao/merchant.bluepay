<?php
class User extends Entity
{
	const ID_OBJ  = 'user';

	const IS_DEFAULT_NO = 0;
	const IS_DEFAULT_YES = 1;

	const STATE_DISABLE      		= 0;
	const STATE_ENABLE      		= 1;

	static $STATE_CONF = array(
		self::STATE_DISABLE => array('NAME' => '禁用'),
		self::STATE_ENABLE => array('NAME' => '启用'),
	);

	static $STATE_STV = array(
		'STATE_DISABLE'=>self::STATE_DISABLE,
		'STATE_ENABLE'=>self::STATE_ENABLE,
	);

	const ERR_USER_NOT_FOUND 		= -1;
	const ERR_USER_PASSWD_WRONG 		= -2;

	static $ERR_CONF_MSG = array(
		self::ERR_USER_NOT_FOUND =>'ERR_USER_NOT_FOUND',
		self::ERR_USER_PASSWD_WRONG =>'ERR_USER_PASSWD_WRONG',
	);

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->passwd = isset($param['passwd']) ? $param['passwd'] : '';
		$obj->pay_passwd = isset($param['pay_passwd']) ? $param['pay_passwd'] : '';
		$obj->mobile = isset($param['mobile']) ? $param['mobile'] : '';
		$obj->realname = isset($param['realname']) ? $param['realname'] : '';
		$obj->is_default = ($param['is_default'] === self::IS_DEFAULT_YES) ? self::IS_DEFAULT_YES : self::IS_DEFAULT_NO;
		$obj->state = ($param['state'] === self::STATE_ENABLE) ? self::STATE_ENABLE : self::STATE_DISABLE;
		$obj->salt = is_null($param['salt']) ? '' : $param['salt'];
		return $obj;
	}
}
