<?php

  if(isset($_COOKIE['user'])){
    $user_name = $_COOKIE['user']['username'];
    $user_email = $_COOKIE['user']['email'];
    $user_photo = $_COOKIE['user']['picture'];
    $user_admin = $_COOKIE['user']['username'];
  }else {
    header("location: index.php");
  }

  if(!empty($_POST['password'])){
    $password = $_POST['password'];
    /*Get info of user on database using the cookie dates*/
    $sql = "SELECT * FROM users WHERE email = '$user_email' AND username = '$user_name' ";
    $query = mysqli_query($database , $sql);

    if($query && mysqli_num_rows($query) == 1){
      $user = mysqli_fetch_assoc($query);
      $user_id = $user['id'];
      $user_password = $user['password'];

      /*Verify is password is correct*/
      if(password_verify($password , $user_password)){

        /*Change user name*/
        if(!empty($_POST['new-username'])){
          $new_username = $_POST['new-username'];

          $sql = "UPDATE users SET username '$new_username' WHERE id = '$user_id' ";
          $update = mysqli_query($database , $sql);

          if($update){
            echo user_alert("The username was updated successful" , "success");
          }else {
            echo user_alert("There was a problem updating username" , "danger");
          }

        }

        /*Change email*/
        if(!empty($_POST['new-email'])){
          $new_email = $_POST['new-email'];

          $sql = "UPDATE users SET email = '$new_email' WHERE id = '$user_id' ";
          $update = mysqli_query($database , $sql);

          if($update){
            echo user_alert("The email was updated successful" , "success");
          }else {
            echo user_alert("There was a problem updating email" , "danger");
          }
        }

        /*Change password*/
        if(!empty($_POST['new-password'])  && !empty($_POST['repeat-new-password'])){
          $new_password = $_POST['new-password'];
          $repeat_new_password = $_POST['repeat-new-password'];
          /*Verify if both password are same*/
          if($new_password == $repeat_new_password){
            /*Encrypt password*/
            $new_password = password_hash($new_password , PASSWORD_BCRYPT);

            $sql = "UPDATE users SET password = '$new_password' WHERE id = '$user_id' ";
            $update = mysqli_query($database , $sql);

            if($update){
              echo user_alert("The password was updated successful" , "success");
            }else {
              echo user_alert("There was a problem updating password" , "danger");
            }

          }else {
            echo user_alert("The password aren't same" , "danger");
          }
        }

        if(isset($_FILES['new-profile-image']['type'])){

          $new_profile_image_name = $_FILES['new-profile-image']['name'];
          $new_profile_image_type = $_FILES['new-profile-image']['type'];

          //Ask if exist the directorie where will save the photos
          if(!is_dir('assets/images/profile')){
             //Make the folder
             mkdir('assets/images/profile' , 0777);
          }

          move_uploaded_file($_FILES['new-profile-image']['tmp_name'] , "assets/images/profile/$new_profile_image_name" );

          /*Update database*/
          $sql = "UPDATE users SET picture = '$new_profile_image_name' WHERE id = '$user_id' ";
          $update = mysqli_query($database , $sql);

          if($update){
            echo user_alert("The email was updated successful" , "success");
          }else {
            echo user_alert("There was a problem updating email" , "danger");
          }

        }

      }else {
        echo user_alert("The password is not correct" , "danger");
      }


    }else {
      echo user_alert("There was a problem" , "danger");
    }

  }













 ?>


<div class="container">
  <h1>Settings Acount</h1>
  <hr>

  <form class="" action="index.php?page=user-settings" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="new-username">Change User name</label>
      <input type="text" class="form-control" id="new-username" name="new-username">
      <small id="usernameHelp" class="form-text text-muted">Here there are not rules , you can has the name that you want.</small>
    </div>

    <div class="form-group">
      <label for="new-email">Change Email address</label>
      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter new email address" name="new-email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="password">Change Password</label>
      <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password">
      <br>
      <input type="password" class="form-control" id="repeat-new-password" name="repeat-new-password" placeholder="Repeat New Password">
    </div>

    <div class="form-group">
      <label for="new-profile-image">Profile Image</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile" name="new-profile-image">
        <label class="custom-file-label" for="customFile">Choose Image</label>
      </div>
    </div>

    <!--Modal for enter password before changes dates-->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Update data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter password for changes info.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="password">Change Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

          </div>
          <div class="modal-footer">

            <!--Submit-->
            <button type="submit" class="btn btn-primary">Refresh information</button>

          </div>
        </div>
      </div>
    </div>




  </form>
</div>

<br>
