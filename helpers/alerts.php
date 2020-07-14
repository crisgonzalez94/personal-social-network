<?php

  function user_alert($message , $type){

    /*The $type argument changes betwenn alert class of bootrap*/

    return "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
              <strong>$message</strong>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
            </div>";
  }

?>
