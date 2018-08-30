<?php

require_once "flight/Flight.php";
require_once "./constants.php";

// Include Global API
require_once "./controllers/api.php";


// Global API
$master = new MasterApi();


// Routes
require_once "./routes/home.php";
require_once "./routes/user.php";
require_once "./routes/product.php";
require_once "./routes/transaction.php";
require_once "./routes/winner.php";
require_once "./routes/logistic.php";

// Global Route
Flight::route('GET /api', [$master, 'send404']);

Flight::start();