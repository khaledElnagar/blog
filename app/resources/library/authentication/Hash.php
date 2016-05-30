<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\resources\library\authentication;
/**
 * Description of Hash
 *
 * @author khaled
 */

class Hash {
    
    public static function make($password , $salt = ''){
        return hash('sha512' , $password . $salt) ;
    }
    
    public static function salt($length){
        return mcrypt_create_iv($length);
    }
    
    public static function unique(){
        return self::make(uniqid());
    }
    
}
