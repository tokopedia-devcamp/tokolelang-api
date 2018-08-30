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
        u.email,
        u.avatar,
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
          "name" => $result['seller_name'],
          "email"=> $result['email'],
          "avatar" => $result['avatar']
        ],
        "created_at" => $result['created_at'],
        "updated_at" => $result['updated_at'],
        "total_bidder" => (int) $result['total_bidder']
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

    $allowed = array(
      'image/jpeg',
      'image/png'
    );

    $img_data = base64_decode($reqs['encoded_image']);
    $f = finfo_open();
    $mime_type = finfo_buffer($f, $img_data, FILEINFO_MIME_TYPE);

    if(!in_array($mime_type, $allowed)){
      $this->send404();
      return;
    }

    $rand_generated = $this->generateAddress();

    $image_url = WEB_URL .'uploads/p/'. $rand_generated;
    $image_url = $mime_type == 'image/jpeg' ? $image_url.'.jpg' : $image_url.'.png';
    
    $upload_url = './uploads/p/'. $rand_generated;
    $upload_url = $mime_type == 'image/jpeg' ? $upload_url.'.jpg' : $upload_url.'.png';

    file_put_contents($upload_url, $img_data);

    $p = $this->dbh->prepare("INSERT INTO products (imageurl, name, product_condition, min_price, next_bid, expired, product_category, user_id) VALUES ('$image_url', :name, :product_condition, :min_price, :next_bid, :expired, :product_category, :user_id)");
    // :name, :product_condition, :min_price, :next_bid, :expired, :product_category, :user_id
    $p->bindParam(":name", $reqs['name']);
    $p->bindParam(":product_condition", $reqs['product_condition']);
    $p->bindParam(":min_price", $reqs['min_price']);
    $p->bindParam(":next_bid", $reqs['next_bid']);
    $p->bindParam(":expired", $reqs['expired']);
    $p->bindParam(":product_category", $reqs['product_category']);
    $p->bindParam(":user_id", $reqs['user_id']);
    $p->execute();

    Flight::json([
      "code" => 200,
      "message" => "OK",
      "data" => [
        "image_url" => $image_url
      ]
    ]);
  }
}