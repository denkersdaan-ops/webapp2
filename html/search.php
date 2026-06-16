<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        include_once 'header.php'; 
        include_once 'dbConection.php';
    ?>
    <main>
        <section id="search-main-layout">
            <h1>Search Results of : <?=isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?></h1>
            
            <?php
                $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

                if ($searchTerm == '') {
                    $sql = "SELECT * FROM trip";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                } else {
                    $sql = "SELECT * FROM trip WHERE title LIKE :term OR description LIKE :term";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['term' => "%{$searchTerm}%"]);
                }

                $result = $stmt->fetchAll();

                if (!$result) {
                    echo "<p>No items found.</p>";
                } else {
                    foreach ($result as $row) {
                    ?>
                        <a href="trip.php?trip=<?=$row['id'] ?>" class="search-result-item blue margin">
                            <img src="data:image/png;base64,<?= base64_encode($row['frontImage']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                            <div>
                                <h2><?= htmlspecialchars($row['title']) ?></h2>
                                <p><?= htmlspecialchars($row['description']) ?></p>
                            </div>
                        </a>
                <?php
                    }
                }
            ?>
        </section>
    </main>
</body>
</html>