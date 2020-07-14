<?php

  /*Get info of home from database*/
  $sql = "SELECT * FROM home";
  $query = mysqli_query($database , $sql);

  if($query && mysqli_num_rows($query) == 1){
    //Save query in a variable
    $home = mysqli_fetch_assoc($query);

    $title = $home['title'];
    $biography = $home['biography'];
    $photo = $home['photo'];

    /*If there a update of date by post*/
    if( !empty($_POST['title']) && !empty($_POST['biography']) ){


      /*Save post dates in variable*/
      $new_title = $_POST['title'];
      $new_biography = $_POST['biography'];


      /*Update database*/
      $update_title = update_info('home' , 'title' , $title , $new_title , $database);
      $update_biography = update_info('home' , 'biography' , $biography , $new_biography , $database);

      /*Save Photo*/
      $new_photo = $_FILES['photo']['name'];

      if($new_photo){

        $update_photo = update_info('home' , 'photo' , $photo , $new_photo , $database);
        /*This is for show in frontend*/
        $photo = $new_photo;

        /*Get type of photo*/
        $new_photo_type = $_FILES['photo']['type'];

        /*Verify type of photo*/
        if($new_photo_type == 'image/jpg' or $new_photo_type == 'image/jpeg' or $new_photo_type == 'image/gif' or $new_photo_type == 'image/png'){

          //Ask if exist the directorie where will save the photos
          if(!is_dir('../../assets/images/profile-autor-image')){
             //Make the folder
             mkdir('../../assets/images/profile-autor-image' , 0777);
          }

          move_uploaded_file($_FILES['photo']['tmp_name'] , "../../assets/images/profile-autor-image/$new_photo" );

          $photo = $new_photo;

        }

      }else {
        echo "No hay photo";
      }


      if( $update_title && $update_biography ){
        /*This is for show in frontend*/
        $title = $new_title;
        $biography = $new_biography;

        echo user_alert("Update successful" , "success");

      }else {
        echo user_alert("Error to update" , "danger");
      }



    }



  }




 ?>



<div class="container">
  <h2>Manager Biography</h2>
  <p>Here you view and change the info and links of this page.</p>



  <?php if($query): ?>

    <form method="post" action="manage.php?manager=home" enctype="multipart/form-data">

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" required>
      </div>

      <div class="form-group">
        <label for="biography">Biography</label>
        <textarea class="form-control" id="biography" rows="3" name="biography" required><?= $biography ?></textarea>
      </div>

      <div class="card mb-3">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="../../assets/images/profile-autor-image/<?= $photo ?>" class="card-img" alt="John Smith">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Change Photo of Biography</h5>

              <p>This site will be adapted according to the size of the photograph but preferably upload photos of 1000px x 1000px</p>

              <!--Input file-->
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupFileAddon01">Upload Photo</span>
                </div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="photo">
                  <label class="custom-file-label" for="inputGroupFile01">Choose photo</label>
                </div>
              </div>
              <!--========================================================================================-->

            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-dark">Submit</button>
    </form>

  <?php endif; ?>

</div>
