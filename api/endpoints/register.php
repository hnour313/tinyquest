<?php
require_once '../../backend/config/db.php';
session_start();

if (!isset($_POST['username'], $_POST['password'])) {
    header("Location: /frontend/register.html?error=1");
    exit;
}
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Benutzername prüfen
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    header("Location: /frontend/register.html?exists=1");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->execute([$username, $password]);

// Direkt einloggen nach Registrierung
$_SESSION['user_id'] = $pdo->lastInsertId();
header("Location: /frontend/dashboard.php");
exit;
?>
