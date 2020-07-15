<?php

  /*Get links from database*/
  $sql = "SELECT * FROM site_information";
  $query = mysqli_query($database , $sql);

  if($query && mysqli_num_rows($query) == 1){
    $links = mysqli_fetch_assoc($query);

    $facebook_link = $links['facebook_link'];
    $instagram_link = $links['instagram_link'];
    $twitter_link = $links['twitter_link'];
    $whatsapp_number = $links['whatsapp_number'];
    $email = $links['email'];
    $phone_number = $links['phone_number'];

  }

?>


<footer>
  <span>John Smith <?php echo date('yy'); ?></span>

  <div class="row">
    <a href="<?= $facebook_link ?>" class="col-md-3">
      <i class="facebook icon"></i>Facebook
    </a>
    <a href="https://api.whatsapp.com/send?phone=<?= $whatsapp_number ?>&text=Hello%20John%20Smith" class="col-md-3">
      <i class="whatsapp icon"></i>WhatsApp
    </a>
    <a href="<?= $instagram_link ?>" class="col-md-3">
      <i class="instagram icon"></i>instagram
    </a>
    <a href="mailto:<?= $email ?>" class="col-md-3">
      <i class="paper plane icon"></i>Email
    </a>
  </div>





</footer>


<!--Dependencies-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="styles/semantic/semantic.min.js"></script>

<script type="text/javascript" src="js/script.js"></script>


</body>
</html>
