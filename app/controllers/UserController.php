<?php namespace app\controller ;
use app\models\UserModel as UserModel;
use app\resources\library\view\View;
use app\resources\library\sessions\SessionHandler ;
use app\resources\library\database\DB;
use app\resources\library\sessions\Session ;
use app\resources\library\input\Input;
use app\resources\library\config\Config ;
use app\resources\library\validator\Validation;
use app\resources\library\sessions\Token;
use app\resources\library\authentication\Hash;
use app\resources\library\redirect\Redirect ;
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
    
    private $_userModel;
    private $_data ;
    private $_validator ;

    public function __construct() {
        $this->_userModel = new UserModel();
    }
    
    public function getUsers(){
      $this->_data =  $this->_userModel->getAll();
    }
    
    public function getById($id = 1){
        $this->_data = $this->_userModel->get(["id","=","1"])->results();
        
    }
    
    public function create(){
        return View::make("user.register");
    }
    public function validate(){
        $this->_validator  = new Validation("users");
        if(Input::exists()){
            if(Token::check(Input::get("_token"))){
                $validation = $this->_validator->check($_POST , array(
                   'username'=>array(
                       'required'=>true ,
                       'min'=> 3,
                       'max'=> 20,
                       'unique'=>'users'
                   ),
                   'email'=>array(
                       'required'=>true ,
                       'max'=> 255,
                       'email'=>'email',
                       'unique'=>'users'
                   ),
                   'name'=>array(
                       'required'=>true ,
                       'min'=> 3,
                       'max'=> 64,
                   ),
                   'password'=>array(
                       'required'=>true,
                       'min'=>6,
                       'max'=>255
                   ),
                   'confirm_password'=>array(
                       'required'=>true,
                       'matches'=>'password',
                   )
                ));

                if($this->_validator->passed()){
                    return true;
                 }
            }

        }
        return false;
    }
    
    public function store(){
        try{
            if($this->validate()){
                
                $salt = Hash::salt(32);
                $values = array();
                $values['username'] = Input::get('username');
                $values['password'] = Hash::make(Input::get('password'), $salt);
                $values['salt'] = $salt;
                $values['name'] = Input::get('name');
                $values['email'] = Input::get('email');
                $values['gp'] = 1;
                
                if(!$this->_userModel->insert($values)){
                    throw new Exception('Couldn\'t create a new account ');
                }  else {
                    Session::destroy();
                    Session::flash('success', 'Account registered successfuly , you can log in!');
                    Redirect::redirectTo('/');
                }
            }else{
                
                /**
                 * if not valid input values
                 * add inserted values to session to display it as input for user again
                 * and then redirect with errors 
                */
                
                foreach ($_POST as $name=>$value){
                    Session::put($name, Input::get($name));
                }
                Redirect::redirectTo('/user/create',  $this->_validator->errors());
            }
        }  catch (\Exception $e){
            die($e->getMessage());
        }
    }

    public function logout(){
        try {
            Session::destroy();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }
}
