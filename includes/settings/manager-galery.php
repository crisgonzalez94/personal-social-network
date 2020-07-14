<?php

  /*=========================================================
  Upload a new post
  ==========================================================*/
  if( !empty($_POST['title']) ){

    $title = $_POST['title'];
    $picture = $_FILES['picture'];


    /*Verify if there a picture in post*/
    if($picture['name']){

      $picture_name = $picture['name'];
      $picture_type = $picture['type'];

      /*Verify type of photo*/
      if( $picture_type == 'image/jpg' or $picture_type == 'image/jpeg' or $picture_type == 'image/gif' or $picture_type == 'image/png'){

        //Ask if exist the directorie where will save the photos
        if(!is_dir('../../assets/images/galery')){
           //Make the folder
           mkdir('../../assets/images/galery' , 0777);
        }

        move_uploaded_file($_FILES['picture']['tmp_name'] , "../../assets/images/galery/$picture_name" );

        $sql = "INSERT INTO photos_galery VALUES(null , '$title' , '$picture_name' )";
        $upload_photo = mysqli_query($database , $sql);

        if($upload_photo){
          echo user_alert("The photo was uploaded successful" , "success");
        }else {
          echo user_alert("The photo was not uploaded ,  try again" , "danger");
        }


      }else {
        /*If format file is not a picture ,send alert to frontend*/
        echo user_alert("The picture format is not valid , try with a jpg / jpeg / png / gif file." , "danger");
      }

    }else {
      /*If user dont upload photo , send alert*/
      echo user_alert("You was not upladed a file" , "danger");

      /*Set a variable with name of default post picture*/


    }

  }




  /*Delete a picture*/
  if(!empty($_GET['delete'])){

    $id = $_GET['delete'];

    $delete_photo = mysqli_query($database , "DELETE FROM photos_galery WHERE id = '$id' ");


    if($delete_photo){
      echo user_alert("Photo deleted of admin successful." , "success");

      /*Cames for get the name of photo for delete of server*/
      $picture = $_GET['picture'];
      unlink("../../assets/images/galery/$picture");

    }else {
      echo user_alert("Error to delete photo." , "danger");
    }


  }


  /*Get info of home from database*/
  $sql = "SELECT * FROM photos_galery";
  $photos_galery = mysqli_query($database , $sql);





?>

<!--Here is for upload photo to galery-->
<div class="container">

  <h2>Upload a new photo</h2>

  <form method="post" action="manage.php?manager=galery" enctype="multipart/form-data">

    <div class="form-group">
      <label for="title">Title of photo</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="picture" lang="es" name="picture" required>
        <label class="custom-file-label" for="customFileLang">Choose picture</label>
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Upload a new photo</button>

</div>



<hr>

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
