<?php
    session_start();
    $_SESSION['guest'] = true;
    header("Location: ../campusmap.php");
    exit;
?>