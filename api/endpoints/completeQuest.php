<?php
session_start();
require_once '../../backend/config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    // Nicht eingeloggt: zurück zur Loginseite
    header("Location: /frontend/login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quest_id'])) {
    $quest_id = (int)$_POST['quest_id'];

    // Prüfen, ob Quest schon erledigt ist
    $stmt = $pdo->prepare("SELECT id FROM completed_quests WHERE user_id = ? AND quest_id = ?");
    $stmt->execute([$user_id, $quest_id]);
    if (!$stmt->fetch()) {
        // Eintragen als erledigt
        $stmt = $pdo->prepare("INSERT INTO completed_quests (user_id, quest_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $quest_id]);

        // Punkte dem User gutschreiben
        $stmt = $pdo->prepare("SELECT points FROM quests WHERE id = ?");
        $stmt->execute([$quest_id]);
        $points = $stmt->fetchColumn();

        if ($points) {
            $stmt = $pdo->prepare("UPDATE users SET points = points + ? WHERE id = ?");
            $stmt->execute([$points, $user_id]);
        }
    }
}

// Nach dem Abschicken **immer zurück zum Dashboard**
header("Location: /frontend/dashboard.php");
exit;
?>
