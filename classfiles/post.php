<?php

  class Post{
    private $postid;
    public $author;
    public $title;
    public $body;
    public $thumbnail;
    public $postdate;

    function __construct($id,$author,$title,$body,$thumbnail,$postdate){
      $this->postid = $id;
      $this->title = $title;
      $this->body = $body;
      $this->thumbnail = $thumbnail;
      $this->postdate =$postdate;
      $this->author = $author;
    }

    function getId(){
      return $this->postid;
    }

  }

?>
