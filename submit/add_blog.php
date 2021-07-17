<?php 
  //print_r($_FILES);
  //print_r($_POST);
$count = 0;
@session_start();
  if(isset($_POST))
  {
    require '../db.php';
       extract($_POST);
        $blog_date = date('d-m-Y');
        extract($_SESSION);
        $select = "select * from users where user_email like '$user_email_address'";
        if ($result = $con->query($select)) {
          while ($data = $result->fetch_assoc()) {
            extract($data);
          }
        }
        $insert = "insert into user_blogs (user_id,user_name,blog_title,blog_desc,blog_date,blog_cat) values ('$user_id','$user_first_name','$blog_title','$blog_desc','$blog_date','$blog_cat')";
        $fire_query= mysqli_query($con,$insert);
        //print_r($insert);
        if($fire_query)
        {
echo "success";
        $last_id = mysqli_insert_id($con);

       for($i=0;$i<count($_FILES['file']['name']);$i++)
       {
          $userfile_name  = $_FILES['file']['name'][$i]; // file name 
          $userfile_tmp   = $_FILES['file']['tmp_name'][$i]; // actual location 
          $userfile_size  = $_FILES['file']['size'][$i]; // file size 
          $userfile_type  = $_FILES['file']['type'][$i]; 
        // mime type of file sent by browser. PHP d check it.
          $userfile_error = $_FILES['file']['error'][$i]; // any error!. get from here
          // Content uploading.
          $file_data      = '';
                                               
          if (!empty($userfile_tmp)) 
          {
              // only MS office and text file is accepted.
              $file_data = base64_encode(@fread(fopen($userfile_tmp, 'rb'), filesize($userfile_tmp)));
                switch (true) 
              {
                  // Check error if any
                  case ($userfile_error == UPLOAD_ERR_NO_FILE):
                  case empty($file_data):
                      echo 'You must select a document to upload before you can save this page.';
                      
                      break;
                  case ($userfile_error == UPLOAD_ERR_INI_SIZE):
                  case ($userfile_error == UPLOAD_ERR_FORM_SIZE):
                      echo 'The document you have attempted to upload is too large.';
                      break;
                  case ($userfile_error == UPLOAD_ERR_PARTIAL):
                      echo 'An error occured while trying to recieve the file. Please try again.';
                      break;
              }
            $valid_extensions = array('jpeg', 'jpg', 'png','gif'); // valid extensions
            $dirpath = realpath(dirname(getcwd()));
            $path = $dirpath.'/blog_img/'; // upload directory
            
            // get uploaded file's extension
              $ext = strtolower(pathinfo($userfile_name, PATHINFO_EXTENSION));
            // can upload same image using rand function
              $final_file = "blog_img_".$userfile_name;
              $final_file = preg_replace("/[^a-zA-Z0-9.]/", "", $final_file);
            // check's valid format
              if(in_array($ext, $valid_extensions)) 
              { 
                $path = $path.strtolower($final_file); 
                if(move_uploaded_file($userfile_tmp,$path)) 
                  {
                    //echo '<h2>Successfully uploaded !</h2>';
                     $path = addslashes($path);
                     $file_path =   $path;
                     $file_type = $ext;
                     $insert_query= "insert into blog_images(blog_id,imgname)
                      values ('$last_id','$path')";


                
                   // echo $insert_query."<br>";  
                    $fire_query= mysqli_query($con,$insert_query);
                    //print_r($insert_query);
                    
                  }
                  
              } 
             
              
          }
       }
       
        
        

    }
  }
    
?>