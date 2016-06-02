<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\resources\library\authentication;
use app\resources\library\database\DB ;
use app\resources\library\authentication\Hash;
use app\resources\library\config\Config;
use app\resources\library\sessions\Session;

/**
 * Description of User
 *
 * @author khaled
 */
class Authentication {
    
    private  $_db ;
    private $_data;
    private $_sessionName;
    private $_id = '';

    public  function __construct() {
        $this->_db = new DB('users');
        $this->_sessionName = Config::get('session/session_name');

    }

    public function login($identifier , $password){
        if($this->check($identifier)){
            if($this->_data[0]['password']=== Hash::make($password, $this->_data[0]['salt'])){
                
             Session::put($this->_sessionName, $this->_data[0]['id']);
             $this->_id = $this->_data[0]['id'];
                return true;
            }else
            {
                return false;
            }
        }
        return FALSE;
    }
    
    private function check($identifier){
        
        if(!empty($this->_data = $this->_db->get(array('username','=',$identifier))->results()) ||
            !empty($this->_data = $this->_db->get(array('email','=',$identifier))->results())){
            
            return TRUE;
        } 
        
       
        
        return FALSE;
    }
    
    public function getAuthenticatedId(){
        return $this->_id;
    }
}
