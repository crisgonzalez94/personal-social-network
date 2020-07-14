<?php

  if(!empty($_GET['delete'])){

    $id = $_GET['delete'];

    $delete_photo = mysqli_query($database , "DELETE FROM photos_galery WHERE id = '$id' ");


    if($delete_photo){
      echo user_alert("Photo deleted of admin successful." , "success");

      /*Cames for get the name of photo for delete of server*/
      $picture = $_GET['picture'];
      unlink("../../assets/images/galery/$picture") or die('Error al borrar');

    }else {
      echo user_alert("Error to delete photo." , "danger");
    }


  }


  /*Get info of home from database*/
  $sql = "SELECT * FROM photos_galery";
  $photos_galery = mysqli_query($database , $sql);





?>



<div class="container">
  <h2>Manager Galery</h2>
  <p>Here you view and delete the photos of galery.</p>

  <?php while($photo = mysqli_fetch_assoc($photos_galery)): ?>
  <?php
    $id = $photo['id'];
    $title = $photo['title'];
    $picture = $photo['picture'];
  ?>

  <div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        <img src="../../assets/images/galery/<?= $picture  ?>" class="card-img" alt="El nuevo album">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="h1"><?= $title ?></h3>



          <a class="btn btn-danger" href="manage.php?manager=galery&delete=<?= $id ?>&picture=<?= $picture ?>" role="button">Delete Picture</a>

        </div>
      </div>
    </div>
  </div>




  <?php endwhile; ?>












</div>
