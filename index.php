<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 24.02.15
 * Time: 23:34
 */
include ('classes/Globals.php');

//Define important variable
$id     =   intval(isset($_GET['id']) ? $_GET['id'] : 0);
$action =   addslashes(isset($_GET['action']) ? $_GET['action'] : 'showmain');
$login  =   addslashes(trim(isset($_POST['LOGIN']) ? $_POST['LOGIN']:''));
$password = addslashes(trim(isset($_POST['PASSWORD']) ? $_POST['PASSWORD']:''));

//Make simple authentication
Auth::authUser($action);

$contact = new Contacts();
$newContacts = ContactsFactory::Factory();

//make simple kind of controller for MVC
switch($action){
    case 'showmain':
        $contacts2 = $contact->showList2();
        include_once('view/main.php');
        break;


    case 'showlist':
        $contacts = $newContacts->showList();

        //for tree building
        $contacts2 = $newContacts->showList2();
        include_once('view/contactslist.php');
        break;


    case 'addcontact':
        if(!empty($_POST) && $_POST['id'] == null){
            if($newContacts->addContact())
                header("Location: ?action=showlist");
            else
                die('Error in saving or Incorrect Input data');
        }

        $posit = new Positions();
        $positions = $posit->showAllPositions();
        $contacts = $newContacts->showList();
        $auths = Auth::getAllRoles();
        include_once('view/addform.php');
        break;


    case 'editcontact':
        if(!empty($_POST) && $_POST['id'] > 0){
            if($newContacts->saveContact($id))
                header("Location: ?action=showlist");
            else
                die('Error in saving or Incorrect Input data');
        }
        $contactInfo = $contact->getContact($id);

        $posit = new Positions();
        $positions = $posit->showAllPositions();
        $contacts = $newContacts->showList();
        $auths = Auth::getAllRoles();
        include_once('view/addform.php');
        break;


    case 'deletecontact':
        $newContacts->deleteContact($id);
        header("Location: ?action=showlist");
        break;



    case 'login':
        if(!empty($_POST) && !empty($password)){
            $auth = new Auth($login, $password);
            if($auth->isLogined){
                header("Location: ?action=showlist");
            }else{
                $wrongPass = true;
            }
        }
        include_once('view/auth.php');
        break;



    case 'logout':
        Auth::logOut();
        header("Location:?");
        break;

}
