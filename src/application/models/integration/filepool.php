<?php
class Filepool
{/*{{{*/
	const TABLE_NAME = 'filepool';
	const REMOTE_KEY = "o0fk34*(#Rfvasd";

	static public function getExecutor( )
	{/*{{{*/
		return LoaderSvc::loadExecutor();
	}/*}}}*/

    static public function get( $skey )
    {/*{{{*/
        $sql = "select value from ".self::TABLE_NAME." where skey=?";
		$args = array(md5($skey.self::REMOTE_KEY));
		$result = self::getExecutor()->query($sql,$args);
		if(!empty($result))
			return unserialize($result['value']);
		else
			return false;
    }/*}}}*/

    static public function set( $skey, $value )
    {/*{{{*/
		$sql = "replace into ".self::TABLE_NAME." (skey,value)values(?,?)";
		$args = array(md5($skey.self::REMOTE_KEY),serialize($value) );
        return self::getExecutor()->exeNoQuery($sql,$args);
    }/*}}}*/

	static public function destroy( $skey )
	{/*{{{*/
        $sql = "delete from ".self::TABLE_NAME." where skey=?";
		$args = array(md5($skey));
		return self::getExecutor()->exeNoQuery($sql,$args);
	}/*}}}*/
}/*}}}*/