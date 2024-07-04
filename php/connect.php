<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "pzpdb";

$conn = mysqli_connect($server, $username, $password, $dbname);

if(!$conn) {
    function alert_error($errmsg) {
        echo "<script>alert('$errmsg')</script>";
    }

    alert_error("Connection Failed!").mysqli_connect_error();
} else {
    echo "<script>console.log('Connection Successful.');</script>";
}

?>