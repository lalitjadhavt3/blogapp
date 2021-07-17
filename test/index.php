<?php 
 include('gconfig.php');
// Initialize the session
//print_r($_SESSION);


// Check if the user is logged in, if not then redirect him to login page
if(empty($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   header('location:login.php');
 }
   else
      {
     header("Location: dashboard.php");
      }

?>