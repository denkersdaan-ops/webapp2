<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
    header('Location: ' . (isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'index.php'));
    exit();
}
include_once 'dbConection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="margin">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin dashboard. you can add, edit, and delete trips.</p>

        <ul id="links">
            <li><a href="#trips">Trips</a></li>
            <li><a href="#users">User</a></li>
            <li><a href="#bookings">Booked items</a></li>
        </ul>


        <section id="trips">
            <h2>trips</h2>
            <?php
            if (isset($_GET['add_trip']) && $_GET['add_trip'] == 'true') {
                ?>
                <form id="add_form" class="blue" action="admin/add_trip_process.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="text" name="trip_title" placeholder="Trip Title" required>
                    <input type="text" name="trip_description" placeholder="Trip Description" required>
                    <input type="text" name="trip_location" placeholder="Location" required>
                    <input type="number" name="trip_price" step="0.01" placeholder="Price" required>
                    <input type="text" name="trip_startdate" placeholder="Start Date (YYYY-MM-DD)" required>
                    <input type="text" name="trip_enddate" placeholder="End Date (YYYY-MM-DD)" required>
                    <input type="file" name="trip_frontimage" accept="image/*" required>
                    <input type="file" name="trip_images" accept="image/*" multiple>
                    <input type="submit" value="Add Trip" class="yellow">
                </form>
                <?php
            } else {
                ?>
                <form action="admin.php" method="GET">
                    <input type="hidden" name="add_trip" value="true">
                    <input type="submit" value="Add Trip" class="yellow">
                </form>
                <?php
            }
            ?>

        <?php
        $stmt = $pdo->query("SELECT * FROM trip");
        $trips = $stmt->fetchAll();
        foreach ($trips as $trip) { ?>
            <div class="admin-trip blue margin">
                <div>
                    <h2><?= htmlspecialchars($trip['title']); ?></h2>
                    <p><?= htmlspecialchars($trip['description']); ?></p>
                </div>
                <div class="admin-btns">
                    <a href="edit_trip.php?id=<?= $trip['id']; ?>" class="admin-btn yellow">Edit</a>
                    <a href="admin/delete_trip_process.php?trip_id=<?= $trip['id']; ?>" class="admin-btn yellow" onclick="return confirm('Are you sure you want to delete this trip?');">Delete</a>
                </div>
            </div>
            <?php } ?>
        </section>

        <section id="users">
            <h3>users</h3>
            <?php
            $stmt = $pdo->query("SELECT * FROM user");
            $users = $stmt->fetchAll();

            foreach($users as $user){
            ?>
            <div class="user_card blue">
                <h3><?= htmlspecialchars($user['name']) ?></h3>
                <h4><?= $user['admin'] ? "Admin" : "User";?></h4>
            </div>
            <?php } ?>
        </section>

        <section id="bookings">
            <h3>bookings</h3>
            <?php
            // left join because i don't wan't to see all the trip only the ones in bookings
            $stmt = $pdo->query("SELECT trip.title, COUNT(booking.id) as user_count FROM booking left JOIN trip on booking.trip_id = trip.id GROUP BY booking.trip_id, trip.title ORDER BY booking.trip_id");
            $bookings = $stmt->fetchAll();

            foreach($bookings as $booking){
            ?>
            <div class="user_card blue">
                <h3><?= htmlspecialchars($booking['title']) ?></h3>
                <h4>Users booked: <?= htmlspecialchars($booking['user_count']) ?></h4>
            </div>
            <?php } ?>
        </section>
    </main>
</body>

</html>