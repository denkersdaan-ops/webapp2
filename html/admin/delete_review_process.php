<?php
session_start();
include_once '../dbConection.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if (isset($_POST['id'])) {
    $reviewId = $_POST['id'];

    //   delete the trip. 
    $stmt = $pdo->prepare("DELETE FROM review WHERE id = :review_id");
    $stmt->bindParam(':review_id', $reviewId);
    $stmt->execute();
}

header('Location: ../edit_review.php');
exit();
?>