<?php

use app\resources\library\route\Route as Route ;
use app\resources\library\view\View as View ;
use app\controller\UserController as UserController;
use app\controller\PostController as PostController;
$user = new UserController();
$posts = new PostController();
$route = new Route();  


$route->add('/', function() use($posts) {
    
    $posts->getPosts();
});

$route->add('/post/.+', function($id) use($posts) {
    
    $posts->getById($id);

});

$route->add('/post/create', function(){
        
    View::make("post.create");
});

$route->add('/post/store', function() use($posts) {
            
    $posts->store();
    
});

$route->add('/user/.+',function($id) use($user){
        $user->getById($id);
});

$route->add('/user/login',function() use($user){
        $user->login();
});

$route->add('/user/authenticate',function() use($user){
        $user->authenticate();
});
$route->add('/user/create',function() use($user){
        $user->create();
});

$route->add('/user/store',function() use($user){
        $user->store();
});

$route->add('/user/logout',function() use($user){
        $user->logout();
});


$route->add('/admin/users/all/',function(){
        View::make("user.all");
});


$route->add('/this/is/the/.+/story/of/.+', function($first, $second) {
	echo "This is the $first story of $second";
});



$route->submit();
