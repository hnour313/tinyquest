<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}
require_once '../backend/config/db.php';

// Userdaten laden
$stmt = $pdo->prepare("SELECT username, points FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Quests laden
$stmt = $pdo->prepare(
    "SELECT q.* FROM quests q WHERE q.id NOT IN (
        SELECT quest_id FROM completed_quests WHERE user_id = ?)"
);
$stmt->execute([$_SESSION['user_id']]);
$quests = $stmt->fetchAll();

// Erledigte Quests laden
$stmt = $pdo->prepare(
    "SELECT q.* FROM quests q 
     JOIN completed_quests c ON q.id = c.quest_id 
     WHERE c.user_id = ?"
);
$stmt->execute([$_SESSION['user_id']]);
$completedQuests = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Dein TinyQuest Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Magic Design -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(120deg, #c8e6ff 0%, #e0c3fc 40%, #ffb6ea 100%);
      font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
      color: #342456;
      margin: 0; padding: 0;
      background-size: 400% 400%;
      animation: bgmove 13s ease infinite;
    }
    @keyframes bgmove {
      0% {background-position: 0 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0 50%;}
    }
    .container {
      max-width: 780px;
      margin: 3.5rem auto 1.5rem auto;
      padding: 2.3rem 2.1rem;
      background: rgba(255,255,255,0.94);
      border-radius: 2rem;
      box-shadow: 0 6px 48px #bb60ee44;
    }
    h1 {
      font-size: 2.2rem; font-weight: 700; color: #822ae7;
      margin-bottom: 0.4em; text-shadow: 0 1px 16px #f8e8ffbb;
    }
    .logout-btn {
      float: right;
      margin-top: -2.2rem;
      border: none;
      border-radius: 2em;
      background: linear-gradient(90deg, #e0c3fc 10%, #bb60ee 90%);
      color: #fff;
      font-weight: 600;
      padding: 0.5em 1.7em;
      box-shadow: 0 3px 16px #a0a4ff44;
      cursor: pointer;
      text-decoration: none;
      font-size: 1.08em;
      transition: background .15s, transform .11s;
    }
    .logout-btn:hover {
      background: linear-gradient(90deg, #bb60ee 20%, #e0c3fc 90%);
      transform: scale(1.05);
    }
    .user-panel {
      display: flex;
      align-items: center;
      gap: 1.2em;
      margin-bottom: 2em;
    }
    .avatar {
      width: 64px; height: 64px;
      border-radius: 50%;
      background: linear-gradient(135deg, #d4c1ff 40%, #f7cfff 80%);
      display: flex; align-items: center; justify-content: center;
      font-size: 2.2rem; color: #bb60ee;
      box-shadow: 0 2px 14px #b275e255;
    }
    .user-info {
      font-size: 1.14em; color: #6e409a;
    }
    .points {
      font-weight: bold; color: #7f8fff;
      margin-left: .45em; font-size: 1.12em;
    }
    .section-title {color:#bb60ee; font-size:1.15em; margin-top:2.5em;}
    .quests-list {
      display: flex; flex-wrap: wrap; gap: 1.4em; margin-top: 1em;
    }
    .quest-card {
      background: linear-gradient(120deg, #e0c3fc 0%, #ffe5ff 80%);
      border-radius: 1.25em;
      box-shadow: 0 4px 20px #a5afff22;
      padding: 1.2em 1.3em;
      flex: 1 1 280px; max-width: 320px;
      display: flex; flex-direction: column;
      gap: 0.4em;
      position: relative;
    }
    .quest-card .icon {
      font-size: 1.6em; color: #bb60ee;
      margin-bottom: 0.2em;
    }
    .quest-title {
      font-weight: 600; color: #822ae7;
      font-size: 1.13em;
      margin-bottom: .16em;
    }
    .quest-desc {color:#6e409a; font-size:1em;}
    .quest-points {
      color: #fff; background: #bb60ee;
      border-radius: 1em; padding: .22em .85em;
      font-size: .98em; margin-left:.7em;
    }
    .quest-card form {margin-top: 0.6em;}
    .quest-card button {
      border: none;
      border-radius: 1.2em;
      background: linear-gradient(90deg, #7f8fff 30%, #eeaefb 70%, #9af2ff 100%);
      color: #3a2175; font-weight: bold;
      padding: 0.47em 1.2em;
      box-shadow: 0 3px 12px #a0a4ff28;
      cursor: pointer; font-size: 1em;
      transition: background 0.16s, transform 0.10s;
    }
    .quest-card button:hover {
      background: linear-gradient(90deg, #e0c3fc 30%, #ffb6ea 90%);
      transform: scale(1.05);
    }
    .completed-quests {
      margin-top: 2.2em;
    }
    .completed-title {color:#6e409a; font-weight:600;}
    .completed-list {
      display: flex; flex-wrap: wrap; gap: 1.2em; margin-top: 0.7em;
    }
    .completed-card {
      background: #f9f7fe;
      border-radius: 1.2em;
      padding: .9em 1.1em;
      box-shadow: 0 2px 10px #b275e222;
      font-size: .98em;
      flex: 1 1 220px; max-width: 260px;
      color:#7d49c2;
    }
    @media (max-width: 900px) {
      .container {padding:1.2rem 0.5rem;}
      .quests-list, .completed-list {flex-direction: column;}
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="/api/endpoints/logout.php" class="logout-btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
    <div class="user-panel">
      <div class="avatar"><i class="fa-solid fa-hat-wizard"></i></div>
      <div class="user-info">
        <b><?= htmlspecialchars($user['username']) ?></b><br>
        Punkte: <span class="points"><?= (int)$user['points'] ?></span>
      </div>
    </div>

    <h2 class="section-title"><i class="fa-solid fa-star"></i> Offene Quests</h2>
    <div class="quests-list">
      <?php if (count($quests) === 0): ?>
        <div class="quest-card">
          <div class="icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
          <div class="quest-title">Alle Quests erledigt!</div>
          <div class="quest-desc">Komm morgen wieder für neue Herausforderungen.</div>
        </div>
      <?php endif; ?>
      <?php foreach ($quests as $q): ?>
        <div class="quest-card">
          <div class="icon"><i class="fa-solid fa-magic-wand-sparkles"></i></div>
          <div class="quest-title">
            <?= htmlspecialchars($q['title']) ?>
            <span class="quest-points">+<?= (int)$q['points'] ?> XP</span>
          </div>
          <div class="quest-desc"><?= htmlspecialchars($q['description']) ?></div>
          <form method="post" action="/api/endpoints/completeQuest.php">
            <input type="hidden" name="quest_id" value="<?= $q['id'] ?>">
            <button type="submit">✔ Erledigt</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="completed-quests">
      <h2 class="completed-title"><i class="fa-solid fa-circle-check"></i> Erledigte Quests</h2>
      <div class="completed-list">
        <?php if (count($completedQuests) === 0): ?>
          <div class="completed-card">Noch keine Quests erledigt.</div>
        <?php else: foreach ($completedQuests as $q): ?>
          <div class="completed-card">
            <b><?= htmlspecialchars($q['title']) ?></b><br>
            <?= htmlspecialchars($q['description']) ?><br>
            <span style="color:#bb60ee; font-weight:600;">+<?= (int)$q['points'] ?> XP</span>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
