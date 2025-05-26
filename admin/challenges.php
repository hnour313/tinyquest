<?php
require_once '../backend/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $points = (int)$_POST['points'];
    $stmt = $pdo->prepare("INSERT INTO quests (title, description, points) VALUES (?, ?, ?)");
    $stmt->execute([$title, $desc, $points]);
}
$challenges = $pdo->query("SELECT * FROM quests")->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Challenges verwalten</title>
    <link href="../frontend/assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Challenges</h2>
    <table class="table table-dark table-striped">
        <tr><th>Titel</th><th>Beschreibung</th><th>Punkte</th></tr>
        <?php foreach ($challenges as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['title']) ?></td>
                <td><?= htmlspecialchars($c['description']) ?></td>
                <td><?= (int)$c['points'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h3 class="mt-4">Neue Challenge anlegen</h3>
    <form method="post" class="row g-2">
        <div class="col-4"><input type="text" name="title" class="form-control" placeholder="Titel" required></div>
        <div class="col-4"><input type="text" name="description" class="form-control" placeholder="Beschreibung" required></div>
        <div class="col-2"><input type="number" name="points" class="form-control" value="10" min="1" required></div>
        <div class="col-2"><button type="submit" class="btn btn-success">Hinzufügen</button></div>
    </form>
    <a href="users.php" class="btn btn-secondary mt-3">Zu den Nutzern</a>
</div>
</body>
</html>
