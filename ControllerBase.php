<?php
require_once ('MysqliDb.php');
abstract class ControllerBase{
    protected static $db;

    function __construct()
    {
        self::$db = new MysqliDb ('localhost', 'root', 'root', 'hkblog');
        /*
        self::$db = new MysqliDb (Array (
                        'host' => 'host',
                        'username' => 'username', 
                        'password' => 'password',
                        'db'=> 'databaseName',
                        'port' => 3306,
                        'prefix' => 'my_',
                        'charset' => 'utf8'));
        */
        
    }

    abstract protected function GetData($params);
    abstract protected function SetData($params); 
}
