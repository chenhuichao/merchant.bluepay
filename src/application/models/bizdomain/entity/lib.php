<?php
class Lib extends Entity
{
	const ID_OBJ  = 'lib';

    const STATE_CO = 1;
	const STATE_CO_SUCC = 2;
	const STATE_CO_FAIL = 3;
    const STATE_UP = 4;
    const STATE_UP_SUCC = 5;
    const STATE_UP_FAIL = 6;

	static $STATE_OPTIONS = array(

		self::STATE_CO,
		self::STATE_CO_FAIL,
        self::STATE_CO_SUCC,
        self::STATE_UP,
        self::STATE_UP_SUCC,
        self::STATE_UP_FAIL,
	);
	static $STATE_CONF = array(
		self::STATE_CO => array('NAME'=>'检出中'),
		self::STATE_CO_FAIL => array('NAME'=>'检出失败'),
        self::STATE_CO_SUCC => array('NAME'=>'检出成功'),
        self::STATE_UP => array('NAME'=>'更新中'),
        self::STATE_UP_SUCC => array('NAME'=>'更新成功'),
        self::STATE_UP_FAIL => array('NAME'=>'更新失败'),
	);

	static $STATE_CONF_STV = array(
		'STATE_CO'=>self::STATE_CO,
		'STATE_CO_FAIL'=>self::STATE_CO_FAIL,
        'STATE_CO_SUCC'=>self::STATE_CO_SUCC,
        'STATE_UP'=>self::STATE_UP,
        'STATE_UP_SUCC'=>self::STATE_UP_SUCC,
        'STATE_UP_FAIL'=>self::STATE_UP_FAIL,
	);

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->pid = is_null($param['pid']) ? 0 : intval($param['pid']);
		$obj->path = is_null($param['path']) ? '' : $param['path'];
        $obj->version = is_null($param['version']) ? 0 : intval($param['version']);
		$obj->state = in_array($param['state'],self::$STATE_OPTIONS) ? $param['state'] : 0;
		return $obj;
	}
}