<?php
header('Content-Type: application/json');

// Correct path to Composer autoload
require __DIR__ . '/../vendor/autoload.php';

// Connect to MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->guvi->profiles;

// Get POST data
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? null;
$dob = $_POST['dob'] ?? null;
$contact = $_POST['contact'] ?? null;

if (!$email) {
    echo json_encode(["status" => "error", "message" => "Email missing"]);
    exit;
}

// Fetch existing profile
$profile = $collection->findOne(["email" => $email]);

// Update profile if fields are provided
if ($age !== null || $dob !== null || $contact !== null) {
    $updateData = [];
    if ($age !== null) $updateData['age'] = $age;
    if ($dob !== null) $updateData['dob'] = $dob;
    if ($contact !== null) $updateData['contact'] = $contact;

    if ($profile) {
        $collection->updateOne(
            ["email" => $email],
            ['$set' => $updateData]
        );
    } else {
        $updateData['email'] = $email;
        $collection->insertOne($updateData);
    }

    echo json_encode(["status" => "success", "message" => "Profile updated successfully"]);
    exit;
}

// Return profile data if exists
echo json_encode([
    "status" => "success",
    "data" => [
        "age" => $profile['age'] ?? "",
        "dob" => $profile['dob'] ?? "",
        "contact" => $profile['contact'] ?? ""
    ]
]);
