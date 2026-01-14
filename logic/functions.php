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