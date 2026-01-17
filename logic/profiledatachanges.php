<?php
   session_start();
    require_once "../logic/database/dbaccess.php"; // DB-Zugang
    require_once "../logic/functions.php"; //Functions-Zugriff
    $user_data = getUSerData($db_obj, $_SESSION['user_id']); //get userData from db
    
    if (isset($_POST["submit"])) {
        if(isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK){
            //prepare filename for upload
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $target_dir = '../assets/uploads/';
            $file = $_FILES["profilePicture"];
            $picname = explode(".", @$_FILES["profilePicture"]["name"]);
            $target_file = $target_dir .
            $picname[0] . "_". $timestamp . "." . end($picname);
            $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $acceptedtype = ["jpg", "jpeg", "png"];
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // rekursiv Ordner erstellen falls nötig
            }
            if(in_array($extension, $acceptedtype)){
                //move temp-file to target path assets/uploads
                if(move_uploaded_file($file["tmp_name"], $target_file)){
                    //save file path to users database
                    $stmt = $db_obj->prepare("UPDATE users SET profile_pic = ? WHERE user_id = ?");
                    $stmt->bind_param("si", $target_file, $_SESSION['user_id']);
                    $stmt->execute();
                    $stmt->close();
                    //sendErrorMessageLocation("file was uploaded", "Location: ../profile.php");
                }else{
                    $error = "Error with file upload";
                }
            }else{
                $error = "please upload an jpeg, jpg or png!";
            }
        }
        if($_POST['name'] !== $user_data['name']){
            $stmt = $db_obj->prepare("UPDATE users SET name = ? WHERE user_id = ?");
            $stmt->bind_param("si", $_POST['name'], $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
        }
        if($_POST['course'] !== $user_data['course']){
            $stmt = $db_obj->prepare("UPDATE users SET course = ? WHERE user_id = ?");
            $stmt->bind_param("si", $_POST['course'], $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
        }
        if(isset($error)){
            sendErrorMessageLocation($error, "Location: ../profile.php");
        }else{
            header("Location: ../profile.php");
        }
    }
?>