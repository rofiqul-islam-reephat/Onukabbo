<?php

  session_start();

  include 'phpfunc/dbfunctions.php';
  include 'classfiles/post.php';
  include 'classfiles/comment.php';
  include 'phpfunc/querylist.php';

  $post = null;
  $comments = null;

  if(isset($_GET['id'])){

    $pid = $_GET['id'];
    $query = "SELECT * FROM post WHERE postid='$pid'";

    $result = execute_query_get_result($query);


    if($result && $result->num_rows>0){

       $row = $result->fetch_assoc();

       $userid = $row['userid'];

       $userresult2 = get_user_name($userid);

       $author='';

       if($userresult2 && $userresult2->num_rows>0){

          $userrow = $userresult2->fetch_assoc();
          $author.=$userrow['firstname']." ".$userrow['lastname'];

       }

      $post = new Post($pid,$author,$row['title'],$row['body'],$row['imagepath'],$row['postdate']);

    }



  }

  if(isset($_POST['commentbtn'])){

    $commentbody = $_POST['commentbody'];
    $date =  date("Y/m/d");
    $userid = get_user_id($_SESSION['email']);
    $postid = $_GET['id'];

    create_db_if_not_found();
    create_table_if_not_found($commenttable);

    if(!empty($commentbody)){

      $query = "INSERT INTO comments(body,commentdate,uid,pid)
                VALUES ('$commentbody','$date','$userid','$postid')";

      execute_query($query);

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
        <a href="home.php"><img src="img/logo.jpg" alt="logo" style="height:70px; width:190px; margin-left:20%;"></a>
      </div>
    </div>
    <div class="col-lg-2">
    </div>
    <div class="col-lg-5 text-success">
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
</div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-7">
        <div class="container mt-5">
            <h3 class="text-secondary mt-5"><?php echo $post->title ?></h3>
        </div>

        <div class = "container">
            <div class="row">
              <div class="col-lg-6">

              </div>

              <div class="col-lg-4">
                <label for="author"><i class="fas fa-pen"></i>&nbsp
                  Posted By: <a href=""><?php echo $post->author ?></a>
                  <br><br>
                 <i class="fas fa-calendar-week"></i>&nbsp&nbsp Post Date : <?php echo $post->postdate ?>
                </label>
              </div>
            </div>
        </div>

        <div class="container">
          <img src=" <?php
           echo $post->thumbnail ?> "  style="width:500px ; height:300px;" alt="">
        </div>

        <div class="container mt-5" >
          <p align="justify" class="text-dark" style="font-family:monospace;"> <?php
                  echo $post->body;

          ?> </p>
        </div>


        <div class="container mt-5">

          <h3 class="text-secondary"><i class="text-success fas fa-comment"></i>&nbsp&nbsp Comments</h3>

          <?php

          if(isset($_SESSION['email'])){
          
            $commentquery = "SELECT * FROM comments WHERE  pid='$pid'";

            $commentresult = execute_query_get_result($commentquery);
      
             if($commentresult && $commentresult->num_rows>0){
                
                while($commentrow = $commentresult->fetch_assoc()){


                    $tmpcomment = new Comment($commentrow['commentid'],$commentrow['uid'],$commentrow['pid'],
                                       $commentrow['body'],$commentrow['commentdate']);


                    $commentarres = get_user_name($tmpcomment->userid);

                    $commentarname = '';

                    if($commentarres && $commentarres->num_rows>0){

                      $tmprow = $commentarres->fetch_assoc();

                      $commentarname.=$tmprow['firstname']." ".$tmprow['lastname'];

                    }

                    echo "
                    <div class=\"card\">
                    <div class=\"card-body\">
                      <p class=\"text-dark\">
                        $tmpcomment->body
                      </p>
                    </div>
                    <div class=\"container\">
                      <div class=\"row\">
                        <div class=\"col-lg-6\">
                        <label for=\"username\">By :
                          $commentarname;
                        </label>
                        </div>
                        <div class=\"col-lg-6\">
                        <label for=\"Postdate\">At :
                          $tmpcomment->date;
                        </label>
                        </div>
                      </div>
                    </div>
                  </div>  
                  ";

                

                }              

            }
          }
          ?>
        </div>

        <div class="container mt-5">
          <?php

            if(isset($_SESSION['email'])){

              

              echo " <form action=\"\" method=\"post\">
                      <div class=\"form-group\">
                        <label><i class=\"text-success fas fa-comment\"></i>&nbsp&nbsp Comment</label>
                        <textarea id=\"commentbody\" name=\"commentbody\" class=\"form-control mb-2\" rows=\"4\" id=\"body\"></textarea>
                         <span class=\"text-danger mt-2\" id = \"commentspan\"></span>
                      </div>
                   <button id=\"commentbtn\" name =\"commentbtn\" type=\"submit\" class=\"btn btn-success\">
                     <i class=\"fab fa-telegram-plane\"></i>&nbsp&nbspComment</button>
                   </form>";
              
            }    
                    
          ?>
        </div>

    </div>
    <div class="col-lg-2">

    </div>

  </div>





  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->

  <script src="js/postview.js"></script>
</body>

</html>
