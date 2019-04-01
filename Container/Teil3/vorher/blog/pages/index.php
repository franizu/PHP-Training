<?php include("../init.php"); ?>
<?php include("elements/header.php"); ?>

<h1>Startseite des Blogs</h1>
<p class="lead">Das hier ist die Startseite des Blogs.</p>

<?php
  $postsRepsitory = $container->getPostsRepository();
  $res = $postsRepsitory->fetchPosts();

  $postsRepsitory = $container->getPostsRepository();
  $postsRepsitory2 = $container->getPostsRepository();

  var_dump($postsRepsitory);
  var_dump($postsRepsitory2);
?>

<ul>
  <?php foreach ($res AS $row): ?>
    <li>
      <a href="post.php?id=<?php echo $row->id; ?>">
        <?php echo $row->title; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>

<?php include("elements/footer.php"); ?>
