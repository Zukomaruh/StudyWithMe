<?php
session_start();

require_once "../logic/database/dbaccess.php";
require_once "../logic/functions.php";

$userId = $_SESSION['user_id'];
$user_data = getUserData($db_obj, $userId);

if (isset($_POST["submit"])) {
    //PROFILBILD
    if (
        isset($_FILES['profilePicture']) &&
        $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK
    ) {
        //UPLOAD-LOGIK
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $target_dir = '../assets/uploads/';
        $file = $_FILES["profilePicture"];
        $picname = explode(".", $file["name"]);
        $target_file =
            $target_dir . $picname[0] . "_" . $timestamp . "." . end($picname);

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if(in_array()){
            //ALTES PROFILBILD LÖSCHEN
            if (!empty($user_data['profile_pic']) && file_exists($user_data['profile_pic'])) {
                unlink($user_data['profile_pic']);
            }

            //DATEI SPEICHERN
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $stmt = $db_obj->prepare(
                    "UPDATE users SET profile_pic = ? WHERE user_id = ?"
                );
                $stmt->bind_param("si", $target_file, $userId);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    //NAME UPDATE
    if (
        isset($_POST['name']) &&
        $_POST['name'] !== $user_data['name']
    ) {
        $stmt = $db_obj->prepare(
            "UPDATE users SET name = ? WHERE user_id = ?"
        );
        $stmt->bind_param("si", $_POST['name'], $userId);
        $stmt->execute();
        $stmt->close();
    }

    //COURSE UPDATE
    if (
        isset($_POST['course']) &&
        $_POST['course'] !== $user_data['course']
    ) {
        $stmt = $db_obj->prepare(
            "UPDATE users SET course = ? WHERE user_id = ?"
        );
        $stmt->bind_param("si", $_POST['course'], $userId);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../profile.php");
    exit;
}