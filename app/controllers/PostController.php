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
    protected $values ;
    
    public function __construct() {
        $this->post = new PostModel();
    }
    
    public function getPosts(){
       
        $data = $this->post->getAll()->results();
        return View::make('index', $data);
       
    }
    
    public function getById($id){
       
        $data = $this->post->get(array('id','=',$id))->first();
        
      return View::make("post.index",$data);
        
    }
    
    public function store(){
       // die($_POST['token']);
        $values['user_id']=1;
        $values['title']=$_POST['title'];
        $values['subject']=$_POST['subject'];
        
        $this->post->insert($values);
        View::redirectTo("/");
        
    }
}
