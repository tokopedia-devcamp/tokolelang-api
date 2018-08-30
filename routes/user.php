<?php
require_once "./controllers/user.php";

$users = new User();

Flight::route('GET /api/getusers', [$users, 'getUsers']);
Flight::route('GET /api/getuser/@id', [$users, 'getUserById']);

Flight::route('POST /api/login/@email/@password', [$users, 'login']);