<?php

require_once "flight/Flight.php";
require_once "./controllers/api.php";
require_once "./controllers/home.php";

$master = new MasterApi();
$home = new Home();

Flight::route('GET /', [$home, 'getHome']);

Flight::route('GET /api', [$master, 'send404']);

Flight::start();