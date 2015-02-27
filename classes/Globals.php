<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 24.02.15
 * Time: 23:58
 */
//autoloaded classes
function __autoload($classname)
{
    $filename = "models/" . $classname . ".php";
    if (!file_exists($filename)) {
        $filename = "dao/" . $classname . ".php";
    }
    if (!file_exists($filename)) {
        $filename = "classes/" . $classname . ".php";
    }
    if (!file_exists($filename)) {
        $filename = "Interface/" . $classname . ".php";
    }
    include_once($filename);
}

class Globals
{
    private $pdo;
    public $db;
    private static $instanceDb;

    private function __construct()
    {
        //connect and use PDO  through $db
        $this->pdo = new PDO('mysql:host=localhost;dbname=adressbook', 'root', '');
        $this->db = new Db($this->pdo);
    }

    //only one instance
    public static function getInstance()
    {
        if (self::$instanceDb != null) {
        } else {
            self::$instanceDb = new Globals();
        }
        return self::$instanceDb;
    }

    private function __clone(){

    }

}