<?php





  /*Get podcasts from database*/
  $sql = "SELECT * FROM podcasts";
  $podcasts = mysqli_query($database , $sql);

?>


<div class="container">
  <h1>Podcast</h1>
  <hr>

  <?php while($podcast = mysqli_fetch_assoc($podcasts)): ?>
  <?php
    $id = $podcast['id'];
    $title = $podcast['title'];
    $short_description = $podcast['short_description'];
    $picture = $podcast['picture'];
    $audio = $podcast['audio'];
    $date_post = $podcast['date_post'];
  ?>

  <div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="assets/images/audios/<?= $picture ?>" class="card-img" alt="<?= $short_description ?>">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="card-title h2"><?= $title ?></h3>
          <p class="card-text"><?= $short_description ?></p>
          <audio controls>
             <source src="assets/audios/podcast/<?= $audio ?>" type="audio/mpeg"></source>
          </audio>
          <p class="card-text"><small class="text-muted"><?= $date_post ?></small></p>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>




</div>
