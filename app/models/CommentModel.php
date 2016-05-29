<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use app\resources\library\database\DB as DB ;
/**
 * Description of CommentModel
 *
 * @author khaled
 */
class CommentModel extends DB {
    //put your code here
    public function __construct() {
        return parent::getInstance();
    }
}
