<?php
//scr/WijnshopTest/Data/DBConfig.php

namespace WijnshopTest\Data;

//use PDO;
class DBConfig { 
    
    public static $DB_CONNSTRING = "mysql:host=localhost;dbname=wijndb;charset=utf8"; 
    public static $DB_USERNAME = "root"; 
    public static $DB_PASSWORD = ""; 
    
    
    
}









/*class DBConfig
{
    private static $dbName = 'wijndb' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont  = null;
     
    public function __construct() {
        die('Niet toegestaan');
    }
     
    public static function connect()
    {
       
       if ( null != self::$cont ){
           throw new DBException();
       }
       elseif ( null == self::$cont )
       {  
        
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
          //self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
        }
        
       }
    public static function disconnect()
    {
        self::$cont = null;
    }
}*/
