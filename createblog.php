<?php

//Include Google Configuration File
include('gconfig.php');
require 'db.php';
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
 
  
 

 }
}
extract($_SESSION);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Responsive form design</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="HoldOn.min.css">

</head>
<body>
<!-- partial:index.partial.html -->
<section class="large-cta-section skrollable skrollable-between">
  <div class="medium-large-wrapper skrollable skrollable-after">
    <div class="medium-text-wrapper">
      <h2 class="h2 large white">Create Blog <span class="yellow">Post</span></h2>
      
    </div>
  </div>
  <img class="cta-purple-email skrollable skrollable-after" src="https://neverbounce.com/images/background-images/cta-purple-email.png" alt="email illustration">
  <img src="https://neverbounce.com/images/background-images/cta-left-line.svg" class="cta-left-line" alt="graphic line element">
  
  <img class="cta-blue-email skrollable skrollable-between" src="https://neverbounce.com/images/background-images/cta-blue-email.png" alt="email illustration">
</section>
<section class="contact-wrap">
    <form action="" class="contact-form" id="add_prod_img" method="post">
      <div class="col-sm-6">
          <div class="" style="margin: 5% 0%">
              <label style="color: black!important" for="" >Blog Category *</label>
              <select class="form-control" name="blog_cat" required >
                <option>Select Blog Category</option>
                <?php 
                  $update_query = "select * from blog_cat ";
                  //echo $update_query;
                  if ($result3 = $con->query($update_query)) {
                    while ($data3 = $result3->fetch_assoc()) {
                      echo '<option value="'.$data3["cat_id"].'">'.$data3["cat_name"].'</option>';
                    }
                  }
                ?>
              </select>
          </div>
      </div>
        <div class="col-sm-6">
            <div class="input-block">
                <label for="">Blog Title *</label>
                <input class="form-control" type="text" required name="blog_title">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-block textarea"><label>Blog Description *</label>
                <textarea rows="3" type="text" class="form-control" required name="blog_desc"></textarea>
            </div>
        </div>
        <div class="col-sm-12" style="margin: 4% 0%">
            <div class=" file">
                <label for="">Select Images*</label>
                <input class="form-control" type="file" name="file[]" multiple required accept=".png,.bmp,.jpeg,.jpg">
            </div>
        </div>
        <!-- <div class="col-sm-6">
            <div class="input-block">
                <label for="">Video Link (optional)</label>
                <input class="form-control" type="text">
            </div>
        </div> -->
        <div class="row d-flex" style="display: flex!important;text-align: center;justify-content: center;">
          <div class="col-sm-4 ">
              <button  class="btn btn-success">Submit</button>
          </div>
          <div class="col-sm-4 ">
              <a href="profile.php" class="btn btn-danger">Cancel</a>
          </div>
        </div>
        
    </form>
</section>

<!-- follow me template -->

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script  src="script.js"></script>
  <script  src="HoldOn.min.js"></script>
  <script type="text/javascript">
          $("#add_prod_img").submit(function () {
            
                        var formData = new FormData($("#add_prod_img")[0]);
                     $.ajax({
                                    type:"POST",
                                    url:"submit/add_blog.php",
                                    data:formData,
                                    processData: false,
                                    cache: false,
                                    contentType: false,
                                      beforeSend: function (){
                                    
                                      HoldOn.open({
                                          theme:'sk-rect',
                                          message:"<h4>Please Wait</h4>"
                                      });
                                    },
                                    success: function(data){
                                       HoldOn.close();
                                       
                                     if(data == "success")
                                    {
                                         swal("Success"," Blog Added !","success")
                                              .then((value) => {
                                                if (value) {
                                                     window.location.href="profile.php";
                                                     
                                                    } else {
                                                      window.location.href="profile.php";
                                                    }
                                                  });
                                       }
                                      
                                     //window.location.href="manage_slider.php";
                                    }
                                });
            
           
            
          return false;
        })
  </script>
</body>
</html>

