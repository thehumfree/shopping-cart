<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "farmer";
    $port  = 3308;

    $conn = new mysqli($host, $user, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection not successful".$conn->connect_error);
    }
    session_start();
