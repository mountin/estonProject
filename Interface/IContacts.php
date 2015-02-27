<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 26.02.15
 * Time: 10:41
 */

interface IContacts {

    function addContact();
    function saveContact($id);
    function saveNewRoleAuth($contactId, $roleId);
    function deleteContact($id);
    function showList();

} 