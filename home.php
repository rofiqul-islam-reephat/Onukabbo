<?php

  session_start();

  include 'phpfunc/webfunctions.php';

  if(!is_session_set()){
    redirect("index.php");
  }

  if(isset($_POST['q'])){
    $command = $_POST['q'];
    if(strcmp($command,"signout")==0){
      session_destroy();
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
        <form action="classfiles/post.php" class="form-inline" method="POST">
          <div class="input-group mt-3">
            <input type="text" class="form-control" name="serachques" placeholder="Search Onukabbo">
            <div class="input-group-prepend">
              <button type="submit" name="searchbtn" class=" rounded-sm btn btn-outline-success"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
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
        <form class="" action="home.php" method="post">
          <div class="row">
            <div class="col-lg-7">
              <div class="container mt-4 mb-3">
                <h3 class="text-secondary"><i class="fas fa-file-alt"></i>&nbsp&nbspNew Post</h3>
              </div>
              <div class="container">
                <div class="form-group">
                  <label for="comment"><i class=" text-success fas fa-heading"></i> &nbsp&nbsp Title</label>
                  <textarea class="form-control mb-2" rows="1" id="comment"></textarea>
                  <label for="comment"><i class="text-success fas fa-align-left"></i>&nbsp&nbsp Body</label>
                  <textarea class="form-control mb-2" rows="12" id="comment"></textarea>
                </div>
                <div class="container mt-3">
                  <button class="btn btn-success" type="submit" name="button"><i class="fas fa-paper-plane"></i>&nbsp&nbspSubmit Post</button>
                  <button id="cancelpostbtn" class="btn btn-danger ml-5" type="submit" name="button"><i class="fas fa-window-close"></i>&nbsp&nbspCancel Post</button>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="container mt-5">
                <label class="mt-5" for="comment"><i class=" text-success fas fa-upload"></i></i> &nbsp&nbsp Upload Post Image</label>
                <input type="file" accept="image" />
              </div>
              <div class="container mt-5">
                <label for="comment"><i class="text-success fas fa-tags"></i>&nbsp&nbspTags</label>
                <textarea class="form-control mb-2" rows="1" id="comment"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container" id="homepostdiv">
    <div class="row">
      <div class="col-lg-2">

      </div>
      <div class="col-lg-6">

      </div>
      <div class="col-lg-4">

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
