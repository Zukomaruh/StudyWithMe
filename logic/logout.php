<?php
    session_start();

    $_SESSION = []; // Empty session array or use session_unset();
    // Destroy the session cookie (PHPSESSID) - see Sessions&Cookies p.10
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]);
    }

    session_destroy();
    header("Location: ../index.php");
?>