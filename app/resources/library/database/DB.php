<?php namespace app\resources\library\database;
use app\resources\library\config\Config ;
 class DB {
   
     
     /**
      *
      * @object type
      * 
      * stores pdo object to use
      */
     private $_pdo;
     
    /**
     *
     * @string type
     * 
     * last query executed
     */
     
     private $_query;
     
     /**
      *
      * @boolean type
      * 
      * display error or not
      * 
      */
     private $_error=false;
     
     /**
      *
      * @var type
      * 
      * stores result of query
      * 
      */
     private $_results;
     
     /**
      *
      * @int type
      * 
      * check for returned result count
      * 
      */
     private $_count = 0;
     
     /**
      *
      * @string type 
      * 
      */
     private $_table  ;


    public function __construct($table="") {
        try{
            $this->_table = $table;
            if(!isset($this->_pdo)){
            $this->_pdo = new \PDO(Config::get("connections/mysql/driver").
                    ":host=".Config::get("connections/mysql/host").
                    ";dbname=".Config::get("connections/mysql/database"),
                    Config::get("connections/mysql/username"),
                    Config::get("connections/mysql/password")
                    );
            
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,Config::get('fetch_mode'));
            }
            
        } catch (\PDOException $ex) {
            
            die($ex->getMessage());
        }
    }
    
    
    /**
     * 
     * @param type $sql
     * @param type $params
     * 
     * perform basic query
     */
    public function query($sql , $params = array(),$flag = true){
        try {
            
            $this->_error = false;
            $this->_query = $this->_pdo->prepare($sql);
            $this->_query->execute($params);
            $this->_count = $this->_query->rowCount();
        if($flag){
            $this->_results = $this->_query->fetchAll();
        }

                  
        } catch (\PDOException $ex) {
            echo $ex->getMessage();
            $this->_error = true;
        }
        
        return $this ; 
    }
    
    public  function setTable($table=""){
        $this->_table = $table;
    }
    public function action($action , $where = array() , $flag = true){
        if(count($where)=== 3){
            
            $operators = array('=','>','<','>=','<=','!=');
            
            $field =$where[0] ;
            $operator = $where[1];
            $value = $where[2];
            
            if(in_array($operator, $operators)){
               
                $sql = "{$action} from {$this->_table} where {$field} {$operator} :{$field}";
                if(!$this->query($sql, array($field=>$value), $flag)->error()){
                    return $this; 
                }
            }
        }
        
        return FALSE;
    }
    
  
    public function get($where){
        
        return $this->action("select * " , $where);
    }
    
    public function getAll(){
        return $this->query("select * from {$this->_table}");
    }

        public function delete($where){
 
        return $this->action("DELETE " , $where , false);

    }

    public function insert($fileds = array()){
        if(!empty($fileds)){
           
            $list = array();
            foreach ($fileds as $key=>$value){
               $list[] =   $key ." = :". $key ;
            }
               
            $list = implode(", ", $list);
            $sql = "INSERT INTO {$this->_table} set " .$list ;
           
            if(!$this->query($sql , $fileds, false)->error()){
                return $this;
            }
        }
        return $this ;
    }
    
    public function update ($id , $fileds ){
         if(!empty($fileds)){
            
            $list = array();
            foreach ($fileds as $key=>$value){
               $list[] =   $key ." = :". $key ;
            }
               
            $list = implode(", ", $list);
            $sql = "UPDATE {$this->_table} set {$list} where id = :id ";
            $fileds["id"] = $id ;
            if(!$this->query($sql , $fileds, false)->error()){
                return $this;
            }
        }
        return $this ;
        
    }
    
    public function results(){
        
        return $this->_results;
    }

    public function first(){
        return $this->results()[0];
    }

    public function error(){
        return $this->_error;
    }
    
    public function count(){
        return $this->_count;
    }
    
    
}

 /*
    protected $conn;
    private $table; 
    private $query;
    
    public function __construct($table){
        
        $this->table = $table;
        $this->connect();
    }
    
    private function connect(){
        
        try{
            
            $config = ( require ROOT .'/app/config/config.php');          
            extract($config);
            
            if(!isset($this->conn)){
                
            $this->conn = new \PDO("mysql:host=".$connections['mysql']['host'].";dbname="
                                    .$connections['mysql']['database'], 
                                     $connections['mysql']['username'],
                                     $connections['mysql']['password']);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,$fetch_mode);
            
            }
            
        } catch (Exception $e) {
                
            echo "Connection failed: " . $e->getMessage();

        }
    }

    public function setTable($table){
        $this->table = $table ;
    }
    
    public function getAll(){
        
        $stmt = $this->conn->prepare("select * from $this->table");
        $stmt->execute();
        
        return $stmt->fetchAll();
        
    }
    
    public function getLimit($limit_offset = 0 , $limit_to = 10){
                 
        $stmt = $this->conn->prepare("select * from $this->table limit $limit_offset ,$limit_to");
        $stmt->execute();        
        
    }

    public function getById($id=1){
        
        try{
            $stmt = $this->conn->prepare("select * from $this->table where id=:id");
            $stmt->execute(array(
                "id"=>$id
            ));
            
            $values = $stmt->fetchAll();
         return (count($values)== 0)? '' : $values ;
         
        }  catch (Exception $e){
            
            echo "user not found";
        }
        
        
    }
    
    public function insert($values=array()){
        
        try {
            
           if(!empty($values)){
                          
               $list = array();
               foreach ($values as $key=>$value){
                   $list[] =   $key ." = :". $key ;
               }
               
               $list = implode(", ", $list);
               $stmt= $this->conn->prepare("INSERT INTO ". $this->table ." SET " . $list);
               $stmt->execute($values);
               
            }
                      
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
            
    }
    
        public function update($values , $id){
        
        try {
            
           if(!empty($values)){
               $list = array();
               foreach ($values as $key=>$value){
                   $list[] =   $key ." = :". $key ;
               }
               $list = implode(", ", $list);
               $stmt= $this->conn->prepare("UPDATE ". $this->table ." SET " . $list ." where id = :id");
               $values['id'] = $id;
               $stmt->execute($values);
             return $stmt->rowCount();
             
            }
                      
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
            
    }

    
    public function delete($id){
        
        try{
            
            if(!empty($id)){
                $stmt = $this->conn->prepare("DELETE FROM sessions WHERE id = :id");
                $stmt->execute(array(
                    "id"=>$id
                        ));
            }
            
        } catch (Exception $ex) {

        }
    }
    
    public function joinTable($table="" ,$column="" , $id=""){
        
        try{
            
            if(!empty($table) && !empty($column ) && empty($id)){
                $query = "select * from $this->table join $table on $this->table.id = $table.$column" ;
            }else if (!empty($table) && !empty($column ) && !empty($id)){
                
                $query = "select * from $this->table join $table on $this->table.id = $table.$column  where $this->table.id = :id";
                
            }else{
                
                die("error join table");
            }
                        
            $stmt = $this->conn->prepare($query);
            $stmt->execute(array(
                "id"=>$id
            ));
            $userpost= $stmt->fetchAll();
            print_r($userpost);
        } catch (Exception $ex) {

        }
    }
    
    public function getConnection(){
        return $this->conn;
    }
     * 
     */
    