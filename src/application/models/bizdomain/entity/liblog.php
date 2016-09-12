<?php
class Liblog extends Entity
{
	const ID_OBJ  = 'liblog';

    const STATE_INITIAL = 1;
    const STATE_SUCC = 2;
    const STATE_FAIL = 3;

    static $STATE_OPTIONS = array(
        self::STATE_INITIAL,
        self::STATE_SUCC,
        self::STATE_FAIL,
    );
    static $STATE_CONF = array(
        self::STATE_INITIAL => array('NAME'=>'初始'),
        self::STATE_SUCC => array('NAME'=>'成功'),
        self::STATE_FAIL => array('NAME'=>'失败'),
    );
    static $STATE_CONF_STV = array(
        'STATE_INITIAL'=>self::STATE_INITIAL,
        'STATE_SUCC'=>self::STATE_SUCC,
        'STATE_FAIL'=>self::STATE_FAIL,
    );


    const TYPE_CO = 1;
    const TYPE_UP = 2;
    const TYPE_SSH = 3;

    static $TYPE_OPTIONS = array(
        self::TYPE_CO,
        self::TYPE_UP,
        self::TYPE_SSH,
    );
    static $TYPE_CONF = array(
        self::TYPE_CO => array('NAME'=>'检出'),
        self::TYPE_UP => array('NAME'=>'更新'),
        self::TYPE_SSH => array('NAME'=>'部署'),
    );
    static $TYPE_CONF_STV = array(
        'TYPE_CO'=>self::TYPE_CO,
        'TYPE_UP'=>self::TYPE_UP,
        'TYPE_SSH'=>self::TYPE_SSH,
    );

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->wid = $param['wid'];
        $obj->lid = $param['lid'];
		$obj->cmd = $param['cmd'];
		$obj->type = $param['type'];
		$obj->result = $param['result'];
		$obj->uid = $param['uid'];
		$obj->cat = $param['cat'];
		$obj->state = $param['state'];
		return $obj;

	}
}