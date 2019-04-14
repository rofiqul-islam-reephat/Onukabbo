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
      <div class="container">
        <img src="img/logo.jpg" id="logo" alt="logo" style="height:70px; width:190px; margin-left:20%;">
      </div>
    </div>
    <div class="col-lg-6">
    </div>
    <div class="col-lg-4">
      <div class="container">
        <button id="registerbtn" class="ml-4 btn btn-outline-success mt-3">Become a Member</button>
          <button id="homebtn" class="ml-4 btn btn-outline-success mt-3">Home</button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-2">

    </div>
    <div class="col-lg-6">
      <div class="container ml-2">
        <div class="container mt-5">
          <h2 class=" text-secondary mt-5" style="font-family:monospace;">We believe in feeding minds, not mindless feeds</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4">

    </div>

  </div>


  <div class="row">
    <div class="col-lg-3">
      <div class="mt-5 container-fluid ">
        <div class="container mt-5">

        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="container mt-5">
        <h3 class=" mt-5 mb-4 text-dark" style="font-family:times">Sign In</h3>
        <form >
          <div class="form-group" >
            <input required type="email" id ="email" name = "email" class=" w-75 form-control" placeholder="Enter email">
          </div>
          <div class="form-group">
            <input required id="password" id = "password" name="password" type="password" class="form-control w-75" placeholder="Password">
            <span id = "warningspan" class="mt-5 text-danger"></span>
          </div>
          <span id = "warningspan" class="text-danger"></span>
          <button id = "signinbtn" name ="signinbtn" type="submit" class="btn btn-success">SignIn</button>
        </form>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="container">
        <div class="container mt-5">
          <img class="mt-4" src="img/2.jpg" style="width:90%; height:90%;" alt="">
        </div>
      </div>
    </div>

  </div>



  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->
  <script type="text/javascript" src="js/signin.js"></script>

</body>

</html>
