<?php

require_once "flight/Flight.php";
require_once "./controllers/api.php";
require_once "./controllers/user.php";
require_once "./controllers/home.php";
require_once "./controllers/transaction_bid.php";

$master = new MasterApi();
$users = new User();
$home = new Home();
$trans = new Transaction();

Flight::route('GET /', [$home, 'getHome']);

Flight::route('GET /api', [$master, 'send404']);

Flight::route('GET /api/gettransbyid/@id', [$trans, 'getByProductId']);

Flight::route('GET /api/getusers', [$users, 'getUsers']);
Flight::route('GET /api/getuser/@id', [$users, 'getUserById']);

Flight::route('POST /api/login/@email/@password', [$users, 'login']);

Flight::start();