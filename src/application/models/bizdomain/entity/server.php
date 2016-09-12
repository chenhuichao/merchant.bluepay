<?php
class Server extends Entity
{
	const ID_OBJ  = 'server';

    const STATE_SUCC = 1;
    const STATE_FAIL = 2;

    static $STATE_OPTIONS = array(
        self::STATE_SUCC,
        self::STATE_FAIL,
    );
    static $STATE_CONF = array(
        self::STATE_SUCC => array('NAME'=>'启用'),
        self::STATE_FAIL => array('NAME'=>'禁用'),
    );
    static $STATE_CONF_STV = array(
        'STATE_SUCC'=>self::STATE_SUCC,
        'STATE_FAIL'=>self::STATE_FAIL,
    );

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->sgid = $param['sgid'];
		$obj->ip = $param['ip'];
		$obj->spath = $param['spath'];
		$obj->stype = $param['stype'];
		$obj->port = $param['port'];
		$obj->sname = $param['sname'];
		$obj->spass = $param['spass'];
		$obj->edition = $param['edition'];
        $obj->exclude = $param['exclude'];
		$obj->status = $param['status'];
		return $obj;

	}
}