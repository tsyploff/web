<?php
    $db = mysqli_connect("localhost", "u11", "magenta_july", "u11_db");

    if (!$db) {
      echo "error!" . mysqli_connect_error() ;
    }
    mysqli_set_charset($db,'utf8');
?>