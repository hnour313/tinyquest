<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>TinyQuest – Starte dein Abenteuer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      min-height: 100vh;
      background: linear-gradient(120deg, #c8e6ff 0%, #e0c3fc 40%, #ffb6ea 100%);
      font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
      color: #342456;
      margin: 0;
      padding: 0;
      background-size: 400% 400%;
      animation: bgmove 13s ease infinite;
    }
    @keyframes bgmove {
      0% {background-position: 0 50%;}
      50% {background-position: 100% 50%;}
      100% {background-position: 0 50%;}
    }
    .wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .hero {
      max-width: 470px;
      margin: auto;
      background: rgba(255,255,255,0.90);
      border-radius: 2rem;
      box-shadow: 0 6px 48px #bb60ee44, 0 1.5px 6px #33d0f622;
      padding: 2.7rem 2.5rem 2.3rem 2.5rem;
      text-align: center;
      position: relative;
    }
    .logo-circle {
      width: 88px; height: 88px;
      background: linear-gradient(135deg, #b6baff 0%, #f7cfff 80%);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 2px 16px #7e91c5cc;
      font-size: 2.6rem;
      margin: 0 auto 1.1em auto;
      color: #bb60ee;
      border: 3px solid #e0c3fc;
    }
    h1 {
      font-size: 2.4rem;
      font-weight: 700;
      margin-bottom: 0.32em;
      color: #822ae7;
      text-shadow: 0 1px 16px #f8e8ffbb;
      letter-spacing: .01em;
    }
    h2 {
      font-size: 1.12rem;
      margin-bottom: 1.1em;
      color: #7d49c2;
      font-weight: 500;
    }
    .desc {
      color: #48206c;
      font-size: 1.14em;
      margin-bottom: 1.7em;
      line-height: 1.46em;
    }
    .cta-btn {
      border: none;
      border-radius: 2em;
      background: linear-gradient(90deg, #7f8fff 30%, #eeaefb 70%, #9af2ff 100%);
      color: #3a2175;
      font-weight: 700;
      padding: 0.68em 2.1em;
      font-size: 1.14em;
      margin: 0.6em 0.38em;
      box-shadow: 0 3px 16px #a0a4ff44;
      cursor: pointer;
      transition: background 0.15s, transform 0.12s;
      text-decoration: none;
      display: inline-block;
    }
    .cta-btn:hover {
      background: linear-gradient(90deg, #e0c3fc 30%, #ffb6ea 90%);
      transform: scale(1.06);
    }
    .features-list {
      margin: 1.5em 0 0 0; 
      padding: 0; 
      list-style: none; 
      font-size: 1.05em; 
      color: #6e409a;
      text-align: left;
    }
    .features-list li {
      margin: .32em 0;
      display: flex;
      align-items: center;
      gap: .7em;
    }
    .features-list i {
      color: #b275e2;
      font-size: 1.18em;
      margin-right: 0.5em;
    }
    @media (max-width: 650px) {
      .hero {padding: 1.2rem 0.7rem;}
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <div class="hero">
      <div class="logo-circle">
        <i class="fa-solid fa-magic-wand-sparkles"></i>
      </div>
      <h1>TinyQuest</h1>
      <h2>Gamify your Day. Level up your Life!</h2>
      <div class="desc">
        TinyQuest bringt Magie und Motivation in deinen Alltag! <br>
        Schließe jeden Tag kleine Quests ab, sammle Punkte und verdiene Badges.<br>
        Werde Teil einer Community, die aus Alltäglichem ein Spiel macht.
      </div>
      <a href="/frontend/login.html" class="cta-btn"><i class="fa-solid fa-right-to-bracket"></i> Einloggen</a>
      <a href="/frontend/registration.html" class="cta-btn"><i class="fa-solid fa-user-plus"></i> Registrieren</a>
      <ul class="features-list">
        <li><i class="fa-solid fa-check"></i> Tägliche und wöchentliche Quests</li>
        <li><i class="fa-solid fa-check"></i> Motivation durch Streaks und Badges</li>
        <li><i class="fa-solid fa-check"></i> Spielerisches, magisches Design</li>
        <li><i class="fa-solid fa-check"></i> Fortschritt immer im Blick</li>
      </ul>
    </div>
  </div>
</body>
</html>
