<?php
namespace App\Comments;

use App\Core\AbstractRepository;

class PostsRepository extends AbstractRepository
{

  public function getTableName()
  {
    return "comments";
  }

  public function getModelName()
  {
    return "App\\Comments\\CommentModel";
  }

}

?>
