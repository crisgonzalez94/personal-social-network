<?php

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
      $picture = $post['picture'];
      $date_post = $post['date_post'];


      $show_post = true;
    }
  }else {
    $show_post = false;
  }



?>


<?php if($show_post): ?>
  <div class="container">
    <h1><?= $title ?></h1>
    <p><?= $date_post ?></p>
    <p><?= $short_description ?></p>

    <img class="ui centered medium image" src="assets/images/posts/<?= $picture ?>">

    <p><?= $body ?></p>

    <hr>

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
    $resume_body = substract(500 , $body);

    $picture = $post['picture'];
    $date_post = $post['date_post'];
  ?>

  <div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="assets/images/posts/<?= $picture ?>" class="card-img" alt="<?= $short_description ?>">
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
