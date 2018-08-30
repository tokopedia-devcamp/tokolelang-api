<?php

class MasterApi {
  public function __construct(){
    // $host  = 'localhost';
    // $uname = 'root';
    // $pass  = '';

    // $database= 'tokolelang';
    
    // try {
    //   $dbh = new PDO("mysql:host=$host;dbname=$database", $uname, $pass);
    //   echo 'Terkoneksi dengan database';
    // }
    // catch(PDOException $e){
    //   Flight::json([
    //     "code" => 500,
    //     "message" => "Internal Server Error"
    //   ]);
    // }
  }

  public function send404(){
    Flight::json([
      "code" => 404,
      "message" => "Not Found"
    ]);
  }
}