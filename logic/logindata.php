
<?php
    session_start();
    $email = "";
    $password="";
    $errors = [];
    $success = "";

    function sendErrorMessage($error){
        $_SESSION["error"] = $error;
        header("Location: ../login.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = htmlspecialchars(trim($_POST["email"]) ?? "");
        $password = htmlspecialchars(trim($_POST["password"]) ?? "");

        if ($email === "" or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //$errors["email"] = "email is required";
            sendErrorMessage("please enter valid email");
            
            //Logik für später: "there is no account with the email xy..."
        }
        if($password === ""){
            sendErrorMessage("please enter valid password");
        }
        
        if (empty($errors)) {
            $success = true;
        }
    }
    // Show errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
        echo "<p style='color:red'>" . htmlspecialchars($error) . "</p>";
        }
    }
    // Show success message below the form
    if ($success !== "") {
        //for debugging:
        //echo "<p style='color:green'>$success</p>";
        $_SESSION["logged_in"] = true;
        header("Location: ../campusmap.php");
        exit;
    }
?>