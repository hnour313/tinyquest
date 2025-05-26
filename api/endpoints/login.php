<?php
require_once '../../backend/config/db.php';
session_start();

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['username'], $data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Benutzername und Passwort erforderlich']);
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $data['username']]);
$user = $stmt->fetch();
if ($user && password_verify($data['password'], $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    echo json_encode(['success' => true]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Login fehlgeschlagen']);
}
?>
