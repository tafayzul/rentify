<?php
include('config/database.php');
session_start();

$response = array('status' => '', 'message' => '');

if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'buyer') {
    $user_id = $_SESSION['user_id'];
    $property_id = $_POST['property_id'];

    $sql = "INSERT INTO likes (user_id, property_id) VALUES ('$user_id', '$property_id')";
    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Property liked successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Unauthorized access.';
}

echo json_encode($response);
?>
