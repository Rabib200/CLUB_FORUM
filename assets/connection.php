<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "uiuclub";

    $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

    if(!$con){
        die("Failed to connect!");
    }
?>