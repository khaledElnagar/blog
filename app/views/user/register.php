<?php
    use app\resources\library\input\Input;
    use app\resources\library\sessions\Token;
    use app\resources\library\sessions\Session ;
    use app\resources\library\config\Config ;

   $messages = Session::get('message');
?>

<form action="store" method="post">
    <div class="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= Session::get("username");?>" autocomplete="off">
        <?= isset($messages['username'])? $messages['username'] :'';?>
    </div>
    <div class="">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= Session::get("email"); ?>" autocomplete="off">
        <?= isset($messages['email'])? $messages['email'] :'';?>
    </div>

    <div class="">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= Session::get("name"); ?>" autocomplete="off">
        <?= isset($messages['name'])? $messages['name'] :'';?>

    </div>

     <div class="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
         <?= isset($messages['password'])? $messages['password'] :'';?>

    </div>
    
    <div class="">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" value="" autocomplete="off">
        <?= isset($messages['confirm_password'])? $messages['confirm_password'] :'';?>

    </div>
    <input type ="hidden" name="<?= Config::get("session/token_name") ;?>" value="<?= Token::generate(); ?>"/>
    <input type="submit" value="Register">
</form>