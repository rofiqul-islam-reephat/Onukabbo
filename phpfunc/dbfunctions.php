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
            echo $connection->error;
            echo $query;
           
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

        $id = $connection->insert_id;
        
        $connection->close();

        return $id;
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

    function get_user_id($email){

        $result = get_user_info($email);
       
        $userid = "";

        if($result->num_rows>0){
            
           $row = $result->fetch_assoc();

           $userid = $row['userid'];
             
               
        }
        else
            echo "user not found";
       
        return $userid;

    }



    function insert_tag_if_new($tag){

        $tag = strtolower($tag);

        $query = "SELECT * FROM catagory WHERE cname='$tag'";

        $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD , DBNAME);

        if($connection->connect_error){
            echo $connection->connect_error;
        }

        $result = $connection->query($query);

      
        if($result->num_rows==0){
            
           $insertquery = "INSERT INTO catagory(cname) VALUES ('$tag')";

           $connection->query($insertquery);
                
         }
      
        $connection->close();


    }

    function get_tag_id($tag){

        $tag = strtolower($tag);

        $query = "SELECT cid FROM catagory WHERE cname='$tag'";

        $connection = new mysqli(SERVERNAME , USERNAME , PASSWORD , DBNAME);

        if($connection->connect_error){
            echo $connection->connect_error;
        }

        $result = $connection->query($query);

        $tagid = -1;

      
        if($result->num_rows>0){
            
           $row = $result->fetch_assoc();

           $tagid = $row['cid'];
                
         }
      
        $connection->close();

        return $tagid;

    }

    function glue_post_tag($postid,$tagarray){

        $connection =  new mysqli(SERVERNAME, USERNAME, PASSWORD,DBNAME);

	    if($connection->connect_error){
           echo $connection->connect_error;
	    }

        foreach($tagarray as $tag){
            $tagid = get_tag_id($tag);
            $query = "INSERT INTO posttag(pid,cid) VALUES ('$postid','$tagid')";
            $connection->query($query);
        }

	    $connection->close();   

    }
    
?>