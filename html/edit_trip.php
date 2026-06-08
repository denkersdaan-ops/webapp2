<?php
session_start();
include_once 'dbConection.php';
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header('Location: index.php'); // only index so it won't make a loop of admin sending u to admin.
    exit;
}

if (isset($_GET['id'])) {
    $tripId = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM trip WHERE id = :id");
    $stmt->bindParam(':id', $tripId, PDO::PARAM_INT);
    $stmt->execute();
    $trip = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$trip) {
        header('Location: admin.php');
        exit;
    }
} else {
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Trip</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include_once 'header.php'; ?>
    <main>
        <section class="margin">
            <h1>Edit trip</h1>
            <section id="trip-edit-info" class="blue margin">
                <h2>Edit trip information</h2>
                <form action="admin/update_trip.php" method="POST">
                    <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($trip['title']) ?>"
                            required>
                    </div>
                    <div>
                        <label for="description">Description:</label>
                        <textarea class="description" id="description" name="description"
                            required><?= htmlspecialchars($trip['description']) ?></textarea>
                    </div>
                    <div>
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location"
                            value="<?= htmlspecialchars($trip['location']) ?>" required>
                    </div>
                    <div>
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" value="<?= htmlspecialchars($trip['price']) ?>"
                            step="0.01" required>
                    </div>
                    <div>
                        <label for="startdate">Start Date:</label>
                        <input type="date" id="startdate" name="startdate"
                            value="<?= htmlspecialchars($trip['period_start']) ?>" required>
                    </div>
                    <div>
                        <label for="enddate">End Date:</label>
                        <input type="date" id="enddate" name="enddate" value="<?= htmlspecialchars($trip['period_end']) ?>"
                            required>
                    </div>
                    <button type="submit">Update Trip</button>
                </form>
            </section>
            <section id="trip-edit-images" class="blue margin">
                <h2>Edit images</h2>

                <form action="admin/update_images.php" method="POST" enctype="multipart/form-data">
                    <div>
                        <input type="hidden" name="trip_id" value="<?= $trip['id'] ?>">
                        <label>Current Front Image:</label><br>
                        <img src="data:image/png;base64,<?= base64_encode($trip['frontImage']) ?>"
                            alt="Front Image"><br><br>
                        <label for="new_front_image">Upload New Front Image:</label>
                        <input type="file" id="new_front_image" name="new_front_image" accept="image/*">
                    </div>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM imagesTrip WHERE trip_id = :trip_id");
                    $stmt->bindParam(':trip_id', $tripId, PDO::PARAM_INT);
                    $stmt->execute();
                    $imagesList = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (empty($imagesList)) {
                        echo "<p>No additional images for this trip.</p>";
                    } else {
                        ?>
                        <h3>Current Additional Images:</h3>
                        <div class='additional-images yellow'>
                            <?php
                            foreach ($imagesList as $image) { ?>
                                <div class="image-card blue">
                                    <img src="data:image/png;base64,<?= base64_encode($image['image']) ?>" alt="Trip Image">
                                    <a href="admin/delete_image.php?image_id=<?= $image['id'] ?>&trip_id=<?= $trip['id'] ?>"
                                        class="yellow"
                                        onclick="return confirm('Are you sure you want to delete this image?');">Delete</a>
                                </div>
                            <?php }
                    } ?>
                    </div>

                    <label for="new_images">Upload New Images:</label>
                    <input type="file" id="new_images" name="new_images[]" accept="image/*" multiple>
                    <button type="submit">Upload New Images</button>
                </form>
            </section>
        </section>
    </main>


</body>

</html>