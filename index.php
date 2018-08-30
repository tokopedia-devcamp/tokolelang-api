<?php

require_once "flight/Flight.php";
require_once "./controllers/api.php";
require_once "./controllers/home.php";

$home = new Home();

Flight::route('GET /', [$home, 'getHome']);

Flight::start();