<?php

namespace App\Core;

use PDO;
use App\Post\PostsRepository;

class Container
{
  private $receipts = [];
  private $instances = [];

  public function __construct(){
      $this -> receipts = [
        "PostsRepository" => function(){

        }
      ]
  }

  public function make($name){

  }

  private $pdo;
  private $postsRepository;

  public function getPdo()
  {
    if (!empty($this->pdo)) {
      return $this->pdo;
    }
    $this->pdo = new PDO(
      'mysql:host=localhost;dbname=blog;charset=utf8',
      'blog',
      'TX4LQBEzfZfVqnLV'
    );
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $this->pdo;
  }

  public function getPostsRepository()
  {
    if (!empty($this->postsRepository)) {
      return $this->postsRepository;
    }
    $this->postsRepository = new PostsRepository(
      $this->getPdo()
    );
    return $this->postsRepository;
  }

}
 ?>
