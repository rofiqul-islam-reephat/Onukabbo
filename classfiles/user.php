<?php

  class User{
    private $userid;
    public $firstname;
    public $lastname;
    public $email;
    public $dob;
    public $bio;

    function __construct($id,$first,$last,$email,$dob,$bio){
      $this->userid = $id;
      $this->firstname = $first;
      $this->lastname = $last;
      $this->email = $email;
      $this->dob = $dob;
      $this->bio=$bio;
    }


    function getDob(){
      return $this->dob;
    }

    function getId(){
      return $this->userid;
    }

  }

?>
