<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\resources\library\redirect;
use app\resources\library\view\View ;
use app\resources\library\sessions\Session;
/**
 * Description of Redirect
 *
 * @author khaled
 */
class Redirect {
        
    public static function redirectTo($location, $message=""){

        //store message in sessions;
       if(is_numeric($location)){
           switch ($location){
           case 404:
               header('HTTP/1.0 404 Not Found');
               View::make("errors.404");
               exit();
               break;
           }
       }
       if(isset($message)){
           Session::put('message', $message);
       }

       header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$location ); 
       exit();

    }
        
}
