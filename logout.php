<?php include 'header.php' ?>
<?php
  session_destroy();
  header('Location: sign-in.php');
?>
