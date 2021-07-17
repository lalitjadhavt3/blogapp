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
            <!-- Scroll Indicator-->
            <div id="scrollIndicator"></div>
            <!-- Single Blog Thumbnail-->
            <div class=" promo-slider">
                <?php 
                    extract($_GET);
                    require 'db.php';
                    $select = "select * from blog_images inner join user_blogs on user_blogs.id = blog_images.blog_id inner join blog_cat on user_blogs.blog_cat = blog_cat.cat_id where blog_images.blog_id = '$id'";
                    mysqli_query($con,"SET CHARACTER SET 'utf8'");
                    mysqli_query($con,"SET SESSION collation_connection ='utf8_unicode_ci'");
                    //mysqli_real_escape_string($con);
                    if ($result = $con->query($select)) {
                     
                        while ($data = $result->fetch_assoc()) {

                           $realpath = dirname($data["imgname"]);
                       $path = str_replace($realpath, "", trim($data["imgname"]));
                       $path=  "blog_img".$path; 
                       extract($data);
                       echo '<div class="item">
                        <img src = "'.$path.'" style="width:500px;height:250px">
                        </div>
                       ';
                   }
               }
                ?>
            </div>
            <!-- Single Blog Info-->
            <div class="single-blog-info">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <!-- Post Like Wrap-->
                        
                        <!-- Post Content Wrap-->
                        <div class="post-content-wrap">
                            <a class="post-catagory d-inline-block mb-2" href="javascript:;"><?php echo $cat_name;?></a>
                            <h5 class="mb-2"><?php echo $blog_title;?></h5>
                            <div class="post-meta"><a class="post-date" href="javascript:;"><?php echo date("d M Y",strtotime($blog_date));?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blog Description-->
            <div class="blog-description">
                <div class="container">
                    <p>
                        <?php echo $blog_desc; ?>
                    </p>
                    
                </div>
            </div>
            <!-- Post Author-->
            
            <!-- Related Post-->
           
        </div>
        <!-- Footer Nav-->
        <div class="footer-nav-area" id="footerNav">
          <div class="newsten-footer-nav h-100">
            <ul class="h-100 d-flex r" style="width: 105%;justify-content: space-evenly;">
              <li >
                <a href="dashboard.php"><i class="lni lni-home"></i> Home</a>
              </li>
              <li class="active">
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

        <script type="text/javascript">
            $('.promo-slider').slick({
                 autoplay: true,
                  autoplaySpeed: 3000,
                  
                infinite: true,
                speed: 300,
            });
        </script>
    </body>
   
</html>
