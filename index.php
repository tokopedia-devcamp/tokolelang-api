<?php

require_once "flight/Flight.php";
require_once "./constants.php";

require_once "./controllers/api.php";
require_once "./controllers/home.php";
require_once "./controllers/product.php";

$master = new MasterApi();
$home = new Home();
$product = new Product();

Flight::route('GET /', [$home, 'getHome']);

Flight::route('GET /api', [$master, 'send404']);

// Product
Flight::route('GET /products', [$product, 'getProducts']);

Flight::start();