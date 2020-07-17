<?php

  require 'database/conexion.php';
  require 'helpers/alerts.php';
  require 'helpers/substract.php';
  require 'includes/header.php';

  /*If there dates get for logut*/
  if(isset($_GET['logout'])){
    /*Delete the user cookie and restart*/
    setcookie('user[id]','', time()-100 );
    setcookie('user[username]','', time()-100 );
    setcookie('user[email]','', time()-100 );
    setcookie('user[photo]','', time()-100 );
    setcookie('user[admin]','', time()-100 );
    header('location: index.php');
  }

?>

<!--====================================================================-->
<!--Show alerts-->
<?php

  //Login Alert
  if (isset($_GET['login'])) {
    switch($_GET['login']){
      case 'successful':
        echo user_alert("Login Successful" , "success");
        break;
      case 'error_password':
        echo user_alert("Error Password" , "danger");
        break;
      case 'error_user':
        echo user_alert("Error user email" , "danger");
        break;
    }
  }

  //Signup alerts
  if (isset($_GET['signup'])) {
    switch($_GET['signup']){
      case 'error_confirm_password':
        echo user_alert("Error to confirm password." , "danger");
        break;
    }
  }

?>
<!--====================================================================-->


<!--Switch between Pages-->
<?php

  if(isset($_GET['page'])){
    switch ($_GET['page']) {
      case 'home':
        require 'pages/home.php';
        break;
      case 'events':
        require 'pages/events.php';
        break;
      case 'blog':
        require 'pages/blog.php';
        break;
      case 'contact':
        require 'pages/contact.php';
        break;
      case 'podcast':
        require 'pages/podcast.php';
        break;
      case 'galery':
        require 'pages/galery.php';
        break;
      default:
        require 'pages/home.php';
        break;
    }
  }else {
    require 'pages/home.php';
  }
?>


<?php

  require 'includes/footer.php';

?>
