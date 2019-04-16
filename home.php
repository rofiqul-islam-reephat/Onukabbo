<?php

  session_start();

  include 'phpfunc/webfunctions.php';
  include 'phpfunc/dbfunctions.php';
  include 'phpfunc/querylist.php';

  if(!is_session_set()){
    redirect("index.php");
  }

 
 

  if(isset($_POST['submitpostbtn'])){

    $title = clean_input($_POST['title']);
    $body =  clean_input($_POST['body']);
    $tags =  clean_input($_POST['tags']);

    $userid = get_user_id($_SESSION['email']);

    

    $targetdirctory = "uploads/";
    $acceptlist = array("jpeg","jpg","gif","png");
    $newfilename = '';
    $readyfile = false;



    if(isset($_FILES['image'])){
      $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD , DBNAME);

      $filename =  $_FILES['image']['name'];
      $filetype=  $_FILES['image']['type'];
      $allowedlist = array("jpeg","jpg","png","gif");
      $fileext = pathinfo($filename, PATHINFO_EXTENSION);
      
      if(in_array($fileext,$allowedlist)=== true){
        $readyfile = true;
      }

      $newfilename = uniqid().round(microtime(true)). '.' . $fileext;

      
    }
    
    create_db_if_not_found();

    $status = create_table_if_not_found($posttable);
    $status2 = create_table_if_not_found($catagory);
    $status3 = create_table_if_not_found($posttag);
  
    if(!$status || !$status2 || !$status3){
      echo "failed";
    }

    if(!empty($title) && !empty($body)){

      $date =  date("Y/m/d");
      $userid = get_user_id($_SESSION['email']);
      $filepath ='';
      
      if($readyfile)
          $filepath =  "uploads/".$newfilename;
      
      
      $query = "INSERT INTO  post(userid,title,body,postdate,imagepath)
                              VALUES  ('$userid','$title','$body','$date','$filepath')";

      $tagarray = explode(',',$tags);

      
      foreach($tagarray as $tag){
        insert_tag_if_new($tag);
      }

     $id  = execute_query($query);

     glue_post_tag($id,$tagarray);

    if($readyfile)
       move_uploaded_file($_FILES['image']['tmp_name'],$filepath);


    }


  }
  


  

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width , initial-scale = 1.0">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>

<body>

  <div class="row">
    <div class="col-lg-2">
      <div class="row">
        <img src="img/logo.jpg" alt="logo" style="height:70px; width:190px; margin-left:20%;">
      </div>
    </div>
    <div class="col-lg-4">
      <button class="ml-4 btn btn-success mt-3" id="newpostbtn"> <i class="fas fa-paper-plane"></i>&nbsp&nbspWrite a Post</button>
      <button class="ml-4 btn btn-success mt-3" id="registerbtn"> <i class="fas fa-dice"></i>&nbsp&nbspRead Random Article</button>
    </div>
    <div class="col-lg-3 text-success">
      <div class="container">
        <div class="form-inline">
          <div class="input-group mt-3">
            <input type="text" class="form-control" id="serachfield" placeholder="Search Onukabbo">
            <div class="input-group-prepend">
              <button id="searchbtn" class=" rounded-sm btn btn-outline-success"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="container mt-3">
        <button id = "profilebtn" name = "profilebtn" type="submit" class="btn btn-outline-success" name="button"> <i class="fas fa-user-alt"></i>&nbsp&nbsp Profile</button>
        <button id = "signoutbtn" name ="signoutbtn" type="submit" class="btn btn-outline-success" name="button"> <i class="fas fa-sign-out-alt"></i>&nbsp&nbsp SignOut</button>
      </div>
    </div>
  </div>

  <div class="container" id="writenewpostdiv" style="display:none;">
    <div class="row">
      <div class="col-lg-2">
      </div>
      <div class="col-lg-10">
        <form  method="post" action="home.php" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-7">
              <div class="container mt-4 mb-3">
                <h3 class="text-secondary"><i class="fas fa-file-alt"></i>&nbsp&nbspNew Post</h3>
              </div>
              <div class="container">
                <div class="form-group">
                  <label for="title"><i class=" text-success fas fa-heading"></i> &nbsp&nbsp Title</label>
                  
                  <textarea required name ="title" class="form-control mb-2" rows="1" id="title"></textarea>
                  <span id="titlespan" class="text-danger"></span><br>
                  <label required for="body"><i class="text-success fas fa-align-left"></i>&nbsp&nbsp Body</label>
                  <textarea name="body" class="form-control mb-2" rows="12" id="body"></textarea>
                  <span id="bodyspan" class="text-danger"></span>
                </div>
                <div class="container mt-3">
                  <button id ="submitpostbtn" class="btn btn-success" type="submit" name="submitpostbtn"><i class="fas fa-paper-plane"></i>&nbsp&nbspSubmit Post</button>
                  <button id="cancelpostbtn" class="btn btn-danger ml-5" type="submit" name="cancelbutton"><i class="fas fa-window-close"></i>&nbsp&nbspCancel Post</button>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="container mt-5">
                <label class="mt-5" for="file"><i class=" text-success fas fa-upload"></i></i> &nbsp&nbsp Additional Post Image</label>
                <input id="imagefile" name = "image" type="file" accept="image" />
                <span id="filespan" class="text-danger"></span>
              </div>
              <div class="container mt-5">
                <label for="tags"><i class="text-success fas fa-tags"></i>&nbsp&nbspTags</label>
                <textarea name="tags" class="form-control mb-2" rows="1" id="tags" placeholder="user comma to separte tags"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container" id="homediv">
    <div class="row">
      <div class="col-lg-2">
     
      </div>
      <div class="col-lg-8">
        
        <div class="container" id="postdiv">        

        </div>

        <div class="container" id="searchdiv" style="display:none;">        

        </div>


      </div>
      <div class="col-lg-3">

      </div>
    </div>

  </div>


  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->
  <script type="text/javascript" src="js/home.js"></script>

</body>

</html>
