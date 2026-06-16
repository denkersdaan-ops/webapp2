<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include_once 'header.php'; ?>

    <?php
    if (isset($_GET['Policy'])) {
        ?>
        <div id="policy">
            <div class="text-area blue">
                <h2>Privacy Policy</h2>
                <p>This is the privacy policy content.</p>
                <p>this is some bs but i needed to make it so here it is. we will use your accound information to show you your past and upcoming trips. </p>
                <img src="images/cute_cat.jpg" alt="a picture of a cute cat to make you feel better about the fact that we are using your data for our project">
                <a href="aboutUs.php">Back to About Us</a>
            </div>
        </div>

        <?php
    }
    ?>

    <main>
        <section id="aboutus-main-layout">
            <section class="content">
                <div id="about-us-text" class="text-area blue margin">
                    <h1>About Us</h1>
                    <p>RijsBureau ROC is a modern travel agency built to showcase premium service, simple booking flow,
                        and memorable travel ideas. We specialize in making every customer feel supported with clear
                        travel packages, thoughtful advice, and a polished online presence. Whether clients are planning
                        a weekend trip or a longer adventure, our goal is to create an experience that feels
                        professional
                        and trustworthy.</p>
                    <p>Our team is dedicated to presenting reliable travel options through attractive destination
                        stories,
                        transparent pricing, and friendly customer care language. This page is designed to look and
                        sound like a real travel bureau, with a focus on strong visuals, confident wording, and a sense
                        of dependable expertise. For this school assignment, we make sure the About Us section looks
                        authentic and inviting to anyone browsing our site.</p>
                    <p>As a project for RijsBureau ROC, we show how a modern travel company can use clean design and
                        engaging content to communicate value. Visitors can expect clear information, a welcoming tone,
                        and a structured layout that reinforces the impression of a full-service agency.
                    </p>
                    <p>Randomly, we also highlight how our team keeps everything updated with travel news, seasonal
                        deals, and practical tips for smart packing. Our website emphasizes a customer-first approach,
                        even if it is part of a school assignment, by featuring polished visuals, useful travel advice,
                        and a friendly, professional voice.</p>

                    <p><strong>yes ai wrote this i'm not writing a hole text for this project</strong></p>
                </div>
            </section>
            <aside id="about-us-image" class="margin yellow">
                <img src="images/scroll-images/afbeelding3.png" alt="">
            </aside>
        </section>
    </main>
    <footer class="blue">
        <a href="contect.php">Contact Us</a>
        <a href="tel:31123456789">31 123456789</a>
        <form action="aboutUs.php" method="get">
            <button type="submit" name="Policy" value="true">Privacy Policy</button>
        </form>
    </footer>
</body>

</html>