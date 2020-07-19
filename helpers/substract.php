<?php

  function substract($max_chararters , $string ){

    $long_string = strlen($string);

    $cut = $long_string - $max_chararters;

    $string = substr($string , 0 , $max_chararters);

    return $string;

  }


 ?>
