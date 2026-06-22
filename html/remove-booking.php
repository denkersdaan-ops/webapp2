<?php
session_start();

include_once 'dbConection.php';

if (isset($_POST['booking-id'])) {
    $stmt = $pdo->prepare("SELECT user_id FROM booking WHERE id = :id");
    $stmt->bindParam(":id", $_POST['booking-id']);
    $stmt->execute();
    $user_id = $stmt->fetchColumn();


    if ($user_id == $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM booking WHERE id = :id");
        $stmt->bindParam(":id", $_POST['booking-id']);
        $stmt->execute();
    }
}

header("location: profile.php");
?>