<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $db = "flight";

    $conn = new mysqli($serverName,$userName,$password,$db);

    if($conn->connect_error){
        die("connection failed:" .$conn->connect_error);
    }
   
?>