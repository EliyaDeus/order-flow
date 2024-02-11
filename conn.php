<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "package";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if($conn -> connect_error){
        die("connection error" . $conn -> connect_error);
    }

?>