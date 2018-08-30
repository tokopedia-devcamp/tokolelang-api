<?php

require_once "flight/Flight.php";
require_once "./controllers/api.php";
require_once "./controllers/home.php";
require_once "./controllers/transaction_bid.php";

$master = new MasterApi();
$home = new Home();
$trans = new Transaction();

Flight::route('GET /', [$home, 'getHome']);

Flight::route('GET /api', [$master, 'send404']);

Flight::route('GET /api/gettransbyid/@id', [$trans, 'getByProductId']);

Flight::start();