<?php
    session_start();
    require_once "../logic/database/dbaccess.php";
    require_once "../logic/functions.php"; //Functions-Zugriff

    $name = "";
    $email = "";
    $password="";
    $passwordConfirm="";
    $course = "";
    $privacy = false;

    function sendErrorMessage($error){
        $_SESSION["error"] = $error;
        header("Location: ../createAccount.php");
        exit;
    }

    //Wenn Zugriff nicht POST ist, wird Methode darüber aufgerufen
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        sendErrorMessage("Invalid request");
    }

    //-----Trimmed eingabe, und weist "" zu falls nicht gesetzt-----
    $name = trim($_POST["name"]) ?? ""; 
    $email = trim($_POST["email"]) ?? "";
    $password = $_POST["password"] ?? "";
    $passwordConfirm = $_POST["passwordConfirm"] ?? "";
    $course = trim($_POST["course"]) ?? "";
    $privacy = isset($_POST["privacy"]);

    //-----Form validation------
    $name === "" && sendErrorMessage("please enter name");
    $email === "" && sendErrorMessage("pleas enter email");
    !filter_var($email, FILTER_VALIDATE_EMAIL) && sendErrorMessage("please enter valid email");
    $password === "" && sendErrorMessage("please enter password");
    $course === "" && sendErrorMessage("please select course");
    $password !== $passwordConfirm && sendErrorMessage("passwords do not match");
    !$privacy && sendErrorMessage("You must agree to the privacy policy");
    
    //-----Password hashing-----
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //-----Check ob email already exists-----
    $stmt = $db_obj->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        sendErrorMessage("Email already registered");
    }
    $stmt->close();


    //----Inserten in die DB----

    //SQL-Statement erstellen
    $sql = "INSERT INTO `users` (`name`, `email`, `password`, `course`) VALUES (?, ?, ?, ?)";

    //SQL-Statement vorbereiten
    $stmt = $db_obj->prepare($sql);

    //Parameter binden
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $course);

    //Statement ausführen - führt direkt in der if-Klammer aus
    if (!$stmt->execute()) {
        sendErrorMessage("Registration failed");
    }

    //Statement und DB schließen
    $stmt->close();

    //----user ID holen für study_session---
    $userId = getUserIdByEmail($db_obj, $email);

    //---- Rolle des Users holen ----
    $stmt = $db_obj->prepare("
        SELECT role
        FROM users
        WHERE email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

    $db_obj->close();

    //------Weiterleiten & Session--------
    $_SESSION["logged_in"] = true;
    $_SESSION['user_id'] = $userId;
    $_SESSION['role'] = $role;
    header("Location: ../campusmap.php");
    exit;
?>