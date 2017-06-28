<?php include 'db.php' ?>
<?php

  if(!isset($_POST)){ return null; }

  //var_dump($_POST);

  $response = $dbBlog->createComment($_POST);
  $comment = new Comment($dbBlog, $response);
  echo $comment->returnHTML();
?>
