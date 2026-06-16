<?php
session_start();
include_once '../dbConection.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ../index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['trip_title'];
    $description = $_POST['trip_description'];
    $location = $_POST['trip_location'];
    $price = $_POST['trip_price'];
    $startdate = $_POST['trip_startdate'];
    $enddate = $_POST['trip_enddate'];

    // Handle image uploads
    $frontimage = $_FILES['trip_frontimage']['name'];
    $images = $_FILES['trip_images']['name'];
    $frontimageData = file_get_contents($_FILES['trip_frontimage']['tmp_name']);

    // Insert trip into database
    $stmt = $pdo->prepare("INSERT INTO trip (title, description, location, price, period_start, period_end, frontimage) VALUES (:title, :description, :location, :price, :startdate, :enddate, :frontimage)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':startdate', $startdate);
    $stmt->bindParam(':enddate', $enddate);
    $stmt->bindParam(':frontimage', $frontimageData, PDO::PARAM_LOB);
    $stmt->execute();

    $tripId = $pdo->lastInsertId();
    if (!empty($_FILES['trip_images']['tmp_name'])) {
        $tmpNames = is_array($_FILES['trip_images']['tmp_name'])
            ? $_FILES['trip_images']['tmp_name']
            : [$_FILES['trip_images']['tmp_name']];

        foreach ($tmpNames as $tmpName) {
            if ($tmpName !== '' && is_uploaded_file($tmpName)) {
                mkdir('../images/' . $tripId, 0777, true);

                $imageName = basename($tmpName);
                move_uploaded_file($tmpName, '../images/' . $tripId . '/' . $imageName);

                
                $stmt = $pdo->prepare("INSERT INTO imagesTrip (trip_id, image) VALUES (:trip_id, :image)");
                $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
                $stmt->bindParam(':image', $imageName, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

}

header('Location: ../admin.php');
exit();
?>