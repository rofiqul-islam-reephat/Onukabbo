<?php
  
  session_start();

  include 'phpfunc/dbfunctions.php';
  include 'phpfunc/querylist.php';
  include 'phpfunc/webfunctions.php';
  include 'classfiles/user.php';
  
  if(is_session_set()){
    redirect("home.php");
  }


  $dbresult = create_db_if_not_found();
  $tableresult = create_table_if_not_found($usertable);

  if(!$dbresult){
    echo "database creation failed";
  }

  if(!$tableresult){
    echo "table creation failed";
  }


  $firstname = '';
  $lastname  = '';
  $email = '';
  $password = '';
  $repassword = '';
  $dob = '';

  $found_email = false;
  $isfieldempty = false;
  $passwordmatch = true;


  if(isset($_POST['registerbtn'])){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword  = $_POST['repassword'];
    $dob = $_POST['dob'];

    if(empty($firstname)){
      $isfieldempty = true;
    }
    if(empty($lastname)){
      $isfieldempty = true;
    }
    if(empty($email)){
      $isfieldempty = true;
    }

    if(empty($password)){
      $isfieldempty = true;
    }

    if(empty($repassword)){
      $isfieldempty = true;
    }

    if(empty($dob)){
      $isfieldempty = true;
    }


    if(!$isfieldempty){

      $firstname = clean_input($firstname);
      $lastname  = clean_input($lastname);
      $email = clean_input($email);
      $password = clean_input($password);
      $repassword = clean_input($repassword);
      $dob = clean_input($dob);

      if(strcmp($password,$repassword)==0){

         $hash = hash_with_salt($password); 

          $found_email = check_email($email);

          if(!$found_email){
                   
              $newuserquery = "INSERT INTO user(firstname,lastname,email,password,dob)
                VALUES('$firstname','$lastname','$email','$hash','$dob')";

              execute_query($newuserquery);

              $_SESSION['email'] = $email;

              redirect("home.php");

          }
         
      }
      else{
        $passwordmatch = false;
      }

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
      <div class="container">
        <img src="img/logo.jpg" id="logo" alt="logo" style="height:70px; width:190px; margin-left:20%;">
      </div>
    </div>
    <div class="col-lg-3">
    </div>
    <div class="col-lg-4 text-success">
    </div>
    <div class="col-lg-3">
      <div class="container">
        <button id="homebtn" class="ml-4 btn btn-outline-success mt-3">Home</button>
        <button id="signinbtn" class="ml-4 btn btn-outline-success mt-3">SignIn</button>
      </div>
    </div>
  </div>



  <div class="row"  id ="registerdiv" >
    <div class="col-lg-7" >
      <div class="container w-75">
        <div class="container ">
           <h3 class="text-secondary text-center mt-5 mb-5">Become a Member</h3>
        </div>
        <form method="post" id ="registerform">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for=""> <i class="text-success fas fa-user-alt"></i>&nbsp&nbsp First name</label>
                <input required class="form-control" type="text" id="firstname" name="firstname" placeholder="Enter First Name">
                
              </div>
              <div class="form-group">
                <label for=""><i class="text-success  fas fa-user-alt"></i>&nbsp&nbsp Last name</label>
                <input required class="form-control " type="text" id="lastname" name="lastname" placeholder="Enter Last Name">
              </div>
              <div class="form-group">
                <label><i class="text-success fas fa-envelope-open"></i>&nbsp&nbsp Email</label>
                <input required class="form-control" type="email" id="email" name="email" placeholder="Enter Email Address">
                <span id ="emailspan" class="text-danger"></span>
              </div>
              <div class="form-group">
                <label> <i class="text-success fas fa-lock"></i>&nbsp&nbspPassword</label>
                <input required class="form-control" type="password" id="password" name="password" placeholder="at least 6 characters long">
                <span class="text-danger mt-2" id="passwordspan"></span>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label><i class="text-success fas fa-lock"></i>&nbsp&nbsp Re-enter Password</label>
                <input required class="form-control" type="password" id="repassword" name="repassword" placeholder="Re-Enter Password">
                <span class="text-danger mt-2" id = "repasswordspan"></span>
              </div>
              <div class="form-group">
                <label><i class="text-success fas fa-birthday-cake"></i>&nbsp&nbspDate of Birth</label>
                <input required class="form-control" type="date" id="dob" name="dob">
                <span id="agespan" class="text-danger" ></span>
              </div>
            </div>
          </div>
          <button id ="registerbtn" type="submit" class="btn btn-success" name="registerbtn">Register</button>
        </form>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="container mt-5">
        <img src="img/1.jpg" style="width:90% ; height:90%" alt="">
      </div>
      <div class="container mt-5">
        <h3 class="mt-5 text-secondary text-center">Ideas and perspectives you won’t find anywhere else.</h3>
      </div>
    </div>
  </div>



  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->

  <script type="text/javascript" src="js/register.js"></script>

</body>

</html>
