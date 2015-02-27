<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 26.02.15
 * Time: 11:12
 */

class ContactsValidateProxy implements IContacts{

    private  $checkContact = null;
    private $userId;

    function __construct($checkContact)
    {
        $this->checkContact = $checkContact;
    }

    function addContact()
    {

        if(!is_string($_POST["name"])){

            return false;
        }
        if(!preg_match('/[@]/', $_POST["email"])){
            return false;
        }

        if(mb_strlen($_POST["pass"], 'UTF-8') < 5){
            return false;
        }

        if(!empty($this->id)){
            return $this->checkContact->saveContact($this->id);
        }
        return $this->checkContact->addContact();
    }

    function saveContact($id)
    {
        $this->userId = (int)$id;
        return $this->addContact();
    }


    function saveNewRoleAuth($contactId, $roleId)
    {
        // TODO: Implement saveNewRoleAuth() method.

        if(is_int($contactId) && is_int($roleId))
            return $this->checkContact->saveNewRoleAuth($contactId, $roleId);

    }

    function deleteContact($id)
    {
        // TODO: Implement deleteContact() method.
        return $this->checkContact->deleteContact($id);
    }

    function showList()
    {
        return $this->checkContact->showList();
    }
    function showList2()
    {
        return $this->checkContact->showList2();
    }



}