<?php

  session_start();

  include 'phpfunc/webfunctions.php';
  include 'phpfunc/dbfunctions.php';
  include 'phpfunc/querylist.php';
  include 'classfiles/user.php';

  if(!is_session_set()){
    redirect("index.php");
  }

  $email = $_SESSION['email'];

  $query = "SELECT * FROM user WHERE email='$email'";

  $result = execute_query_get_result($query);

  $user = null;

  if($result && $result->num_rows>0){
    $row = $result->fetch_assoc();
    $user = new User(0,$row['firstname'],$row['lastname'],$row['email'],$row['dob'],$row['about']);
  }

  if(isset($_POST['updatebtn'])){
      $firstname = clean_input($_POST['firstname']);
      $lastname = clean_input($_POST['lastname']);
      $about = clean_input($_POST['about']);
      
      $email = $_SESSION['email'];

      $query = "UPDATE user SET firstname='$firstname' ,lastname='$lastname',about='$about'
                WHERE email='$email'";

      execute_query($query);

  }

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width , initial-scale = 1.0">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
    
<div class="row">
    <div class="col-lg-2">
      <div class="row">
      <a href="home.php"><img src="img/logo.jpg" alt="Home" style="height:70px; width:190px; margin-left:20%;"></a>
      </div>
    </div>
    <div class="col-lg-2">

    </div>
    <div class="col-lg-4 text-success">
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
    <div class="col-lg-4">
      <div class="container mt-3">
      <button id = "updatebtn" class="btn btn-outline-success" name="button"> <i class="fas fa-user-edit"></i>&nbsp&nbsp Update Profile</button>
        <button id = "signoutbtn" name ="signoutbtn" type="submit" class="btn btn-outline-success" name="button"> <i class="fas fa-sign-out-alt"></i>&nbsp&nbsp SignOut</button>
      </div>
    </div>
  </div>

  <div class = "row">
    <div class = "col-lg-3">
        <div class= "container mt-4">
            <div class="card shadow-lg">
                <img class="card-img-top" src="img/kid.gif"  >
                <div class="card body">                        
                   <h3 class="mt-3 text-center text dark"><?php echo"$user->firstname  $user->lastname"?></h3>
                   <div class="text-center mt-3">
                        <label class="text-secondary" for="about">
                        <i class="fas fa-quote-left"></i>&nbsp&nbsp About &nbsp&nbsp
                        <i class="fas fa-quote-right"></i></label>
                        <div>
                          <p class="text-center">
                            <?php echo $user->bio ?>
                          </p>
                        </div>
                        <div>
                          <p class="text-secondary"></p>
                        </div>
                    </div>
                   <div class="text-center mt-3">
                        <label class="text-secondary" for="email">
                        <i class="fas fa-birthday-cake"></i>&nbsp&nbspBirthday: <?php echo $user->dob?></label>
                    </div>
                    <div class="text-center mt-3">
                        <label class="text-secondary" for="email">
                        <i class="fas fa-envelope-open-text"></i>&nbsp&nbspEmail: <?php echo $user->email?></label>
                    </div>            
               </div>
            </div>
        </div>
    </div> 
    <div class = "col-lg-7">
      <div class="container" id="updateprofilediv" style="display:none;">
        <h3 class=" text-center text-secondary mt-3 mb-3">Update Profile Information</h3>
        <form method="post" action="profile.php" id="updateform" class="w-75 ml-5">
               <div class="form-group">
                 <label for=""> <i class="text-success fas fa-user-alt"></i>&nbsp&nbsp First name</label>
                 <input required class="form-control" type="text" id="firstname" name="firstname" placeholder="Enter First Name"
                  value="<?php echo $user->firstname?>">
              </div>
               <div class="form-group">
                 <label for=""><i class="text-success  fas fa-user-alt"></i>&nbsp&nbsp Last name</label>
                 <input required class="form-control " type="text" id="lastname" name="lastname" placeholder="Enter Last Name"
                 value="<?php echo $user->lastname?>">
               </div>
               <div class="form-group">
                 <label><i class="text-success fas fa-info-circle"></i>&nbsp&nbsp About</label>
                 <input required class="form-control" type="text" id="about" name="about" placeholder="Enter About"
                 value="<?php echo $user->bio?>">
               </div>
           <button id ="updateinfobtn"  type="submit" class="btn btn-success" name="updatebtn">Update</button>
           <button id ="cancelbtn"  class="ml-5 btn btn-warning" name="registerbtn">Cancel</button>
         </form>
      </div>

      <div class="container" id="userposts"></div>

      </div>
    <div class = "col-lg-2">

    </div>

  </div>


  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->
  <script src="js/profile.js"></script>
</body>

</html>
