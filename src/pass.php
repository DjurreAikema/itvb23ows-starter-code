<?php

require_once __DIR__ . '/vendor/autoload.php';

use Models\Database;
use Helpers\SessionHelper;

$db = Database::getInstance()->getConnection();
$sessionHelper = new SessionHelper();

session_start();

$stmt = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "pass", null, null, ?, ?)');
$state = $sessionHelper->getState();
$stmt->bind_param('iis', $_SESSION['game_id'], $_SESSION['last_move'], $state);
$stmt->execute();
$_SESSION['last_move'] = $db->insert_id;
$_SESSION['player'] = 1 - $_SESSION['player'];

header('Location: index.php');
