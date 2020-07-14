<?php

  /*=========================================================
  Upload a new post
  ==========================================================*/
  if( !empty($_POST['title']) && !empty($_POST['short_description']) ){

    $title = $_POST['title'];
    $short_description = $_POST['short_description'];

    $picture = $_FILES['picture'];
    $audio = $_FILES['audio'];




    /*Verify if there a picture in post*/
    if($audio['name']){

      $audio_name = $audio['name'];
      $audio_type = $audio['type'];

      /*Verify type of photo*/
      if( $audio_type == 'audio/mpeg'){

        //Ask if exist the directorie where will save the photos
        if(!is_dir('../../assets/audios/podcast')){
           //Make the folder
           mkdir('../../assets/audios/podcast' , 0777);
        }

        move_uploaded_file($_FILES['audio']['tmp_name'] , "../../assets/audios/podcast/$audio_name" );


        /*=========================================================*/
        /* Save picture */
        /*Verify if there a picture in post*/
        if($picture['name']){

          $picture_name = $picture['name'];
          $picture_type = $picture['type'];


          /*Verify type of photo*/
          if( $picture_type == 'image/jpg' or $picture_type == 'image/jpeg' or $picture_type == 'image/gif' or $picture_type == 'image/png'){

            //Ask if exist the directorie where will save the photos
            if(!is_dir('../../assets/images/audios')){
               //Make the folder
               mkdir('../../assets/images/audios' , 0777);
            }

            move_uploaded_file($_FILES['picture']['tmp_name'] , "../../assets/images/audios/$picture_name" );


          }else {
            /*If format file is not a picture ,send alert to frontend*/
            echo user_alert("The picture format is not valid , try with a jpg / jpeg / png / gif file." , "danger");
          }

        }else {
          /*If user dont upload photo , send alert*/
          echo user_alert("You are not uploaded a picture , this post was uploaded with default picture" , "warning");

          /*Set a variable with name of default post picture*/
          $picture_name = 'default-podcast-picture.jpg';

        }
        /*============================================================*/

        /*===============================================================*/
        /* Save in database */
        $sql = "INSERT INTO podcasts VALUES(null , '$title' , '$short_description' , '$picture_name' , '$audio_name' , CURDATE() )";
        $upload_podcast = mysqli_query($database , $sql);

        if($upload_podcast){
          echo user_alert("The podcast was uploaded successful" , "success");
        }else {
          echo user_alert("Error" , "danger");
        }

      }else {
        /*If format file is not a picture ,send alert to frontend*/
        echo user_alert("The audio format is not valid , try with a mp3 file." , "danger");
      }

    }

  }


  /*===================================================
  Delete post
  ====================================================*/
  if(isset($_GET['delete_podcast'])){
    $id = $_GET['delete_podcast'];

    $sql = "DELETE FROM podcasts WHERE id = '$id' ";
    $delete_podcast = mysqli_query($database , $sql);

    if ($delete_podcast) {
      echo user_alert("The podcast was deleted successful" , "success");

      /*Verify if the podcast had a picture , this code will delete this photo*/
      $delete_podcast_picture = $_GET['delete_podcast_picture'];
      $delete_podcast_audio = $_GET['delete_podcast_audio'];

      if($delete_podcast_picture != 'default-podcast-picture.jpg'){
        unlink("../../assets/images/audios/$delete_podcast_picture");
      }

      unlink("../../assets/audios/podcast/$delete_podcast_audio");

    }else {
      echo user_alert("The audio was not deleted" , "danger");
    }



  }


  /*Get info of home from database*/
  $sql = "SELECT * FROM podcasts";
  $podcasts = mysqli_query($database , $sql);





?>

<!--Here is for create a new podcast-->
<div class="container">

  <h2>Create a new podcast</h2>

  <form method="post" action="manage.php?manager=podcast" enctype="multipart/form-data">

    <div class="form-group">
      <label for="title">Title of podcast</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="form-group">
      <label for="short_description">Short description</label>
      <input type="text" class="form-control" id="short_description" name="short_description" required>
    </div>

    <div class="form-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="picture" lang="es" name="picture" required>
        <label class="custom-file-label" for="customFileLang">Upload a cover of podcast</label>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="audio" lang="es" name="audio" required>
        <label class="custom-file-label" for="customFileLang">Upload an audio file</label>
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Upload new podcasts</button>

</div>

<hr>


<div class="container">
  <h2>Manager podcasts</h2>
  <p>Here you view and delete the podcasts.</p>

  <h3>Posts</h3>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Short description</th>
          <th scope="col">Audio</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <tbody>

        <?php while($podcast = mysqli_fetch_assoc($podcasts)): ?>
          <?php
            $id = $podcast['id'];
            $title = $podcast['title'];
            $short_description = $podcast['short_description'];
            $picture = $podcast['picture'];
            $audio = $podcast['audio'];
            $date_post = $podcast['date_post'];
          ?>

          <tr>
            <td><?= $id ?></td>
            <td><?= $title ?></td>
            <td><?= $short_description ?></td>
            <td>
              <audio controls>
               <source src="../../assets/audios/podcast/<?= $audio ?>" type="audio/mpeg">
                 Your browser does not support the audio element.
              </audio>
            </td>
            <td>
              <!--Link for delete podcasts-->
              <a href="manage.php?manager=podcast&delete_podcast=<?= $id ?>&delete_podcast_picture=<?= $picture ?>&delete_podcast_audio=<?= $audio ?>" class="btn btn-danger" role="button" aria-pressed="true">Delete posdcast</a>
            </td>
            <td><?= $date_post ?></td>
          </tr>

        <?php endwhile; ?>
      </tbody>

    </table>

</div>
