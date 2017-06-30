<?php include 'header.php' ?>

  <content>
    <div class="form-container">
      <form method="POST">
        <div class="form-control">
          <label>Email</label>
          <input type="email" id="email"></input>
        </div>
        <div class="form-control">
          <label>Password</label>
          <input type="password" id="password"></input>
        </div>
        <div class="form-control">
          <p class="form-control alert" style="display:none;" id="form-wrong-login">Wrong email or password!</p>
        </div>
        <div class="action-container">
          <span id="btnSignIn" class="button">Sign in</span>
          <a href="sign-up.php" class="link-button">Sign up</a>
          <p class="alert" style="display:none;" id="form-data-check">Please fill out all fields!</p>

        </div>
      </form>
    </div>
  </content>
  <script src="js/signIn.js"></script>
<?php include 'footer.php' ?>
