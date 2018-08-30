<?php
require_once "./controllers/winner.php";

$winner = new Winner();

Flight::route('POST /api/winner', [$winner, 'addWinner']);