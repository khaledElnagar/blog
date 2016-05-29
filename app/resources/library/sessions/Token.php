<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\resources\library\sessions;
use app\resources\library\config\Config ;
use app\resources\library\sessions\Session;
/**
 * Description of Token
 *
 * @author khaled
 */
class Token {

    public static function generate(){
       
        return Session::put(Config::get('session/token_name'),bin2hex(openssl_random_pseudo_bytes(16)));
    }
    
    public static function check($token){
        $token_name = Config::get('session/token_name');
        if(Session::exists($token_name)&& $token === Session::get($token_name) ){
            Session::delete($token_name);
            return true;
        }
        
        return false;
    }
}
