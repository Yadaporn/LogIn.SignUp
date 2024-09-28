<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "prior_users";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected";
    } catch(PDOException $e) {
        echo "failed connect to database". $e->getMessage();
    }
?>