<?php
  include ("functions.php");
  
  //pentru debug
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  session_start();

  $functions = new functions();


  $functions->Logout();
  


?>