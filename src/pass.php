<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Database;
use Helpers\SessionHelper;

$mysqli = new Database();
$sessionHelper = new SessionHelper();

session_start();

try {
    $db = $mysqli->connect();
} catch (Exception $e) {
    echo $e->getMessage();
}
$stmt = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "pass", null, null, ?, ?)');
$state = $sessionHelper->getState();
$stmt->bind_param('iis', $_SESSION['game_id'], $_SESSION['last_move'], $state);
$stmt->execute();
$_SESSION['last_move'] = $db->insert_id;
$_SESSION['player'] = 1 - $_SESSION['player'];

header('Location: index.php');
