<?php
session_start();
include_once '../dbConection.php';
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tripId = $_POST['trip_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $start = $_POST['startdate'];
    $end = $_POST['enddate'];

    // Update the trip details
    $stmt = $pdo->prepare("UPDATE trip SET title = :title, description = :description, price = :price, period_start = :period_start, period_end = :period_end WHERE id = :trip_id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':period_start', $start);
    $stmt->bindParam(':period_end', $end);
    $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: ../edit_trip.php?id=' . $tripId);
exit();
?>