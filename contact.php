<?php include 'header.php' ?>
<?php

if(isset($_POST)){

  if(isset($_POST['email'])){
    /*
    echo("<pre>");
    var_dump($_POST);
    echo("</pre>");
    */
    $email = $_POST['email'];
    $text = $_POST['text'];

    $to = "dregojevic@gmail.com";
    $subject = "Vivify-blog - contact";
    $txt = $text;
    $headers = "From: $email" . "\r\n";

    mail($to,$subject,$txt,$headers);

    header('Location: thankYou.php');
  }
}

?>

  <content>

    <div class="form-container">
      <h1>Contact Us</h1>
      <form method="POST">
        <div class="form-control">
          <label>Your email</label>
          <input type="email" name="email"></input>
        </div>
        <div class="form-control">
          <label>Your message</label>
          <textarea rows="10" name="text" placeholder="Type in your questions..." required></textarea>
        </div>
        <div class="action-container">
          <button type="submit" name="sendMessage">Send</button>

        </div>
      </form>
    </div>
  </content>
<?php include 'footer.php' ?>
