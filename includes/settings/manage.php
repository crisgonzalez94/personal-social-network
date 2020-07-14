<?php

  require '../../database/conexion.php';
  require '../../helpers/alerts.php';

  /*Ask if there an admin login*/
  if(isset($_COOKIE['user'])){
    $user_email = $_COOKIE['user']['email'];
    $sql = "SELECT admin FROM users WHERE email = '$user_email' ";
    $query = mysqli_query($database , $sql);

    $user_admin = mysqli_fetch_assoc($query);

    if(!$user_admin['admin']){
      header('location: ../../index.php?home');
    }
  }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Manager Page</title>
  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <!--========================================================================================================================-->
        <!--Nav-->
        <a class="navbar-brand" href="../../index.php?home">John Smith Admin Zone</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        </div>
      </nav>


    </header>


    <div class="container-fluid">

      <h1>Page Settings</h1>
      <hr>

      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=site-info">Set Site Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=home">Manager Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=users">Manager Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=post">Manager Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=events">Manager Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=podcast">Manager Podcasts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage.php?manager=galery">Galery</a>
        </li>
      </ul>

      <!--Switch between options settings-->
      <?php

        if (isset($_GET['manager'])) {

          switch ($_GET['manager']){
            case 'site-info':
              require 'manager-site-info.php';
              break;
            case 'home':
              require 'manager-home.php';
              break;
            case 'users':
              require 'manager-users.php';
              break;
            case 'post':
              require 'manager-post.php';
              break;
            case 'events':
              require 'manager-events.php';
              break;
            case 'podcast':
              require 'manager-podcast.php';
              break;
            case 'galery':
              require 'manager-galery.php';
              break;
          }

        }else {
          require 'manager-site-info.php';
        }

      ?>

    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
</html>
