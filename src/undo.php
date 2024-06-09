<?php

use Core\Database;

$mysqli = new Database();

session_start();

try {
    $db = $mysqli->connect();
} catch (Exception $e) {
    echo $e->getMessage();
}
$stmt = $db->prepare('SELECT * FROM moves WHERE id = ' . $_SESSION['last_move']);
$stmt->execute();
$result = $stmt->get_result()->fetch_array();
$_SESSION['last_move'] = $result[5];
$mysqli->setState($result[6]);
header('Location: index.php');
