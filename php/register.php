<?php
header('Content-Type: application/json');

if(!isset($_POST['username'], $_POST['email'], $_POST['password'])){
    echo json_encode(["status"=>"error","message"=>"All fields are required"]);
    exit;
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$conn = new mysqli("localhost","root","","guvi_internship");
if($conn->connect_error){
    echo json_encode(["status"=>"error","message"=>"DB connection failed"]);
    exit;
}

// Prepared statement
$stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
$stmt->bind_param("sss", $username, $email, $password);

if($stmt->execute()){
    echo json_encode(["status"=>"success","message"=>"Registration successful"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Email already exists"]);
}

$stmt->close();
$conn->close();
?>
