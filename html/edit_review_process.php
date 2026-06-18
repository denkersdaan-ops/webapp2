<?php
session_start();
include_once 'dbConection.php';
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}


if (isset($_POST['comment']) || isset($_POST['rating'])) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $reviewId = $_POST['review_id'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];

        $stmt = $pdo->prepare("UPDATE review SET comment = :comment, rating = :rating WHERE id = :review_id");
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_id', $reviewId);
        $stmt->execute();
    }


}

// $stmt = $pdo->prepare("UPDATE review SET comment = :comment, rating = :rating, post_date = :post_date WHERE id = :review_id");
//     $stmt->bindParam(':comment', $comment);
//     $stmt->bindParam(':rating', $rating);
//     $stmt->bindParam(':review_id', $review_id);
//     $stmt->execute();

header('Location: edit_review.php');
exit;
?>