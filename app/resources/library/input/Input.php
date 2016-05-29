<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\resources\library\input;
/**
 * Description of Input
 *
 * @author khaled
 */
class Input {
    
    public static function exists($type='post'){
        switch ($type) {
            case 'post':
                return  (!empty($_POST))? true : false;

                break;
            case 'get':
                return  (!empty($_GET))? true : false;

                break;
            default:
                break;
        }
    }
    
    public static function get($item){
        if(isset($_POST[$item])){
            return filter_input(INPUT_POST, $item, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }else if (isset($_GET[$item])){
            return filter_input(INPUT_GET, $item, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
        
        return '' ;
    }
}
