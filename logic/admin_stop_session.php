<?php
session_start();

require_once "database/dbaccess.php";
require_once "functions.php";

// Sicherheit: Login + Admin
if (
    empty($_SESSION['logged_in']) ||
    empty($_SESSION['user_id']) ||
    empty($_SESSION['role']) ||
    $_SESSION['role'] !== 'admin'
) {
    header("Location: ../login.php");
    exit;
}

// DAS HIER VLLT RAUS??
if (empty($_POST['session_id'])) {
    // Notfall-Redirect (kein Session-ID mitgeschickt)
    header("Location: ../dashboard.php?error=missing_session_id");
    exit;
}

$sessionId = (int) $_POST['session_id'];

// Session in DB beenden (ADMIN)
stopStudySessionBySessionId($db_obj, $sessionId);

// Optional: Redirect zurück zum Dashboard
header("Location: ../dashboard.php?stopped=1");
exit;