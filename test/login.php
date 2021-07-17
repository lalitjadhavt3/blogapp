﻿<?php


  // Initialize the session

   include('gconfig.php');
  // Check if the user is logged in, if not then redirect him to login page
  if(empty($_SESSION['access_token'])) {
     //Create a URL to obtain user authorization
    $google_login_btn = '<a class="btn btn-info btn-lg w-100" href="'.$google_client->createAuthUrl().'">Login with <img src="logo.png" style="width: 10%;margin-left: 10%;"></a>';
      
   }
     else
        {
           header("Location: dashboard.php");
        }



?>
<!DOCTYPE html>
<html lang="en">
<!-- Copied from http://demo.designing-world.com/newsten-v1.0.1/login.html by Cyotek WebCopy 1.7.0.600, 16 July 2021, 12.21.29 PM -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title>TestDemo</title>
    <!-- Favicon-->
    <link rel="icon" href="img/core-img/favicon.ico">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
      <!-- Shape-->
      <div class="login-shape"><img src="img/core-img/login.png" alt=""></div>
      <div class="login-shape2"><img src="img/core-img/login2.png" alt=""></div>
      <div class="container">
        <!-- Login Text-->
        <div class="login-text text-center"><img class="login-img" src="img/bg-img/12.png" alt="">
          <h3 class="mb-0">Welcome Back!</h3>
          <!-- Shapes-->
          <div class="bg-shapes">
            <div class="shape1"></div>
            <div class="shape2"></div>
            <div class="shape3"></div>
            <div class="shape4"></div>
            <div class="shape5"></div>
            <div class="shape6"></div>
            <div class="shape7"></div>
            <div class="shape8"></div>
          </div>
        </div>
        <!-- Register Form-->
        <div class="register-form mt-5 px-3">
          <form action="home.html" method="post">
            <div class="form-group text-left mb-4">
              <label for="username"><i class="lni lni-user"></i></label>
              <input class="form-control" id="username" type="text" name="username" placeholder="Username or email">
            </div>
            <div class="form-group text-left mb-4">
              <label for="password"><i class="lni lni-lock"></i></label>
              <input class="form-control" id="password" type="password" name="password" placeholder="Password">
            </div>
            <button class="btn btn-primary btn-lg w-100">Login</button>
          </form>
        </div>
        <!-- Login Meta-->
        <div class="login-meta-data text-center"><a class="forgot-password d-block mt-3 mb-1" href="forget-password.html">Forgot Password?</a>
          <p class="mb-0">Didn't have an account?<a class="ml-2" href="register.html">Register</a></p>
        </div>
        <?php echo $google_login_btn;?>
      </div>
    </div>
    <!-- All JavaScript Files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animatedheadline.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/default/date-clock.js"></script>
    <script src="js/default/dark-mode-switch.js"></script>
    <script src="js/default/active.js"></script>
  </body>
<!-- Copied from http://demo.designing-world.com/newsten-v1.0.1/login.html by Cyotek WebCopy 1.7.0.600, 16 July 2021, 12.21.29 PM -->
</html>