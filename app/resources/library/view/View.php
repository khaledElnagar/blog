<?php namespace app\resources\library\view ;

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
    public function view($name , $data=NULL){
        if($data){
            extract($data);
        
        }
        
       $name = str_replace('.','/',$name);
       include "app/views/". $name .".php";
        
    }
    
    public function redirectTo($location, $message=""){
            
             //header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .'/blog/test.php' ); 
             //store message in sessions;
        
            
            header("Location: " . "http://" . $_SERVER['HTTP_HOST'] .$location ); 


        }
	

}
