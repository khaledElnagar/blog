<?php namespace app\controller;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use app\models\PostModel as PostModel;
use app\resources\library\view\View as View;
/**
 * Description of PostController
 *
 * @author khaled
 */
class PostController {
    
    private $post;
    private $view ;
    protected $values ;
    public function __construct() {
        $this->post = new PostModel();
        $this->view = new View();
    }
    
    public function getPosts(){
       
        $data = $this->post->getAll()->results();
        $this->view->view('index', $data);
       
    }
    
    public function getById($id){
        $data = $this->post->getById($id);
      return $this->view->view("post.index",$data);
        
    }
    
    public function store(){
       // die($_POST['token']);
        $values['user_id']=1;
        $values['title']=$_POST['title'];
        $values['subject']=$_POST['subject'];
        
        $this->post->insert($values);
        $this->view->redirectTo("/");
        
    }
}
