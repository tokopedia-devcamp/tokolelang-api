<?php
require_once "./controllers/transaction_bid.php";

$trans = new Transaction();

Flight::route('GET /api/tr/productid/@id', [$trans, 'getByProductId']);
Flight::route('GET /api/tr/bidwinner/@id', [$trans, 'getBidWinner']);
Flight::route('POST /api/tr/postbid/', [$trans, 'insertTransactionBid']);