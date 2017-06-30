<?php include 'db.php' ?>
<?php

  if(!isset($_POST)){ return null; }

  //var_dump($_POST);

  $userId = $dbBlog->signIn($_POST);

  if(!empty($userId)){
    $_SESSION['user_id'] = $userId;
  }

  echo $userId;



?>
