<?php namespace app\controller ;
use app\models\UserModel as UserModel;
use app\resources\library\view\View;
use app\resources\library\sessions\SessionHandler ;
use app\resources\library\database\DB;
use app\resources\library\sessions\Session ;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserController
 *
 * @author khaled
 */

class UserController {
    //put your code here
    
    private $userModel;
    private $view ;
    protected $data ;
    public function __construct() {
        $this->userModel = new UserModel();
        $this->view = new View();
    }
    
    public function getUsers(){
      $this->data =  $this->userModel->getAll();
    }
    
    public function getById($id = 1){
        $this->data = $this->userModel->get(["id","=","1"])->results();
        
    }
    
    public function create(){
        return $this->view->view("user.register");
    }

   public function logout(){
        try {
            Session::delete('visits');
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
