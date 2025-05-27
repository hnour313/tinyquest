<?php
require_once '../backend/config/db.php';
$stmt = $pdo->query("SELECT username, points FROM users");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>User-Übersicht</title>
    <link href="../frontend/assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Alle Nutzer</h2>
    <table class="table table-dark table-striped">
        <tr><th>Username</th><th>Punkte</th></tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= (int)$user['points'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="challenges.php" class="btn btn-secondary mt-3">Zu den Challenges</a>
</div>
</body>
</html>
