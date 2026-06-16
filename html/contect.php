<?php
session_start();

if (isset($_POST['mail']) && isset($_POST['subject']) && isset($_POST['text'])) {
    mail("Who_Ask_Box_54321@gmail.com", $_POST['subject'], $_POST['text'], 'From:' . $_POST['mail']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contect</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include_once "header.php"; ?>
    <main>
        <h2>dit werked niet omdat de php mail() function niet op dockers local host werked</h2>
        <div id="mail" class="blue">
            <form action="contect.php" method="POST">
                <input type="email" name="mail" class="yellow" required placeholder="your@gmail.com">
                <input type="text" name="subject" class="yellow" required placeholder="subject">
                <textarea class="yellow" name="text" required></textarea>
                <button class="yellow" type="submit">Send</button>
            </form>
        </div>
    </main>
</body>

</html>