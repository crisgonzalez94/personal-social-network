<?php

  /*Get events from database*/
  $sql = "SELECT * FROM posts";
  $posts = mysqli_query($database , $sql);

?>


<div class="container">
  <h1>Blog</h1>
  <hr>

  <?php while($post = mysqli_fetch_assoc($posts)): ?>
  <?php
    $id = $post['id'];
    $title = $post['title'];
    $short_description = $post['short_description'];
    $body = $post['body'];
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


          <p class="card-text"><?= $body ?></p>

          <button type="button" class="btn btn-dark">Show more</button>

          <p class="card-text"><small class="text-muted"><?= $date_post ?></small></p>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>




</div>
