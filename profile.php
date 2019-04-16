<?php

  session_start();

  include 'phpfunc/webfunctions.php';
  include 'phpfunc/dbfunctions.php';
  include 'phpfunc/querylist.php';

  if(!is_session_set()){
    redirect("index.php");
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





  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->
</body>

</html>
