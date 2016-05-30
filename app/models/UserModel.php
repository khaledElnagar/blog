<?php namespace app\models;
use app\resources\library\database\DB as DB;

class UserModel extends DB{
    
    public function __construct() {
        return parent::__construct("users");
    }
}   