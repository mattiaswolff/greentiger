<?php

class Definition {

  //Properties
  private $name;
  private $description;
  private $content;
  
  //Constructor
  public function __construct(){  
    $this->name = '';  
    $this->description = '';  
    $this->content = array();    
    }
    
  //Accessors
  public function getName() {
    return $this->name;
    }
  public function setName($name) {
    $this->name = $name;
    }
  public function getDescription() {
    return $this->description;
    }
  public function setDescription($description) {
    $this->description = $description;
    }
  public function getContent() {
    return $this->name;
    }
  public function setContent($content) {
    $this->content = $content;
    }
}
?>