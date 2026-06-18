<?php
session_start();

//checks if user is admin
include_once 'dbConection.php';
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

//conects to database
if (isset($_GET['id'])) {
    $reviewId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM review WHERE id = :id");
    $stmt->bindParam(':id', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch();

    if (!$review) {
        header('Location: admin-reviews.php');
        exit;
    }
} else {
    header('Location: admin-reviews.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Trip</title>
    <link rel="stylesheet" href="styles.css">
</head>

<!--The HTML to show/edit the comment and rating -->

<body>
    <?php include_once 'header.php'; ?>
    <main>
        <section class="margin">
            <h1>Edit review</h1>
            <section id="trip-edit-info" class="blue margin">
                <h2>Edit review information</h2>
                <form action="edit_review_process.php" method="POST">
                    <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                    <div>
                        <label for="description">comment:</label>
                        <textarea class="description" id="comment" name="comment"
                            required><?= htmlspecialchars($review['comment']) ?></textarea>
                    </div>
                    <div>
                        <label for="location">ratings:</label>
                        <input type="number" id="rating" name="rating"
                            value="<?= htmlspecialchars($review['rating']) ?>" required min="1" max="5">
                    </div>
                    <button type="submit">Update review</button>
                </form>
            </section>
        </section>
    </main>
</body>