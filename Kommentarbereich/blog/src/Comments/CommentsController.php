<?php

namespace App\Comments;

use App\Core\AbstractController;

class CommentsController extends AbstractController
{

  public function __construct(CommentsRepository $commentsRepository)
  {
      $this->commentsRepository = $commentsRepository;
  }

  public function index()
  {
      $comments = $this->commentsRepository->all();

      $this->render("post/index", [
        'posts' => $comments
      ]);
  }

  public function show()
  {
      $id = $_GET['id'];
      $comment = $this->commentsRepository->find($id);

      $this->render("post/show", [
        'post' => $comment
      ]);
  }
}

 ?>
