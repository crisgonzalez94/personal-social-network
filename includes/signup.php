<?php

  if(!empty($_POST['signup-username']) && !empty($_POST['signup-email']) && !empty($_POST['signup-password']) && !empty($_POST['signup-password-confirm'])){

    $signup_username = $_POST['signup-username'];
    $signup_email = $_POST['signup-email'];
    $signup_password = $_POST['signup-password'];
    $signup_password_confirm = $_POST['signup-password-confirm'];

    /*Verify if both passwor are same*/
    if($signup_password == $signup_password_confirm){

      /*Encrypt password*/
      $signup_password = password_hash($signup_password , PASSWORD_BCRYPT);

      /*Validate email*/
      if(filter_var($signup_email , FILTER_VALIDATE_EMAIL)){

        /*Save user*/
        $sql = "INSERT INTO users VALUES(null , '$signup_username' , '$signup_email' , '$signup_password' , 'default-user-picture.jpg' , false)";
        $query = mysqli_query($database , $sql);

        if ($query) {
          header('location: index.php?page=home&signup=successful');
        }else {
          header('location: index.php?&signup=error_to_in');
        }

      }else{
        header('location: index.php?signup=error_email');
      }

    }else {
      header('location: index.php?signup=error_confirm_password');
    }

  }


?>


<!--========================================================================================================================-->
<!--Sign up Form-->
<button type="button" class="btn btn-dark btn-login-signup" data-toggle="modal" data-target="#signup-modal">
  Sign up
</button>

<!--Signup Modal-->
<div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="signup-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signup-modalLabel">Join the community</h5>
        <!--Close modal button-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Modal content-->
      <form  method="post" action="index.php">
        <div class="modal-body">

          <div class="form-group">
            <label for="signup-username">Your Name</label>
            <input type="text" class="form-control" id="signup-username" name="signup-username" required>
          </div>

          <div class="form-group">
            <label for="signup-email">Email address</label>
            <input type="email" class="form-control" id="signup-email" aria-describedby="emailHelp" name="signup-email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="signup-password">Password</label>
            <input type="password" class="form-control" id="signup-password" name="signup-password" required>
          </div>

          <div class="form-group">
            <label for="signup-password-confirm">Confirm Password</label>
            <input type="password" class="form-control" id="signup-password-confirm" name="signup-password-confirm" required>
          </div>

          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="login-check">
            <label class="form-check-label" for="login-check">Do not sign out.</label>
          </div>


        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-dark btn-block">Sign up</button>

        </div>
      </form>
    </div>
  </div>
</div>
<!--========================================================================================================================-->
