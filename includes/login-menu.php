<?php

  if(isset($_COOKIE['user'])){
    $user_name = $_COOKIE['user']['username'];
    $user_email = $_COOKIE['user']['email'];
    $user_picture = $_COOKIE['user']['picture'];
    $user_admin = $_COOKIE['user']['admin'];
  }


 ?>


 <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Welcome <?= $user_name ?>
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <!--Acount settings-->
    <a class="dropdown-item" href="index.php?page=user-settings">User settings</a>
    <!--===========================================-->

    <!--================================================================-->
    <!--Options for Admins-->
    <?php if($user_admin == true): ?>
      <a class="dropdown-item" href="includes/settings/manage.php">Manage Page</a>
      <a class="dropdown-item" href="includes/settings/manage-users.php">Manager Users</a>
    <?php endif; ?>
    <!--================================================================-->
    <a class="dropdown-item" href="index.php?logout=true">Sign Out</a>

  </div>
</div>
