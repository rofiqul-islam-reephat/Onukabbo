<?php

session_start();

include 'phpfunc/webfunctions.php';

if(is_session_set()){
  redirect("home.php");
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
  <link rel="stylesheet" href="/css/index.css">
</head>

<body>

  <div class="row">
    <div class="col-lg-2">
      <div class="row">
        <img src="img/logo.jpg" alt="logo" style="height:70px; width:190px; margin-left:20%;">
      </div>
    </div>
    <div class="col-lg-3">
      <button class="ml-4 btn btn-outline-success mt-3" id="registerbtn">Become a Member</button>
      <button class="ml-4 btn btn-outline-success mt-3" id="signInbtn">Sign In</button>
    </div>
    <div class="col-lg-2 text-success">
      <form class="form-inline" method="POST">
        <div class="input-group mt-3">
          <input type="text" class="form-control" name="serachques" placeholder="Search Onukabbo">
          <div class="input-group-prepend">
            <button type="submit" name="searchbtn" class=" rounded-sm btn btn-outline-success"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-lg-5">
      <div class="nav">
        <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle" />
        <div class="menu">
          <a href="index.php">Home</a>
          <a href="#">Science</a>
          <a href="#">Culture</a>
          <a href="#">Phiosophy</a>
          <a href="#">Politics</a>
          <a href="#">Sports</a>
        </div>
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

  <script type="text/javascript" src="js/index.js"></script>
</body>

</html>
