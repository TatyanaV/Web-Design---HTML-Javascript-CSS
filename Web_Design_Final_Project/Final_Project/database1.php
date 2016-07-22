<?php
class Database 
{
	private static $dbName = 'vlaskint-db' ; 
	private static $dbHost = 'oniddb.cws.oregonstate.edu' ;
	private static $dbUsername = 'vlaskint-db';
	private static $dbUserPassword = 'tb0NGWMdrkGhe2mA';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>