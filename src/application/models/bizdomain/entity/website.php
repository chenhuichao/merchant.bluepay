<?php
class Website extends Entity
{
	const ID_OBJ  = 'website';
	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->wname = $param['wname'];
		$obj->control = $param['control'];
		$obj->cpath = $param['cpath'];
		$obj->uid = $param['uid'];
		$obj->language = $param['language'];
		return $obj;

	}
}