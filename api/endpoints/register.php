<?php
require_once '../../backend/config/db.php';
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['username'], $data['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Benutzername und Passwort erforderlich']);
    exit;
}
$username = $data['username'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->execute(['username' => $username, 'password' => $password]);
echo json_encode(['success' => true]);
