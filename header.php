<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Vivify blog</title>

</head>
<body class="main-page">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/main.css" media="screen">
<link rel="stylesheet" type="text/css" href="css/common.css" media="screen">
  <header>
      <?php include 'db.php' ?>
      <!-- This is page’s header -->
      <h3><a href="index.php">VivifyBlog</a></h3>
      <nav>
        <a href="index.php" title="Homepage" >Home</a>
        <a href="about.php" title="About">About</a>
        <a href="contact.php" title="Contact">Contact</a>
        <a href="admin.php" title="Admin">Admin</a>
      </nav>
  </header>

<script>
  window.user_id = <?php echo("1") ?>;
</script>
