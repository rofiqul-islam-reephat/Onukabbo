<?php

session_start();

include 'phpfunc/dbfunctions.php';
include 'phpfunc/actionfunctions.php';
include 'phpfunc/webfunctions.php';

$chcekemail = "checkemail";
$register= "register";
$signin = "signin";

if(isset($_POST['q'])){

    $req = $_POST['q'];

    if(strcmp($req,$chcekemail)==0){
        
        $email = $_POST['email'];
        
        $result = check_email($email);
    
        if($result==true){
            echo 'true';
        }
        else
            echo 'false';

    }
    else if(strcmp($req,$signin)==0){

        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $flag = is_valid_user($email,$password);
        
        if($flag){
            echo "valid";
            $_SESSION['email'] = $email;
        }
        else if(!$flag){
            echo "invalid";
        }
    }

}


?>

