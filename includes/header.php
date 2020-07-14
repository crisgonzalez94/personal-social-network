<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>John Smith</title>

    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="styles/semantic/semantic.min.css">

    <link rel="stylesheet" href="styles/style.css">

  </head>
  <body>

    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <!--========================================================================================================================-->
        <!--Nav-->
        <a class="navbar-brand" href="index.php?home">John Smith</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=events">Events</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=galery">Galery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=blog">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=podcast">Podcast</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=contact">Contact Me</a>
            </li>
          </ul>
          <!--========================================================================================================================-->

          <!--========================================================================================================================-->
          <!--Search Form-->
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
          </form>


          <!--========================================================================================================================-->
          <!--Ask if there a cookie of user-->
          <?php
            if(!isset($_COOKIE['user'])){
              //Login Form
              require 'includes/login.php';
              //Sign up Form
              require 'includes/signup.php';
            }else{
              //Menu user login
              require 'includes/login-menu.php';
            }
          ?>

        </div>
      </nav>


    </header>
