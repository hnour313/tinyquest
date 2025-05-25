<?php
require_once '../../backend/config/db.php';
header('Content-Type: application/json');
$stmt = $pdo->query("SELECT * FROM quests");
$quests = $stmt->fetchAll();
echo json_encode($quests);
