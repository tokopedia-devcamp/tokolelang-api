<?php

class MasterApi {
  protected $dbh = null;

  public function __construct(){
    try {
      $this->dbh = new PDO("mysql:host=".PROD_DB_HOST.";dbname=".PROD_DB_NAME, PROD_DB_USERNAME, PROD_DB_PASSWORD);
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
    $host  = 'localhost';
    $uname = 'root';
    $pass  = 'selabintana';

    $database= 'tokolelang';
    
    try {
      $this->dbh = new PDO("mysql:host=$host;dbname=$database", $uname, $pass);
      echo 'Terkoneksi dengan database';
    }
    catch(PDOException $e){
      Flight::json([
        "code" => 500,
        "message" => "Internal Server Error"
      ]);
    }
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