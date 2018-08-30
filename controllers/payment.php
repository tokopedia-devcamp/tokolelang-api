<?php

class Payment extends MasterApi {
  public function addPayment(){
    $reqs = array(
      "user_id" => (int) Flight::request()->data->user_id,
      "product_id" => (int) Flight::request()->data->product_id,
      "total" => (float) Flight::request()->data->total
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

    $p = $this->dbh->prepare("INSERT INTO payments (user_id, product_id, total, logistic_id) VALUES (:user_id, :product_id, :total, :logistic_id)");
    $p->bindParam(":user_id", $reqs['user_id']);
    $p->bindParam(":product_id", $reqs['product_id']);
    $p->bindParam(":total", $reqs['total']);

    $logistic = isset(Flight::request()->data->logistic_id) ? (int) Flight::request()->data->logistic_id : null;
    $p->bindParam(":logistic_id", $logistic);
    $p->execute();

    Flight::json([
      "code" => 200,
      "message" => "OK"
    ]);
  }
}