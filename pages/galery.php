<?php

  /*Get events from database*/
  $sql = "SELECT * FROM photos_galery";
  $photos = mysqli_query($database , $sql);

  $count_photos = 0;
?>


<div class="container">
  <h1>Galery</h1>
  <hr>

  <div class="ui shape">
    <div class="sides">

      <?php while($photo = mysqli_fetch_assoc($photos)): ?>
        <?php
          $id = $photo['id'];
          $title = $photo['title'];
          $picture = $photo['picture'];

          $count_photos++;
        ?>
        <?php if($count_photos == 1): ?>
          <div class="side active">
            <div class="content">
              <img src="assets/images/galery/<?= $picture ?>" alt="<?= $title ?>" class="img-galery">
            </div>
          </div>
        <?php else: ?>
          <div class="side ">
            <div class="content">
              <img src="assets/images/galery/<?= $picture ?>" alt="<?= $title ?>" class="img-galery">
            </div>
          </div>
        <?php endif; ?>
    <?php endwhile; ?>


    </div>
  </div>

  <!---->

  <div class="row">
    <div class="ui mediaPlay">
      <button class="ui labeled icon button" id="previus" click()>
        <i class="left chevron icon"></i>
        Previus
      </button>
      <button class="ui right labeled icon button" id="next">
        Next
        <i class="right chevron icon"></i>
      </button>
    </div>
  </div>

</div>
