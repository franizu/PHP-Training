<?php
namespace App\Core;
use App\Post\PostsRepository;
use PDO;

class Container {

    private $pdo;
    private $postRepository;

    public function getPdo(){

      if (!empty($this -> pdo)){
        return $this -> pdo;
      }
      $this -> pdo = new PDO(
        'mysql:host=localhost;dbname=blog;charset=utf8',
        'blog',
        'rAx2j5lUqNPiRFN1'
      );
      $this -> pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      return $this -> pdo;
    }
    public function getPostsRepository(){
      
      if (!empty($this -> postsRepository)){
        return $this -> postsRepository;
      }

      $this -> postsRepository = new PostsRepository($this -> getPdo());

      return $this -> postsRepository;
    }
}


 ?>
