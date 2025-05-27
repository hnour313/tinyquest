<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
session_start();

// Alle Session-Daten löschen
$_SESSION = [];
session_unset();
session_destroy();

// Optional: Session-Cookie löschen
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Zurück zur Login-Seite
header("Location: /frontend/login.html");
exit;
