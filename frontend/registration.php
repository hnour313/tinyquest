<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>TinyQuest Registrierung</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="/frontend/assets/css/style.css">
</head>
<body>
  <div class="wrapper">
    <div class="form-card">
      <div class="logo-circle">
        <i class="fa-solid fa-user-plus"></i>
      </div>
      <h2>Registriere dich bei TinyQuest</h2>
      <form method="post" action="/api/endpoints/register.php">
        <input type="text" name="username" placeholder="Benutzername" class="form-control" required>
        <input type="password" name="password" placeholder="Passwort" class="form-control" required>
        <button type="submit" class="cta-btn">Registrieren</button>
      </form>
      <div class="login-link">
        Bereits Account? <a href="login.html">Jetzt einloggen</a>
      </div>
    </div>
  </div>
</body>
</html>
