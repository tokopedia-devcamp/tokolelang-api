<?php
require_once "./controllers/transaction_bid.php";

$trans = new Transaction();

Flight::route('GET /api/gettransbyid/@id', [$trans, 'getByProductId']);