<?php
include('config/database.php');
session_start();

$response = ['message' => ''];

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'buyer') {
    $response['message'] = 'You need to log in as a buyer to like a property.';
    echo json_encode($response);
    exit();
}

$property_id = $_POST['property_id'];

// Update the like count in the database
$sql = "UPDATE properties SET likes = likes + 1 WHERE id = $property_id";
if ($conn->query($sql) === TRUE) {
    $response['message'] = 'Property liked successfully.';
} else {
    $response['message'] = 'Error liking the property.';
}

echo json_encode($response);
?>
