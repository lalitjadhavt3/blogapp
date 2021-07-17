<?php

  //Include Google Configuration File
  include('gconfig.php');

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
    header('location:login.php');
  } else {

    header("Location: dashboard.php");
  }
?>
