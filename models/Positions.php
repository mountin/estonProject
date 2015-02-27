<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 25.02.15
 * Time: 0:10
 */

class Positions {

    public function showAllPositions(){

        return Globals::getInstance()->db->queryRows("SELECT * from positions");

    }
} 