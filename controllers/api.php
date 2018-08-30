<?php

class MasterApi {
  protected $dbh = null;

  public function __construct(){
    $host  = 'localhost';
    $uname = 'root';
    $pass  = '';

    $database= 'tokolelang';
    
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$database", $uname, $pass);
    }
    catch(PDOException $e){
      Flight::json([
        "code" => 500,
        "message" => "Internal Server Error"
      ]);
    }
  }

  public function __destruct(){
    // close connection
    $this->dbh = null;
  }

  public function send404($message = "Not Found"){
    Flight::json([
      "code" => 404,
      "message" => $message
    ]);
  }

  // Check whether database connection
  // is established or not
  public function isConnected(){
    if($this->dbh)return true;
    return false;
  }
}