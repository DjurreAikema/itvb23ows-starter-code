<?php

require_once __DIR__ . '/vendor/autoload.php';

use Models\Database;
use Helpers\SessionHelper;

$db = Database::getInstance()->getConnection();
$sessionHelper = new SessionHelper();

session_start();

$stmt = $db->prepare('SELECT * FROM moves WHERE id = ' . $_SESSION['last_move']);
$stmt->execute();
$result = $stmt->get_result()->fetch_array();
$_SESSION['last_move'] = $result[5];
$sessionHelper->setState($result[6]);
header('Location: index.php');
