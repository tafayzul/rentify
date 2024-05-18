<?php
include('config/database.php');
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'seller') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];
    $area = $_POST['area'];
    $place = $_POST['place'];
    $hospitals_nearby = $_POST['hospitals_nearby'];
    $colleges_nearby = $_POST['colleges_nearby'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO properties (user_id, title, description, bedrooms, bathrooms, area, place, hospitals_nearby, colleges_nearby) VALUES ('$user_id', '$title', '$description', '$bedrooms', '$bathrooms', '$area', '$place', '$hospitals_nearby', '$colleges_nearby')";
    if ($conn->query($sql) === TRUE) {
        echo "Property added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Property</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <button><a href="dashboard.php">Dashboard</a></button>
        <h2>Add Property</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Bedrooms</label>
                <input type="number" name="bedrooms" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Bathrooms</label>
                <input type="number" name="bathrooms" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Area</label>
                <input type="text" name="area" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Place</label>
                <input type="text" name="place" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Hospitals Nearby</label>
                <input type="text" name="hospitals_nearby" class="form-control">
            </div>
            <div class="form-group">
                <label>Colleges Nearby</label>
                <input type="text" name="colleges_nearby" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Property</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
