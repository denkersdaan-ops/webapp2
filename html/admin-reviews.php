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
                    <input type="text" name="review_comment" placeholder="comment" required>
                    <input type="text" name="review_location" placeholder="Location" required>
                     <input type="number" id="review_rating" name="rating"
                            value="<?= htmlspecialchars($review['rating']) ?>" required min="1" max="5">
                    <input type="submit" value="Add Trip" class="yellow">
                    <input type="number" id="trip_id" name= "trip_id">
                    <input type="date" id="post_date" name="post_date">
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
            $reviews = $stmt->fetchAll();
            foreach ($reviews as $review) { ?>

                <div class="admin-trip blue margin">
                    <div>
                        <h2><?= htmlspecialchars($review['name']); ?></h2>
                        <p><?= htmlspecialchars($review['comment']); ?></p>
                    </div>
                    <div class="admin-btns">
                        <a href="edit_review.php?id=<?= $review['id']; ?>" class="admin-btn yellow">Edit</a>
                        <form action="admin/delete_review_process.php" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($review['id']) ?>">
                            <button type="submit" class="admin-btn yellow">delete</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </section>

    </main>

</body>