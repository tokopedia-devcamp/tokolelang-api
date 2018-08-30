<?php

class Logistic extends MasterApi {
  public function getLogistic(){
    $p = $this->dbh->query("SELECT * FROM logistics");
    $p->execute();
    $results = $p->fetchAll(PDO::FETCH_ASSOC);

    $show = [
      "code" => 200,
      "message" => "OK",
      "data" => []
    ];

    foreach($results as $result){
      $show['data'][] = [
        "id" => (int) $result['id'],
        "name" => $result['name'],
        "cost" => (float) $result['cost']
      ];
    }

    Flight::json([
      "code" => 200,
      "message" => "OK",
      "data" => $show
    ]);
  }
}