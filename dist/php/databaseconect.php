<?php

session_start();
$host = 'localhost';
$dbname = 'academia';
$username = 'javier';
$password = 'javier';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "<script>console.log( 'Connected to $dbname at $host successfully.' );</script>";
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
