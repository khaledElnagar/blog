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

    public static function exists($name){
        self::checkSessionStatus();
        return (isset($_SESSION[$name]) && !empty($_SESSION[$name])) ? true : false  ;
    }

    public static function put($name , $value){
        self::checkSessionStatus();
        return $_SESSION[$name] = $value;
    }
    
    public static function get($name){
        self::checkSessionStatus();
        return isset($_SESSION[$name])? $_SESSION[$name]: '';
    }

    public static function delete($name){
        self::checkSessionStatus();
        if(self::exists($name)){
            self::put($name, '') ;
        }
    }
    
    public static function destroy(){
        self::checkSessionStatus();
        session_destroy();
        session_commit();
    }

    public static function flash($name , $value =''){
        self::checkSessionStatus();
        if(self::exists($name)){
            
            $session_data = self::get($name);
            self::delete($name);
            return $session_data;
        }  else {
            self::put($name, $value);
        }
        
    }
    
    private static function checkSessionStatus(){
         if (session_status() == PHP_SESSION_NONE) {
             session_start();
            }
    }
    
}
