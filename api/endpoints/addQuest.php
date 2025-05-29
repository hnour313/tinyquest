<?php
require_once '../../backend/config/db.php';
session_start();

// Prüfen ob der User eingeloggt ist
if (!isset($_SESSION['user_id'])) {
    header('Location: /frontend/login.html');
    exit;
}

// Eingaben prüfen
$title = trim($_POST['title'] ?? '');
$desc = trim($_POST['description'] ?? '');
$points = (int)($_POST['points'] ?? 0);

if ($title && $desc && $points > 0) {
    $stmt = $pdo->prepare("INSERT INTO quests (title, description, points) VALUES (?, ?, ?)");
    $stmt->execute([$title, $desc, $points]);
}

// Zurück zum Dashboard
header('Location: /index.php');
exit;
