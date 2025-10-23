<?php
    $email = "";
    $password="";
    $errors = [];
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($email === "") {
            $errors[] = "email is required";
            //Logik für später: "there is no account with the email xy..."
        } 
        if($password === ""){
            $errors[] = "password is required.";
        }

        if (empty($errors)) {
            $success = "Successfully logged in as " . "$email " . "with pw " . "$password";
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
        echo "<p style='color:green'>$success</p>";
    }
?>