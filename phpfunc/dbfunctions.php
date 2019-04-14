<?php

    const SERVERNAME = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DBNAME = "onukabbo";

    function create_db_if_not_found(){

        $status = true;

        $query = "CREATE DATABASE IF NOT EXISTS ".DBNAME;

        $connection = new mysqli(SERVERNAME,USERNAME,PASSWORD);

        if($connection->connect_error){
            $status = false;
        }

        if($connection->query($query)==FALSE){
            $status = false;
        }

        $connection->close();

        return $status;
            
    }

    function create_table_if_not_found($tabledes){
        
        $query = "CREATE TABLE IF NOT EXISTS ".$tabledes;

        $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD ,DBNAME);

        $status = true;

        if($connection->connect_error){
            $status = false;

        }

        if($connection->query($query)==FALSE){
            $status = false;
           
        }

        $connection->close();

        return $status;
        
    }

    function execute_query($query){

        $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD , DBNAME);

        if($connection->connect_error){
            echo $connection->connect_error;
        }

        if($connection->query($query)==FALSE){
            echo $connection->error;
        }
        
        $connection->close();
    }

    function check_email($email){

        $connection =  new mysqli(SERVERNAME, USERNAME, PASSWORD,DBNAME);

        $query = "SELECT * FROM user WHERE email='$email'";
        $found = false;

	    if($connection->connect_error){
           echo $connection->connect_error;
	    }

        $result = $connection->query($query);
        
        if($result->num_rows>0){
            $found = true;
        }	    

	    $connection->close();

        return $found;       
    }

    function get_user_info($email){

        $query = "SELECT * FROM user WHERE email='$email'";;

        $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD , DBNAME);

        if($connection->connect_error){
            echo $connection->connect_error;
        }

        $result = $connection->query($query);  

      
        $connection->close();

        return $result;

    }

    function is_valid_user($email,$password){
               
        $result = get_user_info($email);
       
        $flag = false;

        if($result->num_rows>0){
            
           $row = $result->fetch_assoc();
           $hash = $row['password'];
             
           if(password_verify($password,$hash)){
                $flag = true;
           }    
                      
        }
        else{
            $flag = false;
        }
    
        return $flag;

    }
    
?>