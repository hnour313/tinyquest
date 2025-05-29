<?php
session_start();
require_once '../backend/config/db.php';
require_once '../backend/classes/User.php';

// User prüfen
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.html");
    exit;
}

$user = new User($pdo, $user_id);
$openQuests = $user->getOpenQuests($pdo);
$completedQuests = $user->getCompletedQuests($pdo);

include 'includes/header.php';
?>
<div class="container">
  <a href="/api/endpoints/logout.php" class="logout-btn"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
  <div class="user-panel">
    <div class="avatar"><i class="fa-solid fa-hat-wizard"></i></div>
    <div class="user-info">
      <b><?= htmlspecialchars($user->username) ?></b><br>
      Punkte: <span class="points"><?= (int)$user->points ?></span>
    </div>
  </div>
  <h2 class="section-title"><i class="fa-solid fa-star"></i> Offene Quests</h2>
  <div class="quests-list">
    <?php if (count($openQuests) === 0): ?>
      <div class="quest-card">
        <div class="icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
        <div class="quest-title">Alle Quests erledigt!</div>
        <div class="quest-desc">Komm morgen wieder für neue Herausforderungen.</div>
      </div>
    <?php endif; ?>
    <?php foreach ($openQuests as $q): ?>
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
<?php include 'includes/adminlink.php'; ?>
<?php include 'includes/footer.php'; ?>
