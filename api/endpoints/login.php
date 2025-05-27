<?php
require_once '../../backend/config/db.php';
session_start();

if (!isset($_POST['username'], $_POST['password'])) {
    // Fehlermeldung, am besten anzeigen lassen auf der Login-Seite
    header("Location: /frontend/login.html?error=1");
    exit;
}
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: /frontend/dashboard.php");
    exit;
} else {
    header("Location: /frontend/login.html?error=1");
    exit;
}
?>
