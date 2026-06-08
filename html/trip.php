<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


include_once 'dbConection.php';

if (!isset($_GET['trip']) || !is_numeric($_GET['trip'])) {
    die("Invalid trip ID.");
}

$tripId = (int) $_GET['trip'];

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
    <link
        href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include_once 'header.php'; ?>
<div><br></div>

    <div class=trip-image> 
    <img src="data:image/png;base64, <?php echo base64_encode($trip["frontImage"]) ?>" alt="frontImage">
</div>

<div><br></div>

<div class=blue> 
<br><?php echo($trip["description"]) ?> <br> <br> 
<br> <?php echo($trip["location"]) ?> <br> <br> <br> <?php echo($trip["price"]) ?> <br>
 <br> <br> 
</div>

<div><br>
<?php if(isset($_SESSION['user_id'])) {?>
<form action="add-review.php" class="rate" method="POST">
    <input type="hidden" name="trip_id" value="<?php echo $tripId ?>">
    <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>">
    <input type="text" name="review" placeholder="write review" required>
    <input type="radio" id="star5" name="rate" value="5" />
        <label for="star5" title="text">5 stars</label>
        <input type="radio" id="star4" name="rate" value="4" />
        <label for="star4" title="text">4 stars</label>
        <input type="radio" id="star3" name="rate" value="3" />
        <label for="star3" title="text">3 stars</label>
        <input type="radio" id="star2" name="rate" value="2" />
        <label for="star2" title="text">2 stars</label>
        <input type="radio" id="star1" name="rate" value="1" />
        <label for="star1" title="text">1 star</label>
    <input type="submit" value="add Review">
</form>
<?php } else{?>
    <p>need to be logged in to write a review</p>
<?php } ?>
</div>
<?php 
foreach ($reviews as $review){ 
?>
<div class=blue> 
<br> <br> <br> <br> <?php echo($review["comment"]) ?><br> <br> <br> <br> 
</div>
<br>
<?php 
}
?>


<div><br></div>
</body>

</html>