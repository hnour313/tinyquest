<?php
session_start();
require_once '../backend/config/db.php';

// Admin-Login-Schutz:
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit;
}

// Aktuellen Admin-Username laden (für Passwort ändern)
$stmt = $pdo->query("SELECT username FROM admins LIMIT 1");
$adminUser = $stmt->fetchColumn();

// Tabs
$activeTab = $_GET['tab'] ?? 'quests';

// --- Quests laden und bearbeiten ---
$stmt = $pdo->query("SELECT * FROM quests ORDER BY id DESC");
$quests = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_quest'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $points = (int)$_POST['points'];
    if ($title && $description && $points > 0) {
        $stmt = $pdo->prepare("INSERT INTO quests (title, description, points) VALUES (?, ?, ?)");
        $stmt->execute([$title, $description, $points]);
        header("Location: admin.php?tab=quests");
        exit;
    }
}
if (isset($_GET['delq'])) {
    $stmt = $pdo->prepare("DELETE FROM quests WHERE id = ?");
    $stmt->execute([$_GET['delq']]);
    header("Location: admin.php?tab=quests");
    exit;
}

// --- Users laden ---
$stmt = $pdo->query("SELECT id, username, points FROM users ORDER BY points DESC");
$users = $stmt->fetchAll();

// --- Passwort ändern ---
$pwChangeMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_admin_pw'])) {
    $newPw = $_POST['new_password'];
    if (strlen($newPw) >= 4) {
        $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE username = ?");
        $stmt->execute([password_hash($newPw, PASSWORD_BCRYPT), $adminUser]);
        $pwChangeMsg = "✅ Passwort erfolgreich geändert!";
    } else {
        $pwChangeMsg = "❌ Passwort zu kurz!";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>TinyQuest Adminpanel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Magic Design -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="/frontend/assets/css/style.css">
</head>
<body>
<div class="admin-container">
  <div class="sidebar">
    <div class="logo-circle"><i class="fa-solid fa-hat-wizard"></i></div>
    <a href="admin.php?tab=quests" class="side-link<?= $activeTab=='quests'?' active':'' ?>"><i class="fa-solid fa-list-check"></i> Quests</a>
    <a href="admin.php?tab=users" class="side-link<?= $activeTab=='users'?' active':'' ?>"><i class="fa-solid fa-users"></i> User</a>
    <a href="admin.php?tab=settings" class="side-link<?= $activeTab=='settings'?' active':'' ?>"><i class="fa-solid fa-cog"></i> Einstellungen</a>
    <a href="/api/endpoints/logout.php" class="side-link"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
  </div>
  <div class="main-panel">
    <?php if ($activeTab == 'quests'): ?>
      <h2><i class="fa-solid fa-list-check"></i> Quests verwalten</h2>
      <form method="post" class="form-row" style="gap:.5em;">
        <input type="hidden" name="add_quest" value="1">
        <input class="form-control" type="text" name="title" placeholder="Titel" required>
        <input class="form-control" type="text" name="description" placeholder="Beschreibung" required>
        <input class="form-control" type="number" name="points" placeholder="Punkte" required min="1" style="width:80px;">
        <button type="submit" class="cta-btn"><i class="fa-solid fa-plus"></i> Hinzufügen</button>
      </form>
      <table>
        <tr><th>ID</th><th>Titel</th><th>Beschreibung</th><th>Punkte</th><th>Aktion</th></tr>
        <?php foreach ($quests as $q): ?>
        <tr>
          <td><?= $q['id'] ?></td>
          <td><?= htmlspecialchars($q['title']) ?></td>
          <td><?= htmlspecialchars($q['description']) ?></td>
          <td><?= (int)$q['points'] ?></td>
          <td>
            <a class="del-btn" href="admin.php?delq=<?= $q['id'] ?>" onclick="return confirm('Quest wirklich löschen?')"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php elseif ($activeTab == 'users'): ?>
      <h2><i class="fa-solid fa-users"></i> Userliste & Punkte</h2>
      <table>
        <tr><th>ID</th><th>Benutzername</th><th>Punkte</th></tr>
        <?php foreach ($users as $u): ?>
        <tr>
          <td><?= $u['id'] ?></td>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <td><?= (int)$u['points'] ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php elseif ($activeTab == 'settings'): ?>
      <h2><i class="fa-solid fa-key"></i> Admin-Passwort ändern</h2>
      <?php if ($pwChangeMsg) echo '<div class="msg">'.$pwChangeMsg.'</div>'; ?>
      <form method="post" style="max-width:340px;">
        <input type="hidden" name="new_admin_pw" value="1">
        <input type="password" name="new_password" placeholder="Neues Passwort" class="form-control" required>
        <button type="submit" class="cta-btn">Speichern</button>
      </form>
      <div style="margin-top:2em;font-size:.97em;color:#999;">
        <i class="fa-solid fa-info-circle"></i> Passwort mindestens 4 Zeichen.
      </div>
    <?php endif; ?>
  </div>
</div>
</body>
</html>
