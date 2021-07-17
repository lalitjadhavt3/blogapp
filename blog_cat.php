<?php
    include 'gconfig.php';
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
        <link rel="stylesheet" type="text/css" href="slick\slick.min.css" />
        <link rel="stylesheet" type="text/css" href="slick\slick-theme.min.css" />
    </head>
    <body>
        <!-- Preloader-->
        <div class="preloader" id="preloader">
            <div class="spinner-grow text-secondary" role="status">
                <div class="sr-only">Loading...</div>
            </div>
        </div>
        <!-- Header Area-->
         
        <!-- Center Modal-->
        <div class="page-content-wrapper">
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
            <div class="catagory-posts-wrapper">

                <div class="container">
                    <div class="d-flex align-items-center justify-content-between">
                        <?php 
                            extract($_GET);
                            require 'db.php';
                            $select = "select * from blog_cat where blog_cat.cat_id = '$cat'";
                            
                            //mysqli_real_escape_string($con);
                            if ($result = $con->query($select)) {
                             
                                while ($data = $result->fetch_assoc()) {
                                    echo '<h5 class="mb-3 pl-2 newsten-title">'.$data["cat_name"].'</h5>';
                                }
                            }
                        ?>
                        
                    </div>
                </div>
                <div class="container">
                    <!-- Single News Post-->
                     <?php 
                         extract($_GET);
                         require 'db.php';
                         $select = "select * from user_blogs inner join blog_cat on user_blogs.blog_cat = blog_cat.cat_id inner join users on user_blogs.user_id = users.user_id blog_cat.cat_id = '$cat'  order by user_blogs.blog_date desc ";

                         mysqli_query($con,"SET CHARACTER SET 'utf8'");
                         $path = "";
                         mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
                         //mysqli_real_escape_string($con);
                         $res = $con->query($select);
                         $numrow = mysqli_num_rows($res);
                         if($numrow > 0)
                         {
                                 if ($result = $con->query($select)) {
                                  
                                     while ($data = $result->fetch_assoc()) {
                                        $blog_id = $data["id"];
                                        $select2 = "select * from blog_images where blog_id = $blog_id limit 1";
                                        
                                        extract($data);
                                        if ($result2 = $con->query($select2)) {
                                          while ($data2 = $result2->fetch_assoc()) {
                                                $realpath = dirname($data2["imgname"]);
                                            $path = str_replace($realpath, "", trim($data2["imgname"]));
                                            $path=  "blog_img".$path;
                                          }
                                        }
                                       
                                   
                                   echo '<div class="single-news-post d-flex align-items-center bg-gray">
                                <div class="post-thumbnail">
                                    
                                    <img src="'.$path.'" alt="" style="width:100px;height:80px" />
                                </div>
                                <div class="post-content">
                                    <a class="post-title" href="blogs.php?id='.$data["id"].'">'.$data["blog_title"].'</a>
                                    <div class="post-meta d-flex align-items-center"><a href="#">'.$data["blog_date"].'</a></div>
                                </div>
                            </div>';
                            extract($data);
                                }
                            }
                         }
                        
                    else{
                        echo "<h3>There no blog posts under this category</h3><br><a class='btn btn-info' href='dashboard.php'>Go Back</a>";
                    }

                     ?>
                    
                    
                </div>
                
            </div>
        </div>
        
        <!-- Footer Nav-->
        <div class="footer-nav-area" id="footerNav">
          <div class="newsten-footer-nav h-100">
            <ul class="h-100 d-flex r" style="width: 105%;justify-content: space-evenly;">
              <li class="active">
                <a href="dashboard.php"><i class="lni lni-home"></i> Home</a>
              </li>
              <li >
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
        <script src="test/js/default/scrollindicator.js"></script>
        <script src="test/js/default/active.js"></script>
        <script type="text/javascript" src="slick\slick.min.js"></script>

    </body>
   
</html>
