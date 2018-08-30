<?php
require_once "./controllers/user.php";

$users = new User();

Flight::route('GET /api/user/getusers', [$users, 'getUsers']);
Flight::route('GET /api/user/getuser/@id', [$users, 'getUserById']);

Flight::route('POST /api/user/login/', [$users, 'login']);