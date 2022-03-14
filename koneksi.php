<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_visitorbpom";

$koneksi = mysqli_connect($servername, $username, $password, $dbname);
if (!$koneksi){
        die("Connection Failed:".mysqli_connect_error());
    }
?>