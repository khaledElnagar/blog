<?php
use app\resources\library\config\Config;
use app\resources\library\sessions\Token;
use app\resources\library\input\Input ;
use app\resources\library\sessions\Session ;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   $messages = Session::get('message');

?>

<h1> Login Form </h1>

<div class="">
    <form action="authenticate" method="post">
        <div class="">
            <label for = "identifier" >Identifier</label>
            <input type ="textbox" name ="identifier" id="identifier" value="" autocomplete="off">
            <?= isset($messages['identifier'])? $messages['identifier'] :'';?>
        </div>
        
        <div class="">
            <label for = "password" >Password</label>
            <input type ="password" name ="password" id="password" value="" autocomplete="off">
            <?= isset($messages['password'])? $messages['password'] :'';?>
        </div>
        <input type="hidden" name="<?= Config::get("session/token_name") ;?>" value = "<?=Token::generate() ;?>">
        <input type="submit" value ="Login">
    </form>
</div>

<div class="error">
    <?= Session::flash('failed');?>
</div>