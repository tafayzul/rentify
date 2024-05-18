<?php
include('config/database.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type']; // Retrieve user type from the session

$limit = 10;  // Number of entries to show in a page
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $limit;

$sql = "SELECT * FROM properties LIMIT $start_from, $limit";
$result = $conn->query($sql);

// Total pages
$sql_total = "SELECT COUNT(id) FROM properties";
$total_records = $conn->query($sql_total)->fetch_array()[0];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Properties</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Available Properties</h2>
        <p>You are logged in as a <strong><?php echo $user_type; ?></strong>.</p>
        <?php while ($row = $result->fetch_assoc()): ?>
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

                <?php if ($user_type == 'buyer'): ?>
                    <button class="btn btn-primary" onclick="interested(<?= $row['id'] ?>)">I'm Interested</button>
                    <button class="btn btn-secondary" onclick="likeProperty(<?= $row['id'] ?>)">Like</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item"><a class="page-link" href="view_properties.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function interested(property_id) {
            $.post('interested.php', { property_id: property_id }, function(data) {
                alert(data.message);
            }, 'json');
        }

        function likeProperty(property_id) {
            $.post('like.php', { property_id: property_id }, function(data) {
                alert(data.message);
                location.reload(); // Refresh the page to update like count
            }, 'json');
        }
    </script>
</body>
</html>
