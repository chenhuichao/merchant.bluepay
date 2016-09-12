<?php
class LoaderSvc
{/*{{{*/
    private static $_db		= null;
    //private static $_db_r	= null;
    //private static $_db_f	= null;

    public static function init()
    {/*{{{*/
        self::setExecutorConf();		
	//self::setSlaveExecutorConf();
    }/*}}}*/

    public static function setExecutorConf()
    {/*{{{*/
        self::$_db = array(
			'host' => $_SERVER['ENV_DB_HOST'],
			'port' => $_SERVER['ENV_DB_PORT'],
			'user' => $_SERVER['ENV_DB_USER'],
			'pass' => $_SERVER['ENV_DB_PASS'],
			'name' => $_SERVER['ENV_DB_NAME'],
		);
    }/*}}}*/

    public static function setSlaveExecutorConf()
    {/*{{{*/
        self::$_db_r = array(
			'host' => $_SERVER['ENV_DB_HOST_R'],
			'port' => $_SERVER['ENV_DB_PORT_R'],
			'user' => $_SERVER['ENV_DB_USER_R'],
			'pass' => $_SERVER['ENV_DB_PASS_R'],
			'name' => $_SERVER['ENV_DB_NAME_R'],
	);
    }/*}}}*/

    public static function loadExecutor()
    {/*{{{*/
        $obj = ObjectFinder::find( 'SQLExecutor' );
        if ( is_object( $obj ) )
        {
            return $obj;
        }

        if ( is_null( self::$_db ) )
        {
            return null;
        }

        $obj = new SQLExecutor( self::$_db );
        $obj->regLogObj( LogSvc::getSqlLog() );
        ObjectFinder::register( 'SQLExecutor', $obj );
        return $obj;
    }/*}}}*/
    public static function loadSlaveExecutor()
    {/*{{{*/
        $obj = ObjectFinder::find( 'SQLExecutorSlave' );
        if ( is_object( $obj ) )
        {
            return $obj;
        }

        if ( is_null( self::$_db_r ) )
        {
            return null;
        }

        $obj = new SQLExecutor( self::$_db_r );
        $obj->regLogObj( LogSvc::getSqlLog() );
        ObjectFinder::register( 'SQLExecutorSlave', $obj );
        return $obj;
    }/*}}}*/
    
    public static function loadIdGenter()
    {/*{{{*/
        $obj = ObjectFinder::find( 'IDGenter' );
        if ( is_object( $obj ) )
        {
            return $obj;
        }

        $obj = new IDGenter( self::loadExecutor() );
        ObjectFinder::register( 'IDGenter', $obj );
        return $obj;
    }/*}}}*/

    public static function loadDao( $entity )
    {/*{{{*/
        $cls = $entity.'Dao';
        $dao = ObjectFinder::find( $cls );
        if ( is_object( $dao ) )
        {
            return $dao;
        }

        $dao = new $cls();
        ObjectFinder::register( $cls, $dao );
        return $dao;
    }/*}}}*/

    public static function regSess( $name )
    {/*{{{*/
        $obj = new MysqliSessDriver();
        $svc = new SessionSvc( $name, $obj );
        ObjectFinder::register( 'SessSvc', $svc );
    }/*}}}*/

    public static function loadSmarty()
    {/*{{{*/
        $obj = ObjectFinder::find('Smarty');
        if ( is_object( $obj ) )
        {
            return $obj;
        }

        $obj = new Smarty();
        ObjectFinder::register( 'Smarty', $obj );
        return $obj;
    }/*}}}*/
	
    public static function loadSess()
    {/*{{{*/
        return ObjectFinder::find('SessSvc');
    }/*}}}*/

    public static function loadDBCache()
    {/*{{{*/
	$obj = ObjectFinder::find('DBCache');
        if ( is_object( $obj ) )
        {
            return $obj;
        }
	$obj = new DBCache();
        ObjectFinder::register( 'DBCache', $obj );
        return $obj;
    }/*}}}*/

	

}/*}}}*/
