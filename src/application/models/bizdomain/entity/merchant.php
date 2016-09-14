<?php
class Merchant extends Entity
{
	const ID_OBJ  = 'merchant';

	const TYPE_COMPANY = 1;
	const TYPE_PERSONAL = 2;

	static $TYPE_OPTIONS = array(
		self::TYPE_COMPANY,
		self::TYPE_PERSONAL,
	);

	static $TYPE_CONF = array(
		self::TYPE_COMPANY => array('NAME'=>'企业'),
		self::TYPE_PERSONAL => array('NAME'=>'个人'),
	);

	static $TYPE_CONF_STV = array(
		'TYPE_COMPANY'=>self::TYPE_COMPANY,
		'TYPE_PERSONAL'=>self::TYPE_PERSONAL,
	);

	const STATE_INIT = 1;
	const STATE_WAIT_AUDIT = 2;
    const STATE_REJECTED = 3;

    const STATE_VALID = 4;
	const STATE_INVALID = 5;

	static $STATE_OPTIONS = array(
		self::STATE_VALID,
		self::STATE_INVALID,
	);
	static $STATE_CONF = array(
		self::STATE_INIT => array('NAME'=>'初始'),
		self::STATE_WAIT_AUDIT => array('NAME'=>'待审核'),
		self::STATE_REJECTED => array('NAME'=>'已驳回'),
		self::STATE_VALID => array('NAME'=>'生效'),
		self::STATE_INVALID => array('NAME'=>'无效'),
	);

	static $STATE_CONF_STV = array(
		'STATE_INIT'=>self::STATE_INIT,
		'STATE_WAIT_AUDIT'=>self::STATE_WAIT_AUDIT,
        'STATE_REJECTED'=>self::STATE_REJECTED,
        'STATE_VALID'=>self::STATE_VALID,
        'STATE_INVALID'=>self::STATE_INVALID,
	);

	public static function createByBiz( $param )
	{
		$cls = __CLASS__;
		$obj = new $cls();
		$obj->id = LoaderSvc::loadIdGenter()->create(self::ID_OBJ);
		$obj->ctime = date('Y-m-d H:i:s');
		$obj->utime = date('Y-m-d H:i:s');
		$obj->type = in_array($param['type'],self::$TYPE_OPTIONS) ? $param['type'] : 0;
		$obj->mobile = is_null($param['mobile']) ? '' : $param['mobile'];
		$obj->email = is_null($param['email']) ? '' : $param['email'];

		$obj->nick_name = is_null($param['nick_name']) ? '' : $param['nick_name'];
		$obj->real_name = is_null($param['real_name']) ? '' : $param['real_name'];
		$obj->bank_card_no = is_null($param['bank_card_no']) ? '' : $param['bank_card_no'];
		$obj->bank_name = is_null($param['bank_name']) ? '' : $param['bank_name'];
		$obj->bank_of_deposit = is_null($param['bank_of_deposit']) ? '' : $param['bank_of_deposit'];

		$obj->id_pic = is_null($param['id_pic']) ? '' : $param['id_pic'];
		$obj->id_no = is_null($param['id_no']) ? '' : $param['id_no'];
		$obj->company_name = is_null($param['company_name']) ? '' : $param['company_name'];
		$obj->contact = is_null($param['contact']) ? '' : $param['contact'];

		$obj->business_license_no = is_null($param['business_license_no']) ? '' : $param['business_license_no'];
		$obj->business_license_pic = is_null($param['business_license_pic']) ? '' : $param['business_license_pic'];

		$obj->state = in_array($param['state'],self::$STATE_OPTIONS) ? $param['state'] : 0;
		return $obj;
	}
}