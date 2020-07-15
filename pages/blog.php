<?php

  /*If recive a post coment*/
  if(!empty($_POST['comment'])){
    $comment = $_POST['comment'];

    /*Get user's comment info from cookie*/
    if(isset($_COOKIE['user'])){
      $id_user = $_COOKIE['user']['id'];
      /*The id post comes with url get*/
      $id_post = $_GET['post'];

      $sql = "INSERT INTO post_coments VALUES(null , '$id_post' , '$id_user' , '$comment' , CURDATE() )";
      $upload_post_comment = mysqli_query($database , $sql);

      if ($upload_post_comment) {
        echo user_alert("The comment was uploaded successful." , "success");
      }else {
        echo user_alert("The comment was not uploaded successful." , "danger");
      }

    }else {
      echo user_alert("The comment was not uploaded successful." , "danger");
    }

  }


  /*This page show all post in database , each post has a button for show more
  this button send a get variable if this script receive a variable , this script
  will search in database the post and show it*/
  if(!empty($_GET['post'])){
    $id = $_GET['post'];
    $sql = "SELECT * FROM posts WHERE id = '$id' ";
    $query = mysqli_query($database , $sql);

    if($query && mysqli_num_rows($query) == 1 ){
      $post = mysqli_fetch_assoc($query);

      $id = $post['id'];
      $title = $post['title'];
      $short_description = $post['short_description'];
      $body = $post['body'];
      $body = str_replace("\r" , "<br><br>" , $body);
      $picture = $post['picture'];
      $date_post = $post['date_post'];


      $show_post = true;

      /*================================================
      seacrh comments of post
      =================================================*/
      $sql = "SELECT * FROM post_coments";
      $comments = mysqli_query($database , $sql);


    }
  }else {
    $show_post = false;
  }



?>


<!--Show a post select-->
<?php if($show_post): ?>

  <div class="container">
    <!--==============================================
    Post
    =================================================-->
    <br>
    <h1 class=""><?= $title ?></h1>
    <p class="text-muted"><?= $date_post ?></p>
    <p class="h4 font-weight-bolder"><?= $short_description ?></p>
    <br>
    <img class="ui centered large image" src="assets/images/posts/<?= $picture ?>">
    <br>

    <p class="h4"><?= $body ?></p>
    <br>

    <!--==============================================
    Coments
    =================================================-->
    <h3 class="h2">Comments</h3>
    <br>

    <?php while($comment = mysqli_fetch_assoc($comments)): ?>
      <?php
        $user_id_comment = $comment['id_user'];
        $body_comment = $comment['body'];
        $date_comment = $comment['date_post'];

        /*Get picture and name of user_coment*/
        $sql = "SELECT * FROM users WHERE id = '$user_id_comment' ";
        $query = mysqli_query($database , $sql);

        if($query && mysqli_num_rows($query) == 1){
          $name_user_comment = mysqli_fetch_assoc($query)['username'];
          $picture_user_comment = mysqli_fetch_assoc($query)['picture'];
        }

       ?>

      <div class="ui list">
        <div class="item">
          <img class="ui avatar image" src="assets/images/profile/<?= $picture_user_comment ?>">
          <div class="content">
            <a class="header"><?= $name_user_comment ?></a>
            <p><?= $body_comment ?></p>
            <div class="description">Write on <?= $date_comment ?></div>
          </div>
        </div>
      </div>

    <?php endwhile; ?>

    <!--======================================================
    Comment form
    =======================================================--->
    <form class="" action="index.php?page=blog&post=<?= $id ?>" method="post">
      <div class="form-group">
        <label for="comment">Write a comment</label>
        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-lg btn-dark" name="button">Comment</button>
    </form>


    <br>

  </div>

<?php endif; ?>






<?php

  /*Get posts from database*/
  $sql = "SELECT * FROM posts";
  $posts = mysqli_query($database , $sql);

 ?>

<!--Show lists of blogs-->
<div class="container">
  <h2 class="h1">Blog</h2>
  <hr>

  <?php while($post = mysqli_fetch_assoc($posts)): ?>
  <?php
    $id = $post['id'];
    $title = $post['title'];
    $short_description = $post['short_description'];
    $body = $post['body'];

    /*Substrarct part of body for show in lists of blogs*/
    $resume_body = substract(350 , $body);

    $picture = $post['picture'];
    $date_post = $post['date_post'];
  ?>

  <div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="assets/images/posts/<?= $picture ?>" class="card-img medium" alt="<?= $short_description ?>">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="h1"><?= $short_description ?></h3>


          <p class="card-text"><?= $resume_body ?> ... </p>

          <a href="index.php?page=blog&post=<?= $id ?>" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Show more</a>

          <p class="card-text"><small class="text-muted"><?= $date_post ?></small></p>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>




</div>
