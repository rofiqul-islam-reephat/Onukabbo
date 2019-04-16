<?php


function hash_with_salt($password){

   $password = password_hash($password, PASSWORD_BCRYPT);

   return $password;
}


function verify_password($password,$hash){
   $password = SLAT.$password;
   $flag = false;
   if(password_verify($password,$hash))
      $flag = true;
   return $flag;
}


   function redirect($url, $statusCode = 303){
      header('Location: ' . $url, true, $statusCode);
      die();
   }

   function clean_input($data){

      $SERVERNAME = "localhost";
      $USERNAME = "root";
      $PASSWORD = "";
      $DBNAME = "onukabbo";
      $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD ,DBNAME);  

      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);

      $data = mysqli_real_escape_string($connection,$data);

      $connection->close();
   
      return $data;
   
   }

   function is_session_set(){
      
      $set = false;
      if(isset($_SESSION['email']))
         $set = true;
   
      return $set;
   }


?>