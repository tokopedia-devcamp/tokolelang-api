<?php

class Product extends MasterApi {
  public function getProducts(){
    $show = array(
      "code" => 200,
      "message" => "OK",
      "data" => []
    );

    $q = "
      SELECT p.id AS product_id,
        p.imageurl,
        p.name,
        p.product_condition,
        p.min_price,
        p.next_bid,
        p.expired,
        p.product_category,
        c.name AS category,
        p.user_id AS seller_id,
        u.name AS seller_name,
        p.created_at,
        p.updated_at,
        (
          SELECT COUNT(DISTINCT(user_id))
          FROM transaction_bid
          WHERE product_id = p.id
        ) AS total_bidder
      FROM products p
      INNER JOIN users u
        ON p.user_id = u.id
      INNER JOIN product_category c
        ON p.product_category = c.id
      ORDER BY created_at DESC
    ";

    $p = $this->dbh->query($q);
    $p->execute();
    $results = $p->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result){
      $show["data"][] = [
        "product_id" => (int) $result['product_id'],
        "imageurl" => $result['imageurl'],
        "name"     => $result['name'],
        "next_bid" => (int) $result['next_bid'],
        "product_condition" => (int) $result['product_condition'],
        "min_price" => (int) $result['min_price'],
        "next_bid"  => (int) $result['next_bid'],
        "expired"   => $result['expired'],
        "category"  => [
          "id"   => (int) $result['product_category'],
          "name" => $result['category']
        ],
        "seller" => [
          "id" => (int) $result['seller_id'],
          "name" => $result['seller_name']
        ],
        "created_at" => $result['created_at'],
        "updated_at" => $result['updated_at'],
        "total_bidder" => $result['total_bidder']
      ];
    }
    
    Flight::json($show);
  }

  public function addProduct(){
    $reqs = [
      "name" => Flight::request()->data->name,
      "product_condition" => (int) Flight::request()->data->product_condition,
      "min_price" => (float) Flight::request()->data->min_price,
      "next_bid" => (float) Flight::request()->data->next_bid,
      "expired" => Flight::request()->data->expired,
      "product_category" => (int) Flight::request()->data->product_category,
      "user_id" => (int) Flight::request()->data->user_id,
      "encoded_image" => Flight::request()->data->encoded_image
    ];

    foreach($reqs as $data){
      if(!isset($data)){
        $this->send400();
        return;
      }
    }

    // to do
    // $p = $this->dbh->prepare("INSERT INTO products (imageurl, name, product_condition, min_price, next_bid, expired, product_category, user_id) VALUES ('$image_url', :name, :product_condition, :min_price, :next_bid, :expired, :product_category, :user_id)");
    // $p->bindParam(":nim",$nim);
    // $p->bindParam(":nama",$nama);
    // $p->bindParam(":jeniskelamin",$jenisKelamin);
    // $p->execute();

    Flight::json([
      "code" => 200,
      "message" => "OK"
    ]);
  }
}