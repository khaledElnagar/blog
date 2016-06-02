<?php
use app\resources\library\sessions\Session;
use app\controller\UserController ; 
use app\resources\library\config\Config;
$user = new UserController(Session::get(Config::get('session/session_name')));
$currentuser = $user->data();
?>


<?php if($user->isLoggedIn()): ?>
<h1>Welcome , <?=$currentuser['username'];?></h1>
<h4><a href="/user/logout"> logout </a></h4>
<?php else:?>
    <p> You need to <a href="/user/login">Login</a> or <a href = "/user/create">Register</a> !</p>
<?php endif;?>

<?php foreach ($data as $post): ?>
  <div>
      <h2><a href=post/<?=$post['id'];?>><?= $post['title'];?></a></h2>
      <br>
      <p><?=$post['subject'];?></p>
  </div>
<?php endforeach; ?>
 
