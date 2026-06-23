<?php
session_start();
include_once 'dbConection.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: index.php'); // only index so it won't make a loop of admin sending you to admin.
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['review_comment'];
    $rating = $_POST['review_rating'];


    $stmt = $pdo->prepare("INSERT INTO review (title, rating, comment, post_date, trip_id, user_id VALUES (:title, :rating, :comment, :trip_id :user_id)");
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':trip_id', $trip_id);
    $stmt->bindParam(':post_date', $post_date);
    $stmt->execute();
}
    // $reviewId = $pdo->lastInsertId();
    // if (!empty($_FILES['trip_images']['tmp_name'])) {
    //     $tmpNames = is_array($_FILES['trip_images']['tmp_name'])
    //         ? $_FILES['trip_images']['tmp_name']
    //         : [$_FILES['trip_images']['tmp_name']];

    // foreach ($tmpNames as $tmpName) {
    //         if ($tmpName !== '' && is_uploaded_file($tmpName)) {
    //             mkdir('../images/' . $reviewId, 0777, true);

    //             $imageName = basename($tmpName);
    //             move_uploaded_file($tmpName, '../images/' . $reviewId . '/' . $imageName);


    //             $stmt = $pdo->prepare("INSERT INTO imagesTrip (trip_id, image) VALUES (:trip_id, :image)");
    //             $stmt->bindParam(':review_id', $reviewId, PDO::PARAM_INT);
    //             $stmt->bindParam(':image', $imageName, PDO::PARAM_STR);
    //             $stmt->execute();
    //         }
    //     }
    //}



header('Location: admin-reviews.php');
exit();
?>
