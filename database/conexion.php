<?php

  $host = 'localhost'; $user = 'root'; $password = ''; $database = 'john_smith';


  $database = mysqli_connect($host , $user , $password , $database);


  function  update_info($db_table , $column , $old_info , $new_info , $database){

    $sql = " UPDATE $db_table SET $column = '$new_info' WHERE $column = '$old_info' ";
    $update = mysqli_query($database , $sql);

    if ($update) {
      return true;
    }else {
      return false;
    }



  }

?>
