<?php

  class Post{
    private $postid;
    public $title;
    public $body;
    private $tags;
    public $thumbnail;
    public $postdate;

    function __construct($id,$title,$body,$tags,$thumbnail,$postdate){
      $this->postid = $id;
      $this->title = $title;
      $this->body = $body;
      $this->tags = $tags;
      $this->thumbnail = $thumbnail;
      $this->postdate =$postdate;
    }

    function getId(){
      return $this->postid;
    }

  }

  $object = new Post("234","hello","world","eg,dsg,sdg","dsgdsgdsgdsg","112/324/20325");

  echo $object.getId();

?>
