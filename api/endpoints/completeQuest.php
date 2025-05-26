<?php
require_once '../../backend/config/db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    http_response_code(403);
    echo json_encode(['error' => 'Nicht eingeloggt']);
    exit;
}

$quest_id = $_POST['quest_id'] ?? null;
if (!$quest_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Quest-ID fehlt']);
    exit;
}

// Hole die Punkte für die Quest
$stmt = $pdo->prepare("SELECT points FROM quests WHERE id = :id");
$stmt->execute(['id' => $quest_id]);
$points = $stmt->fetchColumn();

// Trage die erledigte Quest ein
$stmt = $pdo->prepare("INSERT IGNORE INTO completed_quests (user_id, quest_id, completed_at) VALUES (:user_id, :quest_id, NOW())");
$stmt->execute(['user_id' => $user_id, 'quest_id' => $quest_id]);

// Erhöhe die Punkte beim User
$stmt = $pdo->prepare("UPDATE users SET points = points + :points WHERE id = :user_id");
$stmt->execute(['points' => $points, 'user_id' => $user_id]);

header("Location: ../../index.php");
exit;
?>
