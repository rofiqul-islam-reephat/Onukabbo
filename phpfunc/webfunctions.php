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

      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars($data);
   
      return $data;
   
   }

   function is_session_set(){
      
      $set = false;
      if(isset($_SESSION['email']))
         $set = true;
   
      return $set;
   }


?>