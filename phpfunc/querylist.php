<?php


    $usertable = "user(
        userid INT AUTO_INCREMENT PRIMARY KEY ,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        dob DATE NOT NULL,
        about TEXT
        );
    ";

    $posttable = "post( postid INT AUTO_INCREMENT PRIMARY KEY,
                  userid INT NOT NULL,
                  title TEXT NOT NULL, 
                  body TEXT NOT NULL,
                  postdate DATE NOT NULL,
                  imagepath VARCHAR(255),
                  FOREIGN KEY (userid) REFERENCES user(userid))";
    
    $catagory = "catagory (cid INT AUTO_INCREMENT PRIMARY KEY,
                            cname VARCHAR(255) NOT NULL)";

    $posttag = "posttag(pid INT NOT NULL,
                        cid INT NOT NULL,
                        PRIMARY KEY(pid,cid))";




?>