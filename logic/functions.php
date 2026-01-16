<?php
require_once "database/dbaccess.php"; // DB-Zugang

function getRoomNameById($db_obj, $roomId) {
    // Prepared Statement vorbereiten
    $stmt = $db_obj->prepare("SELECT building, floor, room_number FROM rooms WHERE id = ?");
    if (!$stmt) return "Unknown Room";

    $stmt->bind_param("i", $roomId); // ID = Integer
    $stmt->execute();
    $stmt->bind_result($building, $floor, $roomNumber);
    $stmt->fetch();
    $stmt->close();

    if (!$building) return "Unknown Room"; // falls kein Ergebnis

    // Raumnummer mit führender Null, falls kleiner 10
    $roomNumberStr = $roomNumber < 10 ? "0" . $roomNumber : $roomNumber;

    // Zusammensetzen
    return $building . $floor . "." . $roomNumberStr;
}

function getUserIdByEmail(mysqli $db_obj, string $email): int {
    $stmt = $db_obj->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt->close();

    return $userId;
}

function startStudySession(
    mysqli $db_obj,
    int $userId,
    int $roomId,
    string $subject
): void {

    // Check: läuft schon eine Session?
    $stmt = $db_obj->prepare("
        SELECT session_id
        FROM study_sessions
        WHERE user_id = ?
          AND end_time IS NULL
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        return;
    }
    $stmt->close();

    // Neue Session starten
    $stmt = $db_obj->prepare("
        INSERT INTO study_sessions (user_id, room_id, subject, start_time)
        VALUES (?, ?, ?, NOW())
    ");
    $stmt->bind_param("iis", $userId, $roomId, $subject);
    $stmt->execute();
    $stmt->close();
}

function stopStudySession(mysqli $db_obj, int $userId): void {
    $stmt = $db_obj->prepare("
        UPDATE study_sessions
        SET end_time = NOW()
        WHERE user_id = ?
          AND end_time IS NULL
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

function closeExpiredStudySessions(mysqli $db_obj): void {
    $stmt = $db_obj->prepare("
        UPDATE study_sessions
        SET end_time = NOW()
        WHERE end_time IS NULL
          AND start_time <= (NOW() - INTERVAL 60 MINUTE)
    ");
    $stmt->execute();
    $stmt->close();
}

function checkRunningSession(mysqli $db_obj, int $userId): void {
    // SQL: die letzte Session des Users abrufen
    $stmt = $db_obj->prepare("
        SELECT end_time 
        FROM study_sessions 
        WHERE user_id = ? 
        ORDER BY start_time DESC 
        LIMIT 1
    ");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($endTime);
    $stmt->fetch();
    $stmt->close();

    // Wenn letzte Session beendet ist (end_time nicht NULL) -> Session-Variablen zurücksetzen
    if ($endTime !== null) {
        $_SESSION['study_session_active'] = false;
        unset($_SESSION['active_room_id']);
    }
}

?>