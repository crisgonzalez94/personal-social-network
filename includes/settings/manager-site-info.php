<?php

  /*Get info of site from database*/
  $sql = "SELECT * FROM site_information";
  $query = mysqli_query($database , $sql);

  if($query && mysqli_num_rows($query) == 1){
    //Save query in a variable
    $site_info= mysqli_fetch_assoc($query);

    $facebook_link = $site_info['facebook_link'];
    $instagram_link = $site_info['instagram_link'];
    $twitter_link = $site_info['twitter_link'];
    $whatsapp_number = $site_info['whatsapp_number'];
    $email = $site_info['email'];
    $phone_number = $site_info['phone_number'];

    /*If there a update of date by post*/
    if(!empty($_POST['facebook_link']) && !empty($_POST['instagram_link']) && !empty($_POST['twitter_link']) && !empty($_POST['whatsapp_number']) && !empty($_POST['email']) && !empty($_POST['phone_number']) ){


      /*Save post dates in variable*/
      $new_facebook_link = $_POST['facebook_link'];
      $new_instagram_link = $_POST['instagram_link'];
      $new_twitter_link = $_POST['twitter_link'];
      $new_whatsapp_number = $_POST['whatsapp_number'];
      $new_email = $_POST['email'];
      $new_phone_number = $_POST['phone_number'];

      /*Update info is a function in 'conexion.php' that update dates of database*/

      /*Update Facebook*/
      $update_facebook_link = update_info('site_information' , 'facebook_link' , $facebook_link , $new_facebook_link , $database);
      /*Update instagram*/
      $update_instagram_link = update_info('site_information' , 'instagram_link' , $instagram_link , $new_instagram_link , $database);
      /*Update twitter_link*/
      $update_twitter_link = update_info('site_information' , 'twitter_link' , $twitter_link , $new_twitter_link , $database);
      /*Update whatsapp_number*/
      $update_whatsapp_number = update_info('site_information' , 'whatsapp_number' , $whatsapp_number , $new_whatsapp_number , $database);
      /*Update email*/
      $update_email = update_info('site_information' , 'email' , $email , $new_email , $database);
      /*Update Phone Number*/
      $update_phone_number = update_info('site_information' , 'phone_number' , $phone_number , $new_phone_number , $database);

      if($update_facebook_link && $update_instagram_link && $update_twitter_link && $update_whatsapp_number && $update_email && $update_phone_number){
        $facebook_link = $new_facebook_link;
        $instagram_link = $new_instagram_link;
        $twitter_link = $new_twitter_link;
        $whatsapp_number = $new_whatsapp_number;
        $email = $new_email;
        $phone_number = $new_phone_number;

        echo user_alert("Update successful" , "success");

      }else {
        echo user_alert("Error to update" , "danger");
      }



    }



  }




 ?>



<div class="container">
  <h2>Page info</h2>
  <p>Here you view and change the info and links of this page.</p>



  <?php if($query): ?>
    <form method="post" action="manage.php">
      <div class="form-group">
        <label for="facebook_link">Facebook Link</label>
        <input type="text" class="form-control" id="facebook_link" name="facebook_link" value="<?= $facebook_link ?>" required>
      </div>
      <div class="form-group">
        <label for="instagram_link">instagram Link</label>
        <input type="text" class="form-control" id="instagram_link" name="instagram_link" value="<?= $instagram_link ?>" required>
      </div>
      <div class="form-group">
        <label for="twitter_link">Twitter Link</label>
        <input type="text" class="form-control" id="twitter_link" name="twitter_link" value="<?= $twitter_link ?>" required>
      </div>
      <div class="form-group">
        <label for="whatsapp_number">Whatsapp Number</label>
        <input type="number" class="form-control" id="whatsapp_number" name="whatsapp_number" value="<?= $whatsapp_number ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
      </div>
      <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="number" class="form-control" id="phone_number" name="phone_number" value="<?= $phone_number ?>" required>
      </div>
      <button type="submit" class="btn btn-dark">Submit</button>
    </form>

  <?php endif; ?>

</div>
