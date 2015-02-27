<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 26.02.15
 * Time: 11:15
 */

class ContactsFactory {

    public static function Factory() {

        return new ContactsValidateProxy(new Contacts());

    }
}