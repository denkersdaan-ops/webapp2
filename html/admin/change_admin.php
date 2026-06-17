<?php
session_start();

include_once '../dbConection.php';

if (!isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
    header("location: index.php");
}

if (isset($_POST['user_id']) && isset($_POST['is_admin'])) {
    $stmt = $pdo->prepare('UPDATE user SET `admin` = :is_admin WHERE id = :user_id');
    $stmt->bindParam(":user_id", $_POST["user_id"]);

    $changeAdmin = $_POST['is_admin'] == true ? 0 : 1;
    $stmt->bindParam(":is_admin", $changeAdmin);

    $stmt->execute();
}

header("location: ../admin.php");
?>