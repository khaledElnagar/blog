<?php namespace app\models;

/**
 * Description of PostModel
 *
 * @author khaled
 */
    use app\resources\library\database\DB as DB;  
class PostModel extends DB  {
    
    public function __construct() {
        return parent::__construct("posts");
       // return new DB("posts");
    }
    
}
