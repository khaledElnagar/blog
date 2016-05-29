<?php
/*
 * 
    session_start();
    
    $salt = 'FAR$rsijwe8523#$@%1dfsd';
    $tokenstr = strval(date('ymdhms')).$salt;
    $token = md5($tokenstr);
    $_SESSION['token'] = $token;
    output_add_rewrite_var('token', $token);
 * 
 */
?>
<div>
    <form method="post" action = "store" >
        <div>
            <input type="text" name="title">
        </div>
        
        <div>
            <textarea name="subject" ></textarea>
        </div>
     
        <div>
        <input type ="submit" value="create post">
        </div>
        
    </form>
</div>