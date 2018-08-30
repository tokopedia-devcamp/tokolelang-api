<?php

class Home extends MasterApi {
  public function getHome(){
    $show = array(
      'code' => 200,
      'message'=> 'OK'
    );
    
    Flight::json($show);
  }
}