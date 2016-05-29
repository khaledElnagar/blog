<?php
    use app\resources\library\input\Input;
    use app\resources\library\validator\Validation;
    use app\resources\library\sessions\Token;
  
    $validator = new Validation("users");
    
    if(Input::exists()){
        if(Token::check(Input::get("_token"))){
            $validation = $validator->check($_POST , array(
               'username'=>array(
                   'required'=>true ,
                   'min'=> 3,
                   'max'=> 20,
                   'unique'=>'users'
               ),
               'email'=>array(
                   'required'=>true ,
                   'max'=> 255,
                   'email'=>'email',
                   'unique'=>'users'
               ),
               'name'=>array(
                   'required'=>true ,
                   'min'=> 3,
                   'max'=> 64,
               ),
               'password'=>array(
                   'required'=>true,
                   'min'=>6,
                   'max'=>255
               ),
               'confirm_password'=>array(
                   'required'=>true,
                   'matches'=>'password',
               )
            ));
            
            if(!$validator->passed()){
            }
        }

    }
    
?>

<form action="" method="post">
    <div class="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?= Input::get("username"); ?>" autocomplete="off"><?=$validator->getError("username");?>
    </div>
    <div class="">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?= Input::get("email"); ?>" autocomplete="off"><?=$validator->getError("email");?>
    </div>

    <div class="">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= Input::get("name"); ?>" autocomplete="off"><?=$validator->getError("name");?>
    </div>

     <div class="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off"><?=$validator->getError("password");?>
    </div>
    
    <div class="">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" value="" autocomplete="off"><?=$validator->getError("confirm_password");?>
    </div>
    <input type ="hidden" name="_token" value="<?= Token::generate(); ?>"/>
    <input type="submit" value="Register">
</form>