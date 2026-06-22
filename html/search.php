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
    <link
        href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php
    include_once 'header.php';
    include_once 'dbConection.php';
    ?>
    <main>
        <section id="search-main-layout">
            <div id="search-top" class="margin">
                <h1>Search Results of : <?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?></h1>
                <?php if (isset($_SESSION["user_id"])) { ?>
                    <button id="shoping-cart" onclick="buttonFiew()">shoping cart</button>
                    <form action="add-booking.php" method="POST">
                        <input id="input-ids" type="hidden" name="ids">
                        <input type="hidden" name="user_id" value="<?= $_SESSION["user_id"] ?>">
                        <button type="submit" id="add-bookings-btn" class="hidden-result">add bookings</button>
                    </form>
                <?php } ?>
            </div>
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
                    if (isset($_SESSION['user_id'])) {
                        $stmt = $pdo->prepare('SELECT trip_id FROM booking WHERE user_id = :user_id AND trip_id = :trip_id');
                        $stmt->execute(['user_id' => $_SESSION['user_id'] , 'trip_id' => $row['id']]);
                        $bookings = $stmt->fetchColumn();
                    }
                    ?>
                    <div id="<?= htmlspecialchars($row['id']); ?>" class="search-result-item blue margin">
                        <a href="trip.php?trip=<?= $row['id'] ?>">
                            <img src="data:image/png;base64,<?= base64_encode($row['frontImage']) ?>"
                                alt="<?= htmlspecialchars($row['title']) ?>">
                            <div>
                                <h2><?= htmlspecialchars($row['title']) ?></h2>
                                <p><?= htmlspecialchars($row['description']) ?></p>
                            </div>
                        </a>
                        <?php if (isset($_SESSION["user_id"]) &&  $bookings == '') { ?>
                            <button type="button" class="add-btn"
                                onclick="shopingCart(<?= htmlspecialchars($row['id']) ?>)">+</button>
                        <?php } ?>
                    </div>
                    <?php
                }
            }
            ?>
        </section>
    </main>
</body>

<script>
    let shopingCartAry = [];

    let hidden = false;

    const cartBtn = document.getElementById("shoping-cart");
    const addBtn = document.querySelectorAll(".add-btn");

    function shopingCart(id) {
        if (hidden == true) {
            return;
        }
        const idx = shopingCartAry.indexOf('' + id);
        if (idx === -1) {
            shopingCartAry.push('' + id);
        } else {
            shopingCartAry.splice(idx, 1);
        }

        console.log(shopingCartAry);

        if (cartBtn) {
            cartBtn.innerHTML = "shoping cart" + (shopingCartAry.length === 0 ? '' : '+' + shopingCartAry.length);
        }
    }

    function buttonFiew() {
        elements = document.querySelectorAll(".search-result-item");
        if (shopingCartAry.length != 0) {

            if (hidden) {
                hidden = false;

                elements.forEach(element => {
                    element.classList.remove("hidden-result")
                    addBtn.forEach(btn => btn.classList.remove("hidden-result"));
                });

                document.getElementById("add-bookings-btn").classList.add("hidden-result");

            } else {
                hidden = true;

                document.getElementById("input-ids").value = shopingCartAry;

                elements.forEach(element => {
                    console.log(shopingCartAry.includes(element.id));

                    if (!shopingCartAry.includes(element.id)) {
                        element.classList.add("hidden-result");
                    } else {
                        element.classList.remove("hidden-result")
                        addBtn.forEach(btn => btn.classList.add("hidden-result"));
                    }
                });
                document.getElementById("add-bookings-btn").classList.remove("hidden-result");
            }
        }
    }



</script>

</html>