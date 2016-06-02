<?php namespace app\resources\library\view ;
use app\resources\library\sessions\Session ;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author khaled
 */
class View {
    
    /**
     * include views
     * @param type $name
     * @param type $data
     */
    public static function make($name , $data=NULL){
        if($data){
            extract($data);
        
        }
        
       $name = str_replace('.','/',$name);
       include "app/views/". $name .".php";
       exit();
        
    }
}
