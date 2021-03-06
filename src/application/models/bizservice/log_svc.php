<?php
class LogSvc
{/*{{{*/
	const OBJ = 'Log';
    static $_box = array();

    public static function getSqlLog()
    {/*{{{*/
        return self::getLogTpl( 'sql' );
    }/*}}}*/

    public static function getFinanceSqlLog()
    {/*{{{*/
        return self::getLogTpl( 'financesql' );
    }/*}}}*/

    public static function getBizErrLog()
    {/*{{{*/
        return self::getLogTpl( 'biz_err', true );
    }/*}}}*/

    public static function getSysErrLog()
    {/*{{{*/
        return self::getLogTpl( 'sys_err', true );
    }/*}}}*/

    public static function getQuerySecurityLog()
    {/*{{{*/
        return self::getLogTpl( 'admin_query_security', true );
    }/*}}}*/

    public static function getPayNotifyLog()
    {/*{{{*/
        return self::getLogTpl( 'pay_notify', true );
    }/*}}}*/

    public static function get( $name ,$only = false)
    {/*{{{*/
        return self::getLogTpl( $name ,$only);
    }/*}}}*/

    private static function getLogTpl( $type, $only = false )
    {/*{{{*/
        $obj_name = '_'.$type.'_log';
        if ( array_key_exists( $type, self::$_box ) )
        {
            return self::$_box[$type];
        }

        $fname = $_SERVER['ENV_APPLOGS_DIR'].'/'.$type.'.log';
		if(isset($_SERVER['SHELL']))
		{
			$fname.= '_shell';
		}
	    if ( !$only )
        {
            $fname.= '.'.date('Ymd');
        }
        self::$_box[$type] = new LogObject( $fname );
        return self::$_box[$type];
    }/*}}}*/

	
	public static function fileLog($fname,$log)
	{
		if(is_array($log)){
			$log = var_export($log,TRUE);
		}
		$log = date('Y-m-d H:i:s')."  :\n".$log;
		$log .= "\n";
		file_put_contents($fname.'-'.date('Ymd').'.txt',$log,FILE_APPEND);
	}
	
	 public static function loginLog( $param )
    {/*{{{*/
        return self::getDao()->loginLog( $param );
    }/*}}}*/

	 public static function writeLog( $action,$content )
    {/*{{{*/
        return self::getDao()->writeLog( $action,$content );
    }/*}}}*/
	public static function getLogs($table,$options=array(), $request = array())
	{

		if($request['username'])
		{
			$request_param[] = 'username='.$request['username'];
			$sql_condition[] = 'username=?';
			$sql_param[] = $request['username'];
		}
		if($request['kw'])
		{
			$request_param[] = 'kw='.$request['kw'];
			$sql_condition[] = '`content` like ?';
			$sql_param[] = '%'.$request['kw'].'%';
		}
		if($request['start'])
		{
			$request_param[] = 'start='.$request['start'];
			$sql_condition[] = 'action_time >= ?';
			$sql_param[] = $request['start'];
		}
		if($request['end'])
		{
			$request_param[] = 'end='.$request['end'];
			$sql_condition[] = 'action_time<=?';
			$sql_param[] = $request['end'];
		
		}

		return self::getDao()->getLogs($table,$options, $request, $request_param, $sql_condition,$sql_param);
	}
	public static function getDetailByid($id)
	{
		return self::getDao()->getDetailByid($id);
	}

	public static function delLog($id)
	{
		return self::getDao()->delLog($id);
	}

	public static function getRunningLog($id)
	{
		return self::getDao()->getRunningLog($id);
	}
	static private function getDao()
    {/*{{{*/
        return LoaderSvc::loadDao( self::OBJ );
    }/*}}}*/
}/*}}}*/
?>
