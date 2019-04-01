<?php
namespace App\Post;

use PDO;

abstract class AbstractRepository {

  private $pdo;
  private $origin;
  private $model;

  function all()
  {
     $stmt = $this->pdo->query("SELECT * FROM {$origin}");
     $posts = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
     return $posts;
  }

  function find($id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM {$origin} WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
    $post = $stmt->fetch(PDO::FETCH_CLASS);

    return $post;
  }

}

class PostsRepository extends AbstractRepository
{


  public function __construct(PDO $pdo,$origin,$model)
  {
    $this->pdo = $pdo;
    $this->origin = $origin;
    $this->model = $model;

  }

  
}

?>
