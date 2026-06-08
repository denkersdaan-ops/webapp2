<?php 

session_start();
include_once '../dbConection.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if(isset($_GET['image_id'])) {
    $imageId = $_GET['image_id'];

    // Delete the image record from the database
    $stmt = $pdo->prepare("DELETE FROM imagesTrip WHERE id = :image_id");
    $stmt->bindParam(':image_id', $imageId, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: ../edit_trip.php?id=' . $_GET['trip_id']);
exit();

?>