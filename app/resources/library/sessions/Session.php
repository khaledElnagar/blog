<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\resources\library\sessions;

/**
 * Description of Session
 *
 * @author khaled
 */
class Session {

    public static function put($name , $value){
        return $_SESSION[$name] = $value;
    }
    
    public static function exists($name){
      
        return (isset($_SESSION[$name])) ? true : false  ;
    }
    
    public static function get($name){
        return $_SESSION[$name];
    }

        public static function delete($name){
        
        if(self::exists($name)){
            session_unset($name);
                     print_r($_SESSION);


        }
    }
}
