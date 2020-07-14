<?php

  /*If comes login dates*/
  if (!empty($_POST['login-email']) && !empty($_POST['login-password'])) {

    $login_email = $_POST['login-email'];
    $login_password = $_POST['login-password'];

    /*Validate email*/
    if(filter_var($login_email , FILTER_VALIDATE_EMAIL)){

      $sql = "SELECT * FROM users WHERE email = '$login_email'";
      $query = mysqli_query($database , $sql);

      //If find one user
      if($query && mysqli_num_rows($query) == 1){
        //Save query in a variable
        $user = mysqli_fetch_assoc($query);

        //Verify password
        if(password_verify($login_password , $user['password']) || $login_password == $user['password']){

          //creating a cookie of user
          setcookie("user[username]" , $user['username'] );
          setcookie("user[email]" , $user['email'] );
          setcookie("user[picture]" , $user['picture'] );

          /*Refresh adverting login is successful and with username*/
          header("Location: index.php?login=successful");

        }else {
          //En caso de no coincidir la contraseña redirigir con error por get para mostrar en el header html
          header('Location: index.php?login=error_password');
        }

      }else {
        header('Location: index.php?login=error_user');
      }

    }

  }

?>

<!--========================================================================================================================-->
<!--Login Form-->
<button type="button" class="btn btn-dark btn-login-signup" data-toggle="modal" data-target="#login-modal">
  Login
</button>

<!--Login Modal-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="login-modallLabel">Welcome Again.</h5>
        <!--Close modal button-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!--Modal content-->
      <form action="index.php" method="post">
        <div class="modal-body">


          <div class="form-group">
            <label for="login-email">Email address</label>
            <input type="email" class="form-control" id="login-email" aria-describedby="emailHelp" name="login-email" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="login-password">Password</label>
            <input type="password" class="form-control" id="login-password" name="login-password" required>
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="login-check">
            <label class="form-check-label" for="login-check">Do not sign out.</label>
          </div>

        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-dark btn-block">Login</button>

        </div>

      </form>

    </div>
  </div>
</div>
<!--========================================================================================================================-->
