<?php
return [
    
    /*
     * PDO Fetch mode
     * 
     */
    
    'fetch_mode'=>  \PDO::FETCH_ASSOC ,
     
    
    /*
     * Database Connections
     * 
     */
    
    'connections'=>[
        'mysql'=>[
            'driver' => 'mysql',
            'host' =>'localhost',
            'port' => '3306',
            'database' => 'blog',
            'username' => 'root',
            'password' =>'Fkra^12345',
            ] ,
    ],
    
    'remember'=> [
        'cookie_name'=>'hash',
        'cookie_expiry'=>604800
    ],
    
    'session'=>[
        'session_name' => 'user',
        'token_name' => '_token'
    ]
] ;
