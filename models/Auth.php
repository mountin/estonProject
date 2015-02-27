<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 24.02.15
 * Time: 22:47
 */

class Auth {

    private $login, $password;
    public  $isLogined;
    private $roleName;

    CONST ADMIN_ROLE = 'admin';

    function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $this->isLogined = null;
        $this->roleName = null;

        $this->checkUser();
    }

    private function checkUser(){

         $loginInfo = Globals::getInstance()->db->queryRows("SELECT C.id, C.name, R.rolename, C.email FROM contacts as C
         INNER JOIN Auth as A on  C.id = A.cId
         INNER JOIN Roles as R on R.id = A.rId
         WHERE C.email =:email
         AND C.password = :password", array(":email" => $this->login, ":password" => md5($this->password)));
//var_dump($loginInfo);die;
        if(!empty($loginInfo) && ($loginInfo[0]['rolename'] == Auth::ADMIN_ROLE)){
            $this->isLogined      = true;
            $this->roleName       = $loginInfo[0]['rolename'];
            $_SESSION['login']    = $loginInfo[0]['email'];
            $_SESSION['name']     = $loginInfo[0]['name'];
            $_SESSION['roleName'] = $this->roleName;
        }

    }

    public static function getAllRoles(){
        return Globals::getInstance()->db->queryRows("SELECT * FROM Roles");
    }


    public static function logOut(){

        if(isset($_SESSION["login"]))
        {
            unset($_SESSION["login"]);
            unset($_SESSION["name"]);
            unset($_SESSION["roleName"]);
        }
        session_destroy();
    }

    public static function authUser($action){

            session_start();

        if(!isset($_SESSION["login"]) && ($action == 'showmain' ||  $action == 'login')){
            return true;

        }elseif($_SESSION["login"]){

            return true;

        }else{
            echo("Please login to see this page [<a href='index.php?action=login' target='_top'>LOGIN</a>]");
            exit();

        }
    }


}