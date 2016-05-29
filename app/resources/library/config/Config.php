<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\resources\library\config; 
/**
 * Description of config
 *
 * @author khaled
 */
class Config {

    public static function get($path = NULL){
        if(!empty($path)){
            $config = (require ROOT.'/app/config/config.php');
            $path = explode('/',$path);
            foreach ($path as $element){
                if(isset($config[$element])){
                    $config = $config[$element];
                }
            }
            return $config;
        }
        
        return false;
    }
}
