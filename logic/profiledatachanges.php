<?php
   session_start();
    require_once "../logic/database/dbaccess.php"; // DB-Zugang
    require_once "../logic/functions.php"; //Functions-Zugriff
    
    if (isset($_POST["submit"])) {

        //prepare filename for upload
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $target_dir = 'assets/uploads/';
        $file = @$_FILES["profilePicture"];
        $picname = explode(".", @$_FILES["profilePicture"]["name"]);
        $target_file = trim($target_dir . $picname[0] . "_". $timestamp . "." . end($picname));
        $acceptedtype = ["jpg", "jpeg", "png"];

        //move temp-file to target path assets/uploads
        if(move_uploaded_file($file["tmp_name"], $target_dir)){
            //createDBentry($target_file, $_SESSION["user_id"]);
            //save file path to users database
            $stmt = $db_obj->prepare("UPDATE users SET profile_pic = ? WHERE user_id = ?");
            $stmt->bind_param("si", $target_file, $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
            sendErrorMessageLocation("file was uploaded", "Location: ../profile.php");
        }else{
            sendErrorMessageLocation("Error with file upload", "Location: ../profile.php");
        }
            // Überprüfe, ob Dateien hochgeladen wurden
        /*if (!empty($file)) {
            echo "<pre>"; // Formatiert die Ausgabe für bessere Lesbarkeit
            var_dump($file);
            echo "</pre>";
        } else {
            echo "Keine Dateien hochgeladen.";
        }*/
    }
?>