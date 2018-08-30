<?php
require_once "./controllers/home.php";

$home = new Home();

Flight::route('GET /', [$home, 'getHome']);