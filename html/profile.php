<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '../index.php'));
    exit();
}

include_once 'dbConection.php';

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
$stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile: <?= isset($user['name']) ? htmlspecialchars($user['name']) : 'User' ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include_once 'header.php';
    ?>
    <main>
        <h1>Profile Page</h1>
        <p>Welcome to your profile page! Here you can view and manage your account details, bookings, and preferences.
            This page is designed to provide you with easy access to all the information related to your interactions
            with our travel agency. Whether you want to update your personal information, review past trips, or explore
            new travel options, everything is conveniently organized for you here.</p>
    </main>
</body>

</html>