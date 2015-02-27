<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 24.02.15
 * Time: 22:58
 */

class Contacts implements IContacts {

    public $id;
    public $contactsList;

    function __construct($id = null){
        $this->id = $id;
    }

    public function showList(){
        $this->contactsList = Globals::getInstance()->db->queryRows('SELECT * from contacts');

        return $this->contactsList;
    }

    public function showList2(){

        $contactsList = Globals::getInstance()->db->queryRows('SELECT c.*,p.title  from contacts as c
        INNER JOIN positions as p ON c.positionId = p.id');

        $cats = array();
        foreach ($contactsList as $cat) {
            $cats[$cat['parentId']][$cat['id']] = $cat;
        }
        return $cats;

    }

    public function addContact(){
        $newContanctId =  Globals::getInstance()->db->insert('contacts', array('name' => $_POST['name'], 'parentId' => (int)$_POST['parent'], 'positionId' => (int)$_POST['position'], 'email' => $_POST['email'], 'password' => md5($_POST['pass'])));
        return $this->saveNewRoleAuth($newContanctId, (int)$_POST['auth']);
    }

    public function getContact($id){

        $contact = Globals::getInstance()->db->queryRows("SELECT * from contacts
        INNER JOIN Auth on id = cId
        WHERE id = :userId", array(":userId" => $id));
        return $contact;
    }

    public function saveNewRoleAuth($contactId, $roleId){

        Globals::getInstance()->db->delete('Auth', 'cId = :userId', array(':userId' => intval($contactId)));
        Globals::getInstance()->db->insert('Auth', array('cId' => intval($contactId), 'rId' => intval($roleId)));
        return true;
    }

    public function saveContact($id){

        $this->saveNewRoleAuth($id, (int)$_POST['auth']);

        return Globals::getInstance()->db->sql("UPDATE contacts SET
        name = :name,
        parentId = :parentId,
        positionId = :positionId,
        password = :pass,
        email = :email
        WHERE id = :userId", array(':userId' => (int)$_POST['id'], ':name' => $_POST['name'], ':parentId' => (int)$_POST['parent'], ':positionId' => (int)$_POST['position'], ':email' => $_POST['email'], ':pass' => md5($_POST['pass'])));
    }


    public function deleteContact($id){
        return Globals::getInstance()->db->delete('contacts', 'id = :userId', array(':userId' => ($id)));
    }

    /**
     * Build tree of contacts
     *
     */
    public function buildTree($cats, $parent = null, $onlyParent = false)
    {
        if (is_array($cats) && !empty($cats[$parent])) {
            $tree = '<ul class="parents">';
            if ($onlyParent == false) {
                foreach ($cats[$parent] as $cat) {
                    $tree .= '<li>'.$cat['title'].',' . $cat['name'] . ' , ' . $cat['email'];
                    $tree .= $this->buildTree($cats, $cat['id']);
                    $tree .= '</li>';
                }
            } elseif (is_numeric($onlyParent)) {
                $cat = $cats[$parent][$onlyParent];
                $tree .= '<li>'.$cat['title'].', ' . $cat['name'] . ', ' . $cat['email'];
                $tree .= $this->buildTree($cats, $cat['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        } else return null;
        return $tree;
    }



} 