<?php include 'db.php' ?>
<?php

  if(!isset($_POST)){ return null; }

  //var_dump($_POST);

  if(isset($_POST['justCheckEmail'])){
    $email = $_POST['email'];
    $response = $dbBlog->emailExists($email);
    if($response){ echo "true"; }else{ echo "false"; }

  }else{
    $userId = $dbBlog->createNewUser($_POST);

    if($userId){
      $_SESSION['user_id'] = $userId;
      //$dbBlog->log->writeLog("session user id:".$_SESSION['user_id'], null);

      echo $userId;
    }else{
      echo "";
    }

  }

?>
