<?php
    $name = "";
    $email = "";
    $password="";
    $course = "";
    $privacy = false;
    $errors = [];
    $success = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = trim($_POST["name"] ?? ""); //trimmed eingabe, und weist "" zu falls nicht gesetzt
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");
        $course = trim($_POST["course"] ?? "");
        $privacy = $_POST["privacy"];

        if ($name === "") {
            $errors[] = "First name is required.";
        }
        if ($email === "") {
            $errors[] = "Email is required.";
        } 
        if($password === ""){
            $errors[] = "password is required.";
        }
        if($course === ""){
            $errors[] = "course is required.";
        }
        //check ob email valide hier nicht notwendig, wird schon durch input type im html geregelt!
        if (empty($errors)) {
            $success = "Hello " . htmlspecialchars($name) . "!"
            . "<br>" . "Your email address is " . htmlspecialchars($email)
            . "<br>" . "Your password is " . htmlspecialchars($password)
            . "<br>" . "Your course is " . htmlspecialchars($course)
            . "<br>" . "Agreed to privacy settings: " . "$privacy";
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