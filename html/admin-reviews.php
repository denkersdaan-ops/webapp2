<?php 
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'index.php'));
    exit();
}
include_once 'dbConection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body> 
<?php include 'header.php'; ?>

<main class="margin">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin dashboard for reviews. you can add, edit, and delete reviews.</p>

        <ul id="links">
            <li><a href="#reviews">Reviews</a></li>
        </ul>

        <section id="reviews">
            <h2>reviews</h2>
            <?php
            if (isset($_GET['add_review']) && $_GET['add_review'] == 'true') {
                ?>
                <form id="add_form" class="blue" action="admin/add_trip_process.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="text" name="review_title" placeholder="Review Title" required>
                    <input type="text" name="trip_description" placeholder="Trip Description" required>
                    <input type="text" name="trip_location" placeholder="Location" required>
                    <input type="number" name="trip_price" step="0.01" placeholder="Price" required>
                    <input type="text" name="trip_startdate" placeholder="Start Date (YYYY-MM-DD)" required>
                    <input type="text" name="trip_enddate" placeholder="End Date (YYYY-MM-DD)" required>
                    <input type="file" name="trip_frontimage" accept="image/*" required>
                    <input type="file" name="trip_images" accept="image/*" multiple>
                    <input type="submit" value="Add Trip" class="yellow">
                </form>
                <?php
            } else {
                ?>
                <form action="admin.php" method="GET">
                    <input type="hidden" name="add_trip" value="true">
                    <input type="submit" value="Add Review" class="yellow">
                </form>

                 <?php
            }
            ?>

            <?php
        $stmt = $pdo->query("SELECT * FROM review");
        $review = $stmt->fetchAll();
        foreach ($review as $reviews) { ?>
            <div class="admin-trip blue margin">
                <div>
                    <!-- <h2><?= htmlspecialchars($reviews['title']); ?></h2>
                    <p><?= htmlspecialchars($reviews['description']); ?></p> -->
                </div>
                <div class="admin-btns">
                    <a href="edit_review.php?id=<?= $reviews['id']; ?>" class="admin-btn yellow">Edit</a>
                    <a href="admin/delete_review_process.php?review_id=<?= $reviews['id']; ?>" class="admin-btn yellow" onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                </div>
            </div>
            <?php } ?>
        </section>
</body> 