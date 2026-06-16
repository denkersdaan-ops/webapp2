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
        <section class="margin">
            <h1><?= "Hello, " . (isset($user['name']) ? htmlspecialchars($user['name']) : 'User') ?></h1>
            <p>Welcome to your profile page! Here you can view and manage your account details and bookings.
                This page is designed to provide you with easy access to all the information related to your
                interactions
                with our travel agency. Whether you want to update your personal information, review past trips, or
                explore
                new travel options, everything is conveniently organized for you here.</p>
            <ul>
                <li>
                    <a href="#bookingen" class="yellow">My Bookings</a>
                </li>
            </ul>
        </section>

        <section id="bookingen" class="margin">
            <h2>My Bookings</h2>
            <p>Here you can view and manage your upcoming and past bookings.</p>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM booking WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->execute();
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($bookings as $booking) {
                $tripstmt = $pdo->prepare("SELECT * FROM trip WHERE id = :trip_id");
                $tripstmt->bindParam(':trip_id', $booking['trip_id'], PDO::PARAM_INT);
                $tripstmt->execute();
                $trip = $tripstmt->fetch(PDO::FETCH_ASSOC);

                ?>
                <a href="trip.php?trip=<?= $trip['id'] ?>" class="booking-item blue">
                    <img src="data:image/png;base64,<?= base64_encode($trip['frontImage']) ?>"
                        alt="<?= htmlspecialchars($trip['title']) ?>">
                    <div>
                        <h3><?= htmlspecialchars($trip['title']) ?></h3>
                        <p>Booking Date: <?= htmlspecialchars($booking['trip_start']) ?> to
                            <?= htmlspecialchars($booking['trip_end']) ?>
                        </p>
                        <p><?= htmlspecialchars($trip['description']) ?></p>
                    </div>

                    <form action="remove-booking.php" method="POST">
                        <input type="hidden" name="booking-id" value="<?= $booking['id']?>">
                        <button id="cancel-btn">Cancel</button>
                    </form>
                </a>
                <?php
            }
            ?>
        </section>
    </main>
</body>

</html>