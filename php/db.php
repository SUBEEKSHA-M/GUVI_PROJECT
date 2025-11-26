<?php
// ------------------------------------
// MySQL Connection
// ------------------------------------
$mysqlHost = getenv('MYSQL_HOST') ?: "localhost";   // Use env variable on Render, default localhost locally
$mysqlUser = getenv('MYSQL_USER') ?: "root";        // Default root for XAMPP
$mysqlPass = getenv('MYSQL_PASSWORD') ?: "";        // Empty password for XAMPP
$mysqlDb   = getenv('MYSQL_DATABASE') ?: "guvi_internship"; // Replace with your local DB name

$conn = new mysqli($mysqlHost, $mysqlUser, $mysqlPass, $mysqlDb);

if ($conn->connect_error) {
    die("MySQL Connection failed: " . $conn->connect_error);
}

// ------------------------------------
// MongoDB Connection
// ------------------------------------
require 'vendor/autoload.php'; // Make sure you have installed MongoDB PHP library

$mongoUrl = getenv('MONGO_URL') ?: "mongodb://localhost:27017"; // Local MongoDB URL
$mongoClient = new MongoDB\Client($mongoUrl);
$profileDb = $mongoClient->guvi_internship; // MongoDB database name

// ------------------------------------
// Redis Connection
// ------------------------------------
require 'vendor/autoload.php'; // Predis or phpredis

$redisUrl = getenv('REDIS_URL') ?: "tcp://127.0.0.1:6379"; // Local Redis URL
$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);
?>
