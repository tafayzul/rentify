<?php
include('config/database.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

// Fetch properties for the logged-in seller
if ($user_type == 'seller') {
    $sql = "SELECT * FROM properties WHERE user_id = $user_id";
} else {
    $sql = "SELECT * FROM properties";
}
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <a href="logout.php" class="btn btn-danger float-right">Logout</a>
        <?php if ($user_type == 'seller'): ?>
            <a href="add_property.php" class="btn btn-primary">Add Property</a>
            <h3>Your Properties</h3>
        <?php else: ?>
            <h3>Available Properties</h3>
        <?php endif; ?>

        <?php while($row = $result->fetch_assoc()): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= $row['title'] ?></h5>
                <p class="card-text"><?= $row['description'] ?></p>
                <p class="card-text"><strong>Bedrooms:</strong> <?= $row['bedrooms'] ?></p>
                <p class="card-text"><strong>Bathrooms:</strong> <?= $row['bathrooms'] ?></p>
                <p class="card-text"><strong>Area:</strong> <?= $row['area'] ?></p>
                <p class="card-text"><strong>Place:</strong> <?= $row['place'] ?></p>
                <p class="card-text"><strong>Hospitals Nearby:</strong> <?= $row['hospitals_nearby'] ?></p>
                <p class="card-text"><strong>Colleges Nearby:</strong> <?= $row['colleges_nearby'] ?></p>
                <span><strong>Likes:</strong> <?= $row['likes'] ?></span>

                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'buyer'): ?>
    <button class="btn btn-secondary" onclick="likeProperty(<?= $row['id'] ?>)">Like</button>
    <button class="btn btn-primary" onclick="interested(<?= $row['id'] ?>)">I'm Interested</button>
<?php endif; ?>

            </div>

          

        </div>
        <?php endwhile; ?>
    </div>

    <script src="js/jquery.min.js"></script>
    <script>
        function likeProperty(property_id) {
            <?php if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'buyer'): ?>
                window.location.href = 'login_register.php';
            <?php else: ?>
                $.post('like_property.php', { property_id: property_id }, function(data) {
                    alert(data.message);
                }, 'json');
            <?php endif; ?>
        }

        function interested(property_id) {
            <?php if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'buyer'): ?>
                window.location.href = 'login_register.php';
            <?php else: ?>
                $.post('interested.php', { property_id: property_id }, function(data) {
                    alert(data.message);
                }, 'json');
            <?php endif; ?>
        }
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
