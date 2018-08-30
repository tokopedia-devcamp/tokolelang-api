<?php
require_once "./controllers/logistic.php";

$logistic = new Logistic();

Flight::route('GET /api/logistics', [$logistic, 'getLogistic']);
