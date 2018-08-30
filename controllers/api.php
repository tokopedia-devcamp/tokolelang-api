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
      die();
    }
  }

  public function __destruct(){
    // close connection
    $this->dbh = null;
  }

  protected function generateAddress(){
    $a = "";
    $n = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    for($i=0;$i<10;$i++){
      $a .= $n[rand(0, strlen($n) - 1)];
    }

    return 'tokolelang-'.$a;
  }

  public function send404($message = "Not Found"){
    Flight::json([
      "code" => 404,
      "message" => $message
    ]);
  }

  public function send400($message = "Bad Request"){
    Flight::json([
      "code" => 400,
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