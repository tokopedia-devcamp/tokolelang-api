<?php

require_once "flight/Flight.php";
require_once "./controllers/api.php";
require_once "./controllers/user.php";
require_once "./controllers/home.php";

$master = new MasterApi();
$users = new User();
$home = new Home();

Flight::route('GET /', [$home, 'getHome']);

Flight::route('GET /api', [$master, 'send404']);
Flight::route('GET /api/getusers', [$users, 'getUsers']);
Flight::route('GET /api/getuser/@id', [$users, 'getUserById']);

Flight::start();