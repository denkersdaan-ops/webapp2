<?php
    session_start();


    include_once 'dbConection.php';

    if (!isset($_GET['trip']) || !is_numeric($_GET['trip'])) {
        die("Invalid trip ID.");
    }

    $tripId = (int)$_GET['trip'];

    $stmt = $pdo->prepare("SELECT * FROM trip WHERE id = :id");
    $stmt->execute(['id' => $tripId]);
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$trip) {
        header("Location: search.php?error=trip_not_found");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trip: <?= htmlspecialchars($trip['title']) ?></title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include_once 'header.php'; ?>

</body>
</html>