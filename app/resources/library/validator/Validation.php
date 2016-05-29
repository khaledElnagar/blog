<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\resources\library\validator;
use app\resources\library\database\DB ;
use app\resources\library\input\Input ;
/**
 * Description of Validation
 *
 * @author khaled
 */
class Validation {
    
    private $_errors= array();
    
    private $_db = null;
    
    private $_passed=false ;
    
    public function __construct($table) {
        $this->_db = new DB();
    }
    
    public function check ($inputArray , $items = array()){
        
        foreach($items as $item=>$rules){
            foreach ($rules as $rule=>$rule_value){
                
                $value = Input::get($item);
                
                   if(empty($value) && $rule ==='required'){
                       
                         $this->addError("{$item} is required" , $item);
                         
                    }else if(!empty ($value)){
                        
                     switch ($rule) {
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minmum of a {$rule_value} characters." , $item);
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of a {$rule_value}  characters.",$item);
                            }
                            break;
                        case 'matches':
                            if($value != $inputArray[$rule_value]){
                                $this->addError("{$item} must macthes {$rule_value}. " , $item);
                            }
                            break;
                        case 'unique':
                            $this->_db->setTable($rule_value);
                            
                            $check = $this->_db->get(array($item,"=",$value));
                            if($check->count()){
                                $this->addError("{$item} already exists. " , $item);
                            }
                            break;
                        case 'email':
                            if(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) === FALSE){

                                $this->addError("{$item} must be valid . " , $item);

                            }
                            break;

                        default:
                            break;
                    }
                }
            }
        }
        
        if(empty($this->errors())){
            $this->_passed = true ;
        }
    }
    
    private function addError($error,$item){
        $this->_errors[$item]= $error;
    }
    
    public function getError($item){
        return isset($this->_errors[$item])? $this->_errors[$item] : '';
    }

    public function errors(){
        return $this->_errors;
    }
    
    public function passed(){
        return $this->_passed;
    }
}
