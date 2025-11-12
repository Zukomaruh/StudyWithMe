<?php
    session_start();
    $name = "";
    $email = "";
    $password="";
    $passwordConfirm="";
    $course = "";
    $privacy = false;
    $errors = [];
    $success = "";

    function sendErrorMessage($error){
        $_SESSION["error"] = $error;
        header("Location: ../createAccount.php");
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = htmlspecialchars(trim($_POST["name"])) ?? ""; //trimmed eingabe, und weist "" zu falls nicht gesetzt
        $email = htmlspecialchars(trim($_POST["email"])) ?? "";
        $password = htmlspecialchars($_POST["password"]) ?? "";
        $passwordConfirm = htmlspecialchars($_POST["passwordConfirm"]);
        $course = htmlspecialchars(trim($_POST["course"]) ?? "");
        $privacy = htmlspecialchars($_POST["privacy"]);

        //form validation:
        $name === "" && sendErrorMessage("please enter name");
        $email === "" && sendErrorMessage("pleas enter email");
        !filter_var($email, FILTER_VALIDATE_EMAIL) && sendErrorMessage("please enter valid email");
        $password === "" && sendErrorMessage("please enter password");
        $course === "" && sendErrorMessage("please select course");
        $password !== $passwordConfirm && sendErrorMessage("passwords do not match");
        
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
        $_SESSION["logged_in"] = true;
        header("Location: ../campusmap.php");
        exit;
    }
?>