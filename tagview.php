<?php 


session_start();

include 'phpfunc/dbfunctions.php';
include 'phpfunc/actionfunctions.php';
include 'phpfunc/webfunctions.php';
include 'phpfunc/filterkeyword.php';



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


<div class="container" id="homediv">

    <div class="row">
      <div class="col-lg-3">
     
           
      </div>
      <div class="col-lg-8">
        
        <div class="container" id="postdiv">   
            <?php

                $tagid = $_GET['tag'];;
                                         
                $query = "SELECT pid FROM posttag WHERE cid='$tagid'";

                $result = execute_query_get_result($query);

                if($result && $result->num_rows){

                    while($row2 = $result->fetch_assoc()){

                        $pid = $row2['pid'];
                        $tmpquery = "SELECT * FROM post WHERE postid ='$pid'";
                        $tmpres2 = execute_query_get_result( $tmpquery);
                        
                        if($tmpres2 && $tmpres2->num_rows>0){

                            $row = $tmpres2->fetch_assoc();

                            $title = $row['title'];
                            $body = $row['body'];
                            $date = $row['postdate'];
                            $thumbnail = $row['imagepath'];
                            $userid = $row['userid'];
                            $postid = $row['postid'];
                            $query = "SELECT lastname FROM user WHERE userid ='$userid'";
            
                            $userres = execute_query_get_result($query);

                            $author = '';
                            $authorid = '';

                            if($userres->num_rows>0){
                               $tmpres = $userres->fetch_assoc();
                                $author = $tmpres['lastname'];                
                            }

                             //$tmpbody = "";
                            $len = strlen($body);

                              if($len>50){
            
                                  $body =substr ($body,0,150);
                            }

        
                         if(strcmp($thumbnail,"")==0)
                                 $thumbnail.="img/noimg.png";

            echo"
            <div class=\"card shadow mt-2\">
                <div class = \"row\">
                  <div class=\"col-lg-3\">
                    <div class=\"container\">
                        <img class=\"mt-3\" src=\"$thumbnail\" style=\"width : 150px ; height : 100px;\">
                    </div>
                  </div>
                  <div class=\"col-lg-8\">
                    <div class=\"container mt-2\">
                        <a href=\"postview.php?id=$postid\"<h4 class=\" text-dark\">$title</h4></a>
                        <p class=\" mt-3 mb-3 text-secondary card-text\">$body</p>
                    </div>
                    <div class=\"row\">
                      <div class=\"col-lg-6\">
                        <div class=\"container\">
                            <label for=\"author\">Posted by : $author</label>
                        </div>
                      </div>
                      <div class=\"col-lg-6\">
                          <div class=\"container\">
                          <label for=\"date\">Posted at : $date</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=\"col-lg-1\">
                  <a href=\"\"><i class=\"text-success far fa-bookmark\"></i></a>
                </div>
            </div>
        </div>
        
        ";  


                        }

                        
                    }
                }

                
            ?>
        </div>

      </div>
      <div class="col-lg-1">

      </div>
    </div>

  </div>





  <!--Bootstrap Scripts Begin-->
  <script src="bootstrap/jquery-3.3.1.slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/popper.min.js"></script>
  <!--Bootstrap scripts ends -->
  <script src="js/tagview.js"></script>

</body>

</html>
