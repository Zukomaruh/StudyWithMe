<?php
session_start();

require_once "database/dbaccess.php";
require_once "functions.php";

// Nur POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../campusmap.php");
    exit;
}

// Login prüfen
if (empty($_SESSION['logged_in']) || empty($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$userId  = $_SESSION['user_id'];
$roomId  = (int) ($_POST['room_id'] ?? 0);
$subject = trim($_POST['subject'] ?? '');

// Minimale Validierung
if ($roomId <= 0 || $subject === '') {
    header("Location: ../campusmap.php");
    exit;
}

// Action
if (isset($_POST['start_session'])) {
    startStudySession($db_obj, $userId, $roomId, $subject);
}

$building = $_POST['building'];
$floor    = $_POST['floor'];
$roomId   = $_POST['room_id'];

$_SESSION['study_session_active'] = true;
$_SESSION['active_room_id'] = $roomId;

header("Location: ../rooms.php?building=$building&floor=$floor&room_id=$roomId");
exit;
?>