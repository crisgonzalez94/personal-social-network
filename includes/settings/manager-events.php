<?php

  /*=========================================================
  Upload a new post
  ==========================================================*/
  if(!empty($_POST['title']) && !empty($_POST['short_description']) && !empty($_POST['body']) && !empty($_POST['date_event'])){

    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $body = $_POST['body'];
    $date_event = $_POST['date_event'];

    $picture_one = $_FILES['picture_one'];
    $picture_two = $_FILES['picture_two'];

    /*Verify if there a picture in post*/
    if($picture_one['name']){

      $picture_one_name = $picture_one['name'];
      $picture_one_type = $picture_one['type'];

      /*Verify type of photo*/
      if( $picture_one_type == 'image/jpg' or $picture_one_type == 'image/jpeg' or $picture_one_type == 'image/gif' or $picture_one_type == 'image/png'){

        //Ask if exist the directorie where will save the photos
        if(!is_dir('../../assets/images/events')){
           //Make the folder
           mkdir('../../assets/images/events' , 0777);
        }

        move_uploaded_file($_FILES['picture_one']['tmp_name'] , "../../assets/images/events/$picture_one_name" );


      }else {
        /*If format file is not a picture ,send alert to frontend*/
        echo user_alert("The picture format is not valid , try with a jpg / jpeg / png / gif file." , "danger");
      }

    }else {
      /*If user dont upload photo , send alert*/
      echo user_alert("You are not uploaded a picture , this post was uploaded with default picture" , "warning");

      /*Set a variable with name of default post picture*/
      $picture_one_name = 'default-event-picture.jpg';

    }

    /*Verify if there a picture in post*/
    if($picture_two['name']){

      $picture_two_name = $picture_two['name'];
      $picture_two_type = $picture_two['type'];

      /*Verify type of photo*/
      if( $picture_two_type == 'image/jpg' or $picture_two_type == 'image/jpeg' or $picture_two_type == 'image/gif' or $picture_two_type == 'image/png'){

        //Ask if exist the directorie where will save the photos
        if(!is_dir('../../assets/images/events')){
           //Make the folder
           mkdir('../../assets/images/events' , 0777);
        }

        move_uploaded_file($_FILES['picture_two']['tmp_name'] , "../../assets/images/events/$picture_two_name" );


      }else {
        /*If format file is not a picture ,send alert to frontend*/
        echo user_alert("The picture format is not valid , try with a jpg / jpeg / png / gif file." , "danger");
      }

    }else {
      /*If user dont upload photo , send alert*/
      echo user_alert("You are not uploaded a picture , this post was uploaded with default picture" , "warning");

      /*Set a variable with name of default post picture*/
      $picture_two_name = 'default-event-picture.jpg';

    }


    echo $date_event;

    $sql = "INSERT INTO events VALUES(null , '$title' , '$short_description' , '$body' , '$picture_one_name' , '$picture_two_name' , '$date_event' )";
    $upload_event = mysqli_query($database , $sql);

    if($upload_event){
      echo user_alert("The event was uploaded successful" , "success");
    }else {
      echo user_alert("The event was not uploaded ,  try again" , "danger");
    }

  }


  /*===================================================
  Delete event
  ====================================================*/
  if(isset($_GET['delete_event'])){
    $id = $_GET['delete_event'];

    $sql = "DELETE FROM events WHERE id = '$id' ";
    $delete_event = mysqli_query($database , $sql);

    if ($delete_event) {
      echo user_alert("The event was deleted successful" , "success");

      /*Verify if the post had a picture , this code will delete this photo*/
      $delete_event_picture_one = $_GET['delete_event_picture_one'];
      $delete_event_picture_two = $_GET['delete_event_picture_two'];

      if($delete_event_picture_one != 'default-event-picture.jpg'){
        unlink("../../assets/images/events/$delete_event_picture_one");
      }
      if($delete_event_picture_two != 'default-event-picture.jpg'){
        unlink("../../assets/images/events/$delete_event_picture_two");
      }

    }else {
      echo user_alert("The post was not deleted" , "danger");
    }



  }


  /*Get info of home from database*/
  $sql = "SELECT * FROM events";
  $events = mysqli_query($database , $sql);





?>

<!--Here is for create a new post-->
<div class="container">

  <h2>Create a new event</h2>

  <form method="post" action="manage.php?manager=events" enctype="multipart/form-data">

    <div class="form-group">
      <div class="form-row">
        <div class="col">
          <label for="title">Title of event</label>
          <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="col">
          <label for="date_event">Date of event</label>
          <input type="date" class="form-control" id="date_event" name="date_event" required>
        </div>
      </div>
    </div>





    <div class="form-group">
      <label for="short_description">Short description</label>
      <input type="text" class="form-control" id="short_description" name="short_description" required>
    </div>

    <div class="form-group">
      <label for="body">Description of event</label>
      <textarea class="form-control" id="body" rows="3" name="body" required></textarea>
    </div>

    <div class="form-group">
      <div class="form-row">
        <div class="col">
          <input type="file" class="custom-file-input" id="picture_one" lang="es" name="picture_one">
          <label class="custom-file-label" for="customFileLang">Picture one</label>

        </div>
        <div class="col">
          <input type="file" class="custom-file-input" id="picture_two" lang="es" name="picture_two">
          <label class="custom-file-label" for="customFileLang">Picture two</label>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Upload a new event</button>

</div>

<hr>


<div class="container">
  <h2>Manager Posts</h2>
  <p>Here you view and delete the posts.</p>

  <h3>Posts</h3>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Title</th>
          <th scope="col">Short description</th>
          <th scope="col">Body</th>
          <th scope="col">Date</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>

        <?php while($event = mysqli_fetch_assoc($events)): ?>
        <?php
          $id = $event['id'];
          $title = $event['title'];
          $short_description = $event['short_description'];
          $body = $event['body'];
          /*Error to write data base the name of this column :) :)*/
          $date_event = $event['date_post'];
          $picture_one = $event['picture_one'];
          $picture_two = $event['picture_two'];
        ?>
          <tr>
            <td><?= $id ?></td>
            <td><?= $title ?></td>
            <td><?= $short_description ?></td>
            <td><?= $body ?></td>
            <td><?= $date_event ?></td>
            <td>
              <!--Link for delete event-->
              <a href="manage.php?manager=events&delete_event=<?= $id ?>&delete_event_picture_one=<?= $picture_one ?>&delete_event_picture_two=<?= $picture_two ?>" class="btn btn-danger" role="button" aria-pressed="true">Delete event</a>
            </td>
          </tr>
        <?php endwhile; ?>



        </tr>
      </tbody>

    </table>

</div>
