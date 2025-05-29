<?php
require_once '../backend/config/db.php';
session_start();

// Check, ob es einen Admin gibt
$stmt = $pdo->query("SELECT COUNT(*) FROM admins");
$adminExists = $stmt->fetchColumn() > 0;

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!$adminExists) {
        // Erst-Setup: Admin anlegen
        if ($username && $password) {
            $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->execute([$username, password_hash($password, PASSWORD_BCRYPT)]);
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php");
            exit;
        } else {
            $err = "Bitte alles ausfüllen!";
        }
    } else {
        // Normale Anmeldung
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php");
            exit;
        } else {
            $err = "Falsche Zugangsdaten!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Admin Login – TinyQuest</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="/frontend/assets/css/style.css">
</head>
<body>
  <div class="wrapper">
    <div class="form-card">
      <div class="logo-circle">
        <i class="fa-solid fa-user-shield"></i>
      </div>
      <h2><?= $adminExists ? "Admin Login" : "Admin einrichten" ?></h2>
      <?php if($err): ?><div class="err"><?= htmlspecialchars($err) ?></div><?php endif; ?>
      <form method="post">
        <input type="text" name="username" placeholder="Admin Benutzername" class="form-control" required>
        <input type="password" name="password" placeholder="Admin Passwort" class="form-control" required>
        <button type="submit" class="cta-btn"><?= $adminExists ? "Login" : "Erstellen" ?></button>
      </form>
      <a href="/" class="backlink"><i class="fa-solid fa-arrow-left"></i> Zurück zur Startseite</a>
    </div>
  </div>
</body>
</html>
