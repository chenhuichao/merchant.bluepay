<?php
class Pos extends Entity
{
	const ID_OBJ  = 'pos';

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create( self::ID_OBJ );
		$obj->sn = $param['sn'];
		$obj->merchant_id = intval($param['merchant_id']);
		$obj->user_id = intval($param['user_id']);
		$obj->cptime = date('Y-m-d H:i:s');
		$obj->uptime = date('Y-m-d H:i:s');
		return $obj;
	}
}