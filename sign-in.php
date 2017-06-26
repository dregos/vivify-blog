<?php include 'header.php' ?>

  <content>
    <div class="form-container">
      <form method="POST">
        <div class="form-control">
          <label>Email</label>
          <input type="email" name="email"></input>
        </div>
        <div class="form-control">
          <label>Password</label>
          <input type="password" name="password"></input>
        </div>
        <div class="action-container">
          <button type="submit" name="signin">Sign in</button>
          <a href="sign-up.php" class="link-button">Sign up</a>
        </div>
      </form>
    </div>
  </content>
<?php include 'footer.php' ?>
