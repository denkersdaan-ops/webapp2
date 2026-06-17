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
                <form id="add_form" class="blue" action="admin/add_review_process.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="text" name="review_description" placeholder="Review Description" required>
                    <input type="text" name="review_location" placeholder="Location" required>
                    <input type="file" name="review_rating" placeholder="rating" required>
                    <input type="submit" value="Add Trip" class="yellow">
                </form>
                <?php
            } else {
                ?>
                <form action="admin-reviews.php" method="GET">
                    <input type="hidden" name="add_review" value="true">
                    <input type="submit" value="Add Review" class="yellow">
                </form>

                <?php
            }
            ?>
        </section>
        <section id="reviews-list">
            <?php
            //Mixt de review database-sectie met user. Waardoor de username/gebruikersnaam ingevoegd kan worden. 
            //LEFT JOIN wordt gebruikt omdat er maar een klein deel van user (rechts) naar review (links) moet.
            $stmt = $pdo->query("SELECT review.id, review.rating, review.comment, user.name FROM review LEFT JOIN user on review.user_id=user.id");
            $review = $stmt->fetchAll();
            foreach ($review as $reviews) { ?>

                <div class="admin-trip blue margin">
                    <div>
                        <h2><?= htmlspecialchars($reviews['name']); ?></h2>
                        <p><?= htmlspecialchars($reviews['comment']); ?></p>
                    </div>
                    <div class="admin-btns">
                        <a href="edit_review.php?id=<?= $reviews['id']; ?>" class="admin-btn yellow">Edit</a>
                        <a href="admin/delete_review_process.php?review_id=<?= $reviews['id']; ?>" class="admin-btn yellow"
                            onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                    </div>
                </div>
            <?php } ?>
        </section>

         </main>

</body>