<?php
require_once "./controllers/payment.php";

$payment = new Payment();

Flight::route('POST /api/payment', [$payment, 'addPayment']);
