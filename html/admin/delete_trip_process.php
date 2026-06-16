<?php
session_start();
include_once '../dbConection.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $tripId = $_GET['trip_id'];

    // Delete associated images first
    $stmt = $pdo->prepare("DELETE FROM imagesTrip WHERE trip_id = :trip_id");
    $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
    $stmt->execute();

    if(file_exists('../images/' . $tripId)) {
        rmdir('../images/' . $tripId); // remove the directory
    }

    // Then delete the trip
    $stmt = $pdo->prepare("DELETE FROM trip WHERE id = :trip_id");
    $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: ../admin.php');
exit();
?>

