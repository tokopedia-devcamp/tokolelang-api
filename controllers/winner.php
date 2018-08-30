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

    $p2 = $this->dbh->prepare("UPDATE products SET status = 1 WHERE id = :product_id");
    $p2->bindParam(":product_id", $reqs['product_id']);
    $p2->execute();

    Flight::json([
      "code" => 200,
      "message" => "OK"
    ]);
  }

  public function getWinnerByUserId($user_id){
    $p = $this->dbh->prepare("SELECT * FROM winner_bid WHERE user_id = :user_id");
    $p->bindParam(":user_id", $user_id);
    $p->execute();

    $show = [
      "code" => 200,
      "message" => "OK",
      "user_id" => $user_id,
      "data" => []
    ];

    $results = $p->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result){
      $show['data'][] = [
        "id" => $result['id'],
        "product" => [
          "id" => $result['product_id']
        ],
        "message" => $result['message'],
        "price"   => $result['price'],
        "created_at" => $result['created_at']
      ];
    }

    Flight::json($show);
  }
}