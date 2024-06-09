<?php

use Core\Database;

$mysqli = new Database();

session_start();

$_SESSION['board'] = [];
$_SESSION['hand'] = [0 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3], 1 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3]];
$_SESSION['player'] = 0;

try {
    $db = $mysqli->connect();
} catch (Exception $e) {
    echo $e->getMessage();
}
$db->prepare('INSERT INTO games VALUES ()')->execute();
$_SESSION['game_id'] = $db->insert_id;

header('Location: index.php');
