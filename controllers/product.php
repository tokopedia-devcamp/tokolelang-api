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
        c.name AS category,
        p.user_id AS seller_id,
        u.name AS seller_name,
        p.created_at,
        p.updated_at
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
      $show["data"][] = $result;
    }
    
    Flight::json($show);
  }
}