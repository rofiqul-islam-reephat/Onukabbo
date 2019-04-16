<?php

    
  class Comment{
    private $commentid;
    public $userid;
    public $postid;
    public $body;
    public $date;

    function __construct($commentid,$userid,$postid,$body,$date){
      $this->commentid = $commentid;
      $this->userid = $userid;
      $this->postid = $postid;
      $this->body = $body;
      $this->date =$date;
    }

    
  }






?>