<?php

 session_start();

 unset($_SESSION['id']);
 unset($_SESSION['username']);

 session_destroy();
 
 header("location: index.php");
 
 exit();
 ?>