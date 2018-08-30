<?php
require_once "./controllers/winner.php";

$winner = new Winner();

Flight::route('GET /api/winner_user/@id', [$winner, 'getWinnerByUserId']);
Flight::route('POST /api/winner', [$winner, 'addWinner']);