<?php
require 'db.php';
//Include Google Configuration File
include('gconfig.php');
//print_r($_SESSION);
if($_SESSION['access_token'] == '') {
  header("Location: login.php");
} 

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 
  extract($_SESSION);
 	$update_query = "insert into  users (user_fname,user_lname,user_email,user_image) values ('$user_first_name','$user_last_name','$user_email_address','$user_image')";
 	
 	$result = $con->query($update_query); 

 }
}
extract($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags-->
    <!-- Title-->
    <title>News Ten - Blog &amp; Magazine Mobile HTML Template</title>
    <!-- Favicon-->
    <link rel="icon" href="test/img/core-img/favicon.ico" />
    <!-- Stylesheet-->
    <link rel="stylesheet" href="test/style.css" />
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>
    <!-- Header Area-->
    
    <!-- Sidenav Black Overlay-->
   
    <div class="page-content-wrapper">
      <!-- News Today Wrapper-->
      <div class="profile-content-wrapper" style="background: white">
         <!-- Settings Option-->
        <div class="profile-settings-option">
            <a href="logout.php"><i class="lni lni-power-switch"></i></a>
         </div>
         <div class="container">
            <div class="user-meta-data d-flex align-items-center">
               <div class="user-thumbnail" style="width: 50px!important"><img src="<?php echo $user_image;?>" style="width: 50px;height: 50px" alt="" /></div>
               <div class="user-content">
                  <h6>Hello,<?php echo $user_first_name.' '.$user_last_name;?></h6>
                 
                  
               </div>
            </div>
         </div>
      </div>
      <div class="top-catagories-wrapper">
        <div class="bg-shapes">
          <div class="shape1"></div>
          <div class="shape2"></div>
          <div class="shape3"></div>
          <div class="shape4"></div>
          <div class="shape5"></div>
        </div>
        
        <h6 class="mb-3 catagory-title">Top Catagories</h6>
        <div class="container">
          <!-- Catagory Slides-->
          <div class="catagory-slides owl-carousel">
            <!-- Catagory Card-->
            <div class="card catagory-card">
              <a href="blog_cat.php?cat=1">
                <img style="width: 200px;height: 100px" src="img/Tech.png" alt="" />
                <h6>Tech</h6>
              </a>
            </div>
            <!-- Catagory Card-->
            <div class="card catagory-card">
              <a href="blog_cat.php?cat=2">
                <img style="width: 200px;height: 100px" src="img/Science.png" alt="" />
                <h6>Science</h6>
              </a>
            </div>
            
            <div class="card catagory-card">
              <a href="blog_cat.php?cat=4">
                <img style="width: 200px;height: 100px" src="img/Food.png" alt="" />
                <h6>Food</h6>
              </a>
            </div>
            <div class="card catagory-card">
              <a href="blog_cat.php?cat=3">
                <img style="width: 200px;height: 100px" src="img/Fashion.png" alt="" />
                <h6>Fashion</h6>
              </a>
            </div>
            <!-- Catagory Card-->
           
          </div>
        </div>
      </div>

      <div class="news-today-wrapper">
        <div class="container">
          <div class="d-flex align-items-center justify-content-between">
            <h5 class="mb-3 pl-1 newsten-title">Latest Blogs</h5>
            
          </div>
          <!-- Hero Slides-->
          <!-- Hero Slides-->
          <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide-->
            <?php 
            	$select = "";
            	$path = "";
            	$update_query = "select * from user_blogs inner join blog_cat on user_blogs.blog_cat = blog_cat.cat_id inner join users on user_blogs.user_id = users.user_id  order by user_blogs.blog_date desc";
            	//echo $update_query;
            	mysqli_query($con,"SET CHARACTER SET 'utf8'");
            	mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
            	if ($result = $con->query($update_query)) {
            	  while ($data = $result->fetch_assoc()) {
            	       $blog_id = $data["id"];
            	       $select = "select * from blog_images where blog_id = $blog_id limit 1";
            	       
            	       extract($data);
            	       if ($result2 = $con->query($select)) {
            	         while ($data2 = $result2->fetch_assoc()) {
            	               $realpath = dirname($data2["imgname"]);
            	           $path = str_replace($realpath, "", trim($data2["imgname"]));
            	           $path=  "blog_img".$path;
            	         }
            	       }
            	       //echo($select);
            	          
            	           	echo "<div class='single-hero-slide' style='background-image: url(".$path.")';>
            	          
            	             <div class='background-shape'>
            	               <div class='circle2'></div>
            	               <div class='circle3'></div>
            	             </div>
            	             <div class='slide-content h-100 d-flex align-items-end'>
            	               <div class='container-fluid mb-3'>
            	                 
            	                 <a class='bookmark-post' href='javascript:;'></a><a class='post-catagory' href='javascript:;'>".$cat_name."</a>
            	                 <a class='post-title d-block' href='blogs.php?id=".$blog_id."'>".$blog_title."</a>
            	                 <div class='post-meta d-flex align-items-center'>
            	                   <a href='#'><i class='mr-1 lni lni-user'></i>".$user_name."</a><a href='javascript:;'><i class='mr-1 lni lni-calendar'></i>".date('d M Y',strtotime($data['blog_date']))."</a>
            	                 </div>
            	               </div>
            	             </div>
            	           </div>";
            	    }
            	  }
            	
            ?>
            <!-- Single Hero Slide-->
          
          </div>
        </div>
      </div>
      <!-- Top Catagories Wrapper-->
      <div class="user-all-article-wrapper">
         <div class="container">
            <div class="d-flex align-items-center justify-content-between">
               <h6 class="mb-3 newsten-title">All Blogs</h6>
              
            </div>
         </div>
         <div class="container">
            <!-- Single News Post-->

            <?php
           
              $update_query = "select * from user_blogs inner join blog_cat on user_blogs.blog_cat = blog_cat.cat_id inner join users on user_blogs.user_id = users.user_id ";
              //echo $update_query;
              mysqli_query($con,"SET CHARACTER SET 'utf8'");
              mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
              $res = $con->query($update_query);
              $numrows = mysqli_num_rows($res);
              if($numrows > 0)
              {if ($result = $con->query($update_query)) {
                while ($data = $result->fetch_assoc()) {
                     $blog_id = $data["id"];
                     $select = "select * from blog_images where blog_id = $blog_id limit 1";
                     $path = "";
                     if ($result2 = $con->query($select)) {
                       while ($data2 = $result2->fetch_assoc()) {
                             $realpath = dirname($data2["imgname"]);
                         $path = str_replace($realpath, "", trim($data2["imgname"]));
                         $path=  "blog_img".$path;
                       }
                     }
                     //echo($select);
                        echo '<div class="single-trending-post d-flex">
                           <div class="post-thumbnail"><img style="width:70px;height:60px" src="'.$path.'" alt=""></div>
                           <div class="post-content"><a class="post-title" href="blogs.php?id='.$blog_id.'">'.$data["blog_title"].'</a>
                             <div class="post-meta d-flex align-items-center"><a href="javascript:;">'.$data["cat_name"].'</a><a href="javascript:;">'.date("d M Y",strtotime($data["blog_date"])).'</a></div>
                           </div>
                         </div>';
                  }
                }
              }
              else{
                        echo "<h3>There no blog posts at this moment </h3><br><a class='btn btn-info' href='createblog.php'>Create Blog Post</a>";
                    }

            
             
              
            ?>

         </div>
      </div>
      <!-- Trending News Wrapper-->
      
      <!-- Editorial Choice News Wrapper-->
      
     
    </div>
    <!-- Footer Nav-->
    <div class="footer-nav-area" id="footerNav">
      <div class="newsten-footer-nav h-100">
        <ul class="h-100 d-flex r" style="width: 105%;justify-content: space-evenly;">
          <li class="active">
            <a href="dashboard.php"><i class="lni lni-home"></i> Home</a>
          </li>
          <li>
            <a href="profile.php"><i class="lni lni-user"></i> Profile</a>
          </li>
          
        </ul>
      </div>
    </div>
    <!-- All JavaScript Files-->
    <script src="test/js/jquery.min.js"></script>
    <script src="test/js/popper.min.js"></script>
    <script src="test/js/bootstrap.min.js"></script>
    <script src="test/js/waypoints.min.js"></script>
    <script src="test/js/jquery.easing.min.js"></script>
    <script src="test/js/owl.carousel.min.js"></script>
    <script src="test/js/jquery.animatedheadline.min.js"></script>
    <script src="test/js/jquery.counterup.min.js"></script>
    <script src="test/js/wow.min.js"></script>
    <script src="test/js/default/date-clock.js"></script>
    <script src="test/js/default/dark-mode-switch.js"></script>
    <script src="test/js/default/active.js"></script>
  </body>
</html>
