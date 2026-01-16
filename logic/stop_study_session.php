<?php
session_start();

require_once "database/dbaccess.php";
require_once "functions.php";

// Sicherheit
if (empty($_SESSION['logged_in']) || empty($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Session in DB beenden
stopStudySession($db_obj, $userId);

// Session-State zurücksetzen
$_SESSION['study_session_active'] = false;
unset($_SESSION['active_room_id']);

// Zurück zur Karte
$building = $_POST['building'];
$floor    = $_POST['floor'];
$roomId   = $_POST['room_id'];
header("Location: ../rooms.php?building=$building&floor=$floor&room_id=$roomId");
//header("Location: ../campusmap.php");
exit;