<?php

  /*=========================================================
  Upload a new post
  ==========================================================*/
  if(!empty($_POST['title']) && !empty($_POST['short_description']) && !empty($_POST['body'])){

    $title = $_POST['title'];
    $short_description = $_POST['short_description'];
    $body = $_POST['body'];
    $picture = $_FILES['picture'];

    /*Verify if there a picture in post*/
    if($picture['name']){

      $picture_name = $picture['name'];
      $picture_type = $picture['type'];

      /*Verify type of photo*/
      if( $picture_type == 'image/jpg' or $picture_type == 'image/jpeg' or $picture_type == 'image/gif' or $picture_type == 'image/png'){

        //Ask if exist the directorie where will save the photos
        if(!is_dir('../../assets/images/posts')){
           //Make the folder
           mkdir('../../assets/images/posts' , 0777);
        }

        move_uploaded_file($_FILES['picture']['tmp_name'] , "../../assets/images/posts/$picture_name" );


      }else {
        /*If format file is not a picture ,send alert to frontend*/
        echo user_alert("The picture format is not valid , try with a jpg / jpeg / png / gif file." , "danger");
      }

    }else {
      /*If user dont upload photo , send alert*/
      echo user_alert("You are not uploaded a picture , this post was uploaded with default picture" , "warning");

      /*Set a variable with name of default post picture*/
      $picture_name = 'default-post-picture.jpg';

    }

    $sql = "INSERT INTO posts VALUES(null , '$title' , '$short_description' , '$body' , '$picture_name' , CURDATE() )";
    $upload_post = mysqli_query($database , $sql);

    if($upload_post){
      echo user_alert("The post was uploaded successful" , "success");
    }else {
      echo user_alert("The post was not uploaded ,  try again" , "danger");
    }

  }


  /*===================================================
  Delete post
  ====================================================*/
  if(isset($_GET['delete_post'])){
    $id = $_GET['delete_post'];

    $sql = "DELETE FROM posts WHERE id = '$id' ";
    $delete_post = mysqli_query($database , $sql);

    if ($delete_post) {
      echo user_alert("The post was deleted successful" , "success");

      /*Verify if the post had a picture , this code will delete this photo*/
      $delete_post_picture = $_GET['delete_post_picture'];

      if($delete_post_picture != 'default-post-picture.jpg'){
        unlink("../../assets/images/posts/$delete_post_picture");
      }

    }else {
      echo user_alert("The post was not deleted" , "danger");
    }



  }

  $sql = "SELECT * FROM posts";
  $posts = mysqli_query($database , $sql);

?>

<!--Here is for create a new post-->
<div class="container">

  <h2>Create a new post</h2>

  <form method="post" action="manage.php?manager=post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="title">Title of post</label>
      <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="form-group">
      <label for="short_description">Short description</label>
      <input type="text" class="form-control" id="short_description" name="short_description" required>
    </div>

    <div class="form-group">
      <label for="body">Write a post</label>
      <textarea class="form-control" id="body" rows="3" name="body" required></textarea>
    </div>

    <div class="form-group">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="picture" lang="es" name="picture">
        <label class="custom-file-label" for="customFileLang">Upload a picture</label>
      </div>
    </div>

    <button type="submit" class="btn btn-dark">Upload new post</button>

</div>

<hr>


<!--Here can view and delete the posts-->
<div class="container">
  <h2>Manager Posts</h2>
  <p>Here you view and delete the posts.</p>

  <h3>Posts</h3>

    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">id</th>
          <th scope="col">Titulo</th>
          <th scope="col">Short description</th>
          <th scope="col">Date</th>
          <th scope="col">Edit</th>
        </tr>
      </thead>
      <tbody>

        <!--Loop of posts on database-->
        <?php while($post = mysqli_fetch_assoc($posts)): ?>
        <?php
          $id = $post['id'];
          $title = $post['title'];
          $short_description = $post['short_description'];
          $date_post = $post['date_post'];
          $picture =$post['picture'];
        ?>

        <tr>
          <td><?= $id ?></td>
          <td><?= $title ?></td>
          <td><?= $short_description ?></td>
          <td><?= $date_post ?></td>
          <td>
            <!--Link for delete post-->
            <a href="manage.php?manager=post&delete_post=<?= $id ?>&delete_post_picture=<?= $picture ?>" class="btn btn-danger" role="button" aria-pressed="true">Delete post</a>
          </td>
          <!--===============================-->
        </tr>

        <?php endwhile; ?>
        <!--============================-->

        </tr>
      </tbody>

    </table>

</div>
