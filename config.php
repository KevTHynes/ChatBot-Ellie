<?php

$server = '127.0.0.1';
$username = 'root';
$password = 'mysql';
$database = 'chatbotpractical';

$mode = "debug";

//echo "Hello";

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    //  echo "We should have a connection";

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Print host information
    //echo "Connected Successfully. Host info: " .
    //$conn->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>