<?php include 'header.php' ?>

  <content>
    <div class="form-container">
      <form method="POST">
        <div class="form-control">
          <label>First name</label>
          <input type="name" id="first_name"></input>
        </div>
        <div class="form-control">
          <label>Last name</label>
          <input type="name" id="last_name"></input>
        </div>
        <div class="form-control">
          <label>Email</label>
          <input type="email" id="email"></input>
          <p class="alert" style="display:none;" id="mail-check-error">This email already exists!</p>
        </div>
        <div class="form-control">
          <label>Password</label>
          <input type="password" id="password"></input>
        </div>
        <div class="action-container">
          <span id="btnSignUp" class="button">Sign up</span>
          <p class="alert" style="display:none;" id="form-data-check">Please fill out all fields!</p>
        </div>
      </form>
    </div>
  </content>
  <script src="js/registerUser.js"></script>
<?php include 'footer.php' ?>
