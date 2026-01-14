
<?php
    session_start();
    require_once "../logic/database/dbaccess.php"; // DB-Zugang

    $email = "";
    $password="";

    function sendErrorMessage($error){
        $_SESSION["error"] = $error;
        header("Location: ../login.php");
        exit;
    }

    //Wenn Zugriff nicht POST ist, wird Methode darüber aufgerufen
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        sendErrorMessage("Invalid request");
    }

    $email = trim($_POST["email"]) ?? "";
    $password = trim($_POST["password"]) ?? "";

    //------Eingabevalidierung------
    $email === "" && sendErrorMessage("Please enter your email");
    !filter_var($email, FILTER_VALIDATE_EMAIL) && sendErrorMessage("Please enter a valid email");
    $password === "" && sendErrorMessage("Please enter your password");
                
   //------DB-Abfrage: Existiert die Email?-----
    $stmt = $db_obj->prepare("SELECT password, name FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    //Kein User mit dieser Email
    if ($stmt->num_rows === 0) {
        sendErrorMessage("There is no account with the email " . htmlspecialchars($email));
    }

    //------Passwort prüfen------
    //Passwort aus DB holen
    $stmt->bind_result($hashedPassword, $name);
    $stmt->fetch(); //what does this do??

    if (!password_verify($password, $hashedPassword)) {
        sendErrorMessage("Invalid password");
    }

    //------Statement und DB schließen-----
    $stmt->close();
    $db_obj->close();


    $_SESSION["logged_in"] = true;
    //$_SESSION["user_name"] = $name;
    header("Location: ../campusmap.php");
    exit;
?>