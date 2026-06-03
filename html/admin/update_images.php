<?php
session_start();
include_once '../dbConection.php';
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tripId = $_POST['trip_id'];
    if (isset($_FILES['new_front_image']) && $_FILES['new_front_image']['error'] === UPLOAD_ERR_OK) {
        $newFrontImage = file_get_contents($_FILES['new_front_image']['tmp_name']);
        // Update the front image in the database
        $stmt = $pdo->prepare("UPDATE trip SET frontImage = :front_image WHERE id = :trip_id");
        $stmt->bindParam(':front_image', $newFrontImage, PDO::PARAM_LOB);
        $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
        $stmt->execute();
    }

    if (isset($_FILES['new_images']) && !empty($_FILES['new_images']['tmp_name'][0])) {
        $tmpNames = is_array($_FILES['new_images']['tmp_name'])
            ? $_FILES['new_images']['tmp_name']
            : [$_FILES['new_images']['tmp_name']];

        foreach ($tmpNames as $tmpName) {
            if ($tmpName !== '' && is_uploaded_file($tmpName)) {
                $imageData = file_get_contents($tmpName);
                $stmt = $pdo->prepare("INSERT INTO imagesTrip (trip_id, image) VALUES (:trip_id, :image)");
                $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
                $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
                $stmt->execute();
            }
        }
    }
}

header('Location: ../edit_trip.php?id=' . $tripId);
exit();

?>