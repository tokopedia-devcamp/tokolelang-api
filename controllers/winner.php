<?php

class Winner extends MasterApi {
  public function addWinner(){
    $reqs = array(
      "user_id" => (int) Flight::request()->data->user_id,
      "product_id" => (int) Flight::request()->data->product_id,
      "message" => Flight::request()->data->message,
      "price" => (float) Flight::request()->data->price,
    );

    foreach($reqs as $check){
      if(!isset($check)){
        $this->send400();
        return;
      }
    }

    $check = $this->dbh->prepare("SELECT * FROM users WHERE id = :user_id");
    $check->bindParam(":user_id", $reqs['user_id']);
    $check->execute();

    if($check->rowCount() == 0){
      $this->send400("User Not Found");
      return;
    }

    $p = $this->dbh->prepare("INSERT INTO winner_bid (user_id, product_id, message, price) VALUES (:user_id, :product_id, :message, :price)");
    $p->bindParam(":user_id", $reqs['user_id']);
    $p->bindParam(":product_id", $reqs['product_id']);
    $p->bindParam(":message", $reqs['message']);
    $p->bindParam(":price", $reqs['price']);
    $p->execute();

    Flight::json([
      "code" => 200,
      "message" => "OK"
    ]);
  }
}