<?php

  /*Get Biography of database*/
  $sql = "SELECT * FROM home";
  $query = mysqli_query($database , $sql);

  if($query && mysqli_num_rows($query) == 1){
    $home = mysqli_fetch_assoc($query);

    $title = $home['title'];
    $biography = $home['biography'];
    $photo = $home['photo'];

  }

 ?>

<div class="container">

  <h1>Take design to another level</h1>

  <div class="row no-gutters bg-light position-relative">
    <div class="col-md-6 mb-md-0 p-md-4">
      <img src="assets/images/profile-autor-image/<?= $photo  ?>" class="w-100 img-home" alt="John Smith Image Profile" >
    </div>
    <div class="col-md-6 position-static p-4 pl-md-0">
      <h4 class="mt-0"><?= $title  ?></h4>
      <p><<?= $biography  ?>/p>
    </div>
  </div>

</div>
