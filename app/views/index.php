<?php
use app\resources\library\sessions\Session;
/*
if (! isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 0;
}
    $_SESSION['visits']++;
print 'You have visited here '.$_SESSION['visits'].' times.';

echo "<a href=\"user/logout\" >logout</a>";

*/
echo Session::flash('success');
Session::destroy ();

foreach ($data as $post){
   echo "<div><a href=post/".$post['id'].">".$post['title']."</a><h2>";
   echo "</h2><br>";
   echo "<p>";
   echo $post['subject'];
   echo "</p></div>";

}
 
