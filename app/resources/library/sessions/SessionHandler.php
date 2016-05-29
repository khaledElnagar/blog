<?php namespace app\resources\library\sessions;
use app\resources\library\database\DB as DB;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SessionHandler
 *
 * @author khaled
 */
class SessionHandler  implements \SessionHandlerInterface {
    
    protected $db;
    protected $expiry;
    protected $stmt;
    protected $conn; 
 

    public function open ($save_path, $name){
         try {
                          
            ini_set('session.gc_maxlifetime',5);
            $this->db = new DB("sessions");
            $this->expiry = time() + (int)ini_get('session.gc_maxlifetime');
            
        } catch (\PDOException $e) {
            
            die($e->getMessage());
        }
        
       return true;

        
    }
    
    public function close() {
    
        return true;
    }
    
    public function destroy ($session_id){
        try{
            
        $this->db->delete(array("id" ,"=" , $session_id));
        
        }  catch (\PDOException $e){
            
            die($e->getMessage());
        }

        return true ;
    }

    public function gc ($maxlifetime){
        try{
      //  $this->db->delete(array("last_update",">",  $this->expiry));
        
        return true;
        }catch (\PDOException $e){
            
            die($e->getMessage());
        }
        
    }
    
    public function read($session_id) {

        try{
            
        
        if (!empty($this->db->get(array("id","=",$session_id)))) {
            $result = $this->db->results();
            if(isset($result[0])){
                 return $result[0]['session_data']  ;
            }  else {
                return '';    
            }
        }
        }catch (\PDOException $e){
            
            die($e->getMessage());
        }
       
    }
    
    public function write($session_id, $session_data) {
        try{
            
            $now = time();
            print_r($session_data);
            $values = array(
                   "id"=>$session_id,
                    "session_data"=>$session_data,
                    "last_update" => date('Y-m-d H:i:s',$now),
                    "expiry"=> date('Y-m-d H:i:s',$this->expiry)
                );
            
            $this->db->query("INSERT INTO sessions (id,session_data,last_update,expiry) values (:id,:session_data,:last_update,:expiry)"
                    . "ON DUPLICATE KEY UPDATE session_data = values(session_data) ,last_update=values(last_update) , expiry=values(expiry)",$values , false);
            
            return TRUE;
             
          
        }  catch (\PDOException $e){
            
            die($e->getMessage());
        }
    }
  
}
