<?php
require_once "./controllers/product.php";

$product = new Product();

Flight::route('GET /api/products', [$product, 'getProducts']);