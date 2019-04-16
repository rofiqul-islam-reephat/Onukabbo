<?php

session_start();

include 'phpfunc/dbfunctions.php';
include 'phpfunc/actionfunctions.php';
include 'phpfunc/webfunctions.php';

$chcekemail = "checkemail";
$register= "register";
$signin = "signin";
$loadposts = "loadposts";

if(isset($_POST['q'])){

    $req = $_POST['q'];

    if(strcmp($req,$chcekemail)==0){
        
        $email = trim($_POST['email']);
        
        $result = check_email($email);
    
        if($result==true){
            echo 'true';
        }
        else
            echo 'false';

    }
    else if(strcmp($req,$signin)==0){

        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $flag = is_valid_user($email,$password);
        
        if($flag){
            echo "valid";
            $_SESSION['email'] = $email;
        }
        else if(!$flag){
            echo "invalid";
        }
    }
    else if(strcmp($req,$loadposts)==0){

        $query = "SELECT * FROM post ORDER BY postid DESC";

        $result = execute_query_get_result($query);
       
        if(!$result){
            echo "<h3 class =\" text-center text-secondary mt-5\">So Emptiness ..<h3>";
        }
        else if($result->num_rows>0){
            echo "
                <div class=\"container mt-4 mb-5\">
                    <h3 class=\"text-secondary text-center\">
                    <i class=\"fas fa-file-alt\"></i>&nbsp&nbspRecent Posts</h3>        
                </div>
                ";
            while($row = $result->fetch_assoc()){

                $title = $row['title'];
                $body = $row['body'];
                $date = $row['postdate'];
                $thumbnail = $row['imagepath'];
                $userid = $row['userid'];
                $postid = $row['postid'];
                
                $query = "SELECT lastname FROM user WHERE userid ='$userid'";
                
                $userres = execute_query_get_result($query);

                $author = '';

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
                <div class=\"card shadow mt-2\" id=\"$postid\">
                    <div class = \"row\">
                      <div class=\"col-lg-3\">
                        <div class=\"container\">
                            <img class=\"mt-3\" src=\"$thumbnail\" style=\"width : 150px ; height : 100px;\">
                        </div>
                      </div>
                      <div class=\"col-lg-8\">
                        <div class=\"container mt-2\">
                            <h5 class=\" card-title text-dark\">$title</h5>
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

}


?>

