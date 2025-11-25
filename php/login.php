<?php
header('Content-Type: application/json');

if(!isset($_POST['email'], $_POST['password'])){
    echo json_encode(["status"=>"error","message"=>"Email or password missing"]);
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli("localhost","root","","guvi_internship");
if($conn->connect_error){
    echo json_encode(["status"=>"error","message"=>"DB connection failed"]);
    exit;
}

// Prepared statement
$stmt = $conn->prepare("SELECT password FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0){
    echo json_encode(["status"=>"error","message"=>"Invalid credentials"]);
    exit;
}

$row = $result->fetch_assoc();
if(password_verify($password,$row['password'])){
    echo json_encode(["status"=>"success","message"=>"Login successful"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Invalid credentials"]);
}

$stmt->close();
$conn->close();
?>
