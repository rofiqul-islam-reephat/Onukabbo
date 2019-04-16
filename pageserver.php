<?php

session_start();

include 'phpfunc/dbfunctions.php';
include 'phpfunc/actionfunctions.php';
include 'phpfunc/webfunctions.php';
include 'phpfunc/filterkeyword.php';

$chcekemail = "checkemail";
$register= "register";
$signin = "signin";
$loadposts = "loadposts";
$loaduserpost = "loaduserposts";
$signout = "signout";
$search = "search";
$trending = "loadtrending";

function render_posts($result,$command){

    $msg = '';

    if($result && $result->num_rows>0){
    
        if(strcmp($command,"search")==0){
             $msg.= "Found these Resutls"; 
        }
        else if(strcmp($command,"loadposts")==0){
            $msg.= "Recent Posts";
        }
         else if(strcmp($command,"loaduserposts")==0){
            $msg.= "Your Posts";
         }

        echo "
            <div class=\"container mt-4 mb-5\">
                <h3 class=\"text-secondary text-center\">
                <i class=\"fas fa-file-alt\"></i>&nbsp&nbsp$msg</h3>        
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
    else{

        if(strcmp($command,"search")==0)
            $msg.= "No Result Found";
        else if(strcmp($command,"loadposts")==0)
            $msg.= "So Emptiness ";
        else if(strcmp($command,"loaduserposts")==0)
             $msg.= "You haven't Posted anything Yet";

        echo "<h3 class =\" text-center text-secondary mt-5\">$msg..<h3>";
    }

}

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
    else if(strcmp($req,$signout)==0){ 
          session_destroy();
    }
    else if(strcmp($req,$trending)==0){
            
        

    }
    else if(strcmp($req,$loadposts)==0 || strcmp($req,$loaduserpost)==0 || strcmp($req,$search)==0){

       // echo "yes";

        $query = null;
        $email = null;
        $userid = null;

        if(isset($_SESSION['email'])){
            $email = $_SESSION['email'];
            $userid = get_user_id($email);
        }
       

        if(strcmp($req,$loadposts)==0 ){
            $query = "SELECT * FROM post ORDER BY postid DESC";
            $result = execute_query_get_result($query);
       
            render_posts($result,$loadposts);
        }
        else if(strcmp($req,$loaduserpost)==0){
            $query = "SELECT * FROM post WHERE userid='$userid' ORDER BY postid DESC";

             $result = execute_query_get_result($query);
       
            render_posts($result,$loaduserpost);
        }
        else if(strcmp($req,$search)==0){

           
            $string = $_POST['keystring'];

            $string = clean_input($string);

            $tmp = explode(" ",$string);

            $keywords = array_diff($tmp,$skipword);


            foreach($keywords as $key){

                $query = "SELECT * FROM post WHERE UPPER(title) LIKE  UPPER('%$key%')";

                $result = execute_query_get_result($query);

                render_posts($result,$search);
            }
        }
    }
}     
 


?>

