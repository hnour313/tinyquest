<?php
session_start();

// Alles, was zur Session gehört, zerstören
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Admin-Logout?
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'admin') !== false) {
    header("Location: /frontend/admin_login.php");
    exit;
}
// Default: User-Logout
header("Location: /frontend/login.html");
exit;
?>
