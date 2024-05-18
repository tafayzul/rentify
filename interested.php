<?php
include('config/database.php');
session_start();

$response = array('status' => '', 'message' => '');

if (isset($_SESSION['user_id']) && $_SESSION['user_type'] == 'buyer') {
    $user_id = $_SESSION['user_id'];
    $property_id = $_POST['property_id'];

    $sql = "INSERT INTO interested (user_id, property_id) VALUES ('$user_id', '$property_id')";
    if ($conn->query($sql) === TRUE) {
        // Notify the seller via email (optional)
        $seller_sql = "SELECT email FROM users INNER JOIN properties ON users.id = properties.user_id WHERE properties.id = '$property_id'";
        $result = $conn->query($seller_sql);
        if ($result->num_rows > 0) {
            $seller = $result->fetch_assoc();
            $to = $seller['email'];
            $subject = "Someone is interested in your property";
            $message = "A buyer is interested in your property. Please log in to view the details.";
            $headers = "From: no-reply@rentify.com";

            mail($to, $subject, $message, $headers);
        }

        $response['status'] = 'success';
        $response['message'] = 'Interest registered successfully.';
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
