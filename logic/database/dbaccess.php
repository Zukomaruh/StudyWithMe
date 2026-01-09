<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "studywithmedb";

    $db_obj = new mysqli($host, $user, $password, $database);

    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_conn->connect_error;
        exit();
    }
?>