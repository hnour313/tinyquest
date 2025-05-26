<?php
// Fehlerausgabe einschalten
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Schritt 1: DB einbinden
require_once 'backend/config/db.php';
echo "<!-- DB erfolgreich eingebunden -->";

// Schritt 2: Session starten
session_start();
echo "<!-- Session gestartet -->";

// Schritt 3: User-ID prüfen
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    echo "<h3 style='color:red'>Nicht eingeloggt. Bitte <a href='/frontend/login.html'>einloggen</a>!</h3>";
    exit;
}
echo "<!-- User-ID: $user_id -->";

// Schritt 4: Userdaten laden
$stmt = $pdo->prepare("SELECT username, points FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    echo "<h3 style='color:red'>Kein Benutzer gefunden!</h3>";
    exit;
}
echo "<!-- User gefunden: {$user['username']} -->";

// Schritt 5: Quests laden
$stmt = $pdo->prepare(
    "SELECT q.* FROM quests q WHERE q.id NOT IN (SELECT quest_id FROM completed_quests WHERE user_id = ?)"
);
$stmt->execute([$user_id]);
$quests = $stmt->fetchAll();
echo "<!-- Quests geladen: ".count($quests)." Stück -->";
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>TinyQuest Dashboard</title>
  <link href="frontend/assets/css/style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1>Willkommen, <?= htmlspecialchars($user['username']) ?>!</h1>
    <h2 class="mb-4">Punkte: <?= (int)$user['points'] ?></h2>
    <a href="api/endpoints/logout.php" class="btn btn-outline-light float-end mb-3">Logout</a>
    <h4>Offene Quests:</h4>
    <table class="table table-dark table-striped">
      <tr><th>Titel</th><th>Beschreibung</th><th>Punkte</th><th>Aktion</th></tr>
      <?php foreach ($quests as $q): ?>
        <tr>
          <td><?= htmlspecialchars($q['title']) ?></td>
          <td><?= htmlspecialchars($q['description']) ?></td>
          <td><?= (int)$q['points'] ?></td>
          <td>
            <form method="post" action="api/endpoints/completeQuest.php" style="display:inline;">
              <input type="hidden" name="quest_id" value="<?= $q['id'] ?>">
              <button type="submit" class="btn btn-success btn-sm">✔ Erledigt</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>
