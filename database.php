<?php
//https://www.startutorial.com/articles/view/php-crud-tutorial-part-1


class Database
{
    
    private static $dbName = 'thesis' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'root';
    /*
    private static $dbName = 'a17_formula' ;
    private static $dbHost = 'studev.groept.be' ;
    private static $dbUsername = 'a17_formula';
    private static $dbUserPassword = 'zo1jrzrf';
    */

    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
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