<?php
// MySQL
$mysqlHost = "localhost";
$mysqlUser = "root";          // your MySQL username
$mysqlPass = "rootpassword";  // your MySQL password
$mysqlDb   = "guvi_db";

$conn = new mysqli($mysqlHost, $mysqlUser, $mysqlPass, $mysqlDb);
if ($conn->connect_error) {
    die("MySQL Connection failed: " . $conn->connect_error);
}

// MongoDB
require 'vendor/autoload.php';
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$profileDb = $mongoClient->guvi_db;

// Redis
$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);
?>
