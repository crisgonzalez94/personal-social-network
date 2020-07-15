<?php

  /*Get events from database*/
  $sql = "SELECT * FROM events";
  $events = mysqli_query($database , $sql);

?>


<div class="container">
  <h1>Events</h1>

  <div class="ui link cards">

    <?php while($event = mysqli_fetch_assoc($events)): ?>
    <?php
      $id = $event['id'];
      $title = $event['title'];
      $short_description = $event['short_description'];
      $body = $event['body'];
      $picture_one = $event['picture_one'];
      $picture_two = $event['picture_two'];
      $date_event = $event['date_post'];
    ?>

      <div class="card">
        <div class="ui slide masked reveal image">
          <img src="assets/images/events/<?= $picture_one ?>" class="visible content">
          <img src="assets/images/events/<?= $picture_two ?>" class="hidden content">
        </div>
        <div class="content">
          <div class="header"><?= $title ?></div>
          <div class="meta">
            <a><?= $short_description ?></a>
          </div>
          <div class="description">
            <?= $body ?>
          </div>
        </div>
        <div class="extra content">
          <span class="right floated">
            <?= $date_event ?>
          </span>
        </div>
      </div>

  <?php endwhile; ?>


  </div>

</div>
