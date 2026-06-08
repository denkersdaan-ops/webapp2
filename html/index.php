<?php
session_start();
include_once 'dbConection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReisBureau ROC</title>
    <link rel="stylesheet" href="styles.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bitcount:wght@100..900&family=DynaPuff:wght@400..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body id="homepage-body">
    <?php include_once 'header.php'; ?>

    <main>
        <section id="base-main-layout">
            <section class="content">
                <div class="text-area">
                    <h1>Welcome to our website!</h1>
                    <p>At ReisBureau ROC we help travelers discover great trips with professional planning, clear
                        offers,
                        and friendly support. Our site is designed to look and feel like a real travel agency, with easy
                        booking options and a welcoming presentation that builds trust from the first visit.
                    </p>
                    <p>We showcase attractive destinations, thoughtful travel guidance, and customer-oriented service
                        language so the page feels polished and credible. Even though this is a school project, our goal
                        is to present a convincing travel bureau image for visitors and evaluators alike.
                    </p>
                </div>

                <section class="carousel-section">
                    <div class="carousel">
                        <div class="carousel-layout">
                            <div class="slide position-left2" data-pos="left2">
                                <a href="#"><img src="images/scroll-images/Afbeelding4.png" alt="Ghost left far"></a>
                            </div>
                            <div class="slide position-left" data-pos="left">
                                <a href="#"><img src="images/scroll-images/Afbeelding5.png" alt="Ghost left"></a>
                            </div>
                            <div class="slide position-center" data-pos="center">
                                <a href="#"><img src="images/scroll-images/Afbeelding3.png" alt="Main image"></a>
                            </div>
                            <div class="slide position-right" data-pos="right">
                                <a href="#"><img src="images/scroll-images/Afbeelding4.png" alt="Ghost right"></a>
                            </div>
                            <div class="slide position-right2" data-pos="right2">
                                <a href="#"><img src="images/scroll-images/Afbeelding5.png" alt="Ghost right far"></a>
                            </div>
                        </div>
                        <button class="prev-btn">&lt;</button>
                        <button class="next-btn">&gt;</button>
                    </div>
                </section>
            </section>
            <aside id="home-page-aside" class="yellow">
                <h2>Recent Posts</h2>
                <ul>
                    <li><a href="#">Post 1</a></li>
                    <li><a href="#">Post 2</a></li>
                    <li><a href="#">Post 3</a></li>
                </ul>

            </aside>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = [
                // PHP code to fetch images from the database and generate the slides array 
                <?php
                $stmt = $pdo->query("SELECT * FROM trip ORDER BY bought DESC LIMIT 10");
                $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!$stmt) {
                    $error = $pdo->errorInfo();
                    die("Query error: " . $error[2]);
                }

                foreach ($trips as $trip) {
                    echo "{ id: " . (int) $trip['id'] . ", src: 'data:image/png;base64," . base64_encode($trip['frontImage']) . "', alt: '" . addslashes($trip['title']) . "' },";
                }
                ?>
            ];

            // index and animations

            let currentIndex = 0;
            let autoRotate = null;

            const wrappers = [
                document.querySelector('[data-pos="left2"]'),
                document.querySelector('[data-pos="left"]'),
                document.querySelector('[data-pos="center"]'),
                document.querySelector('[data-pos="right"]'),
                document.querySelector('[data-pos="right2"]'),
            ];

            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');

            const positionClasses = [
                'position-left2',
                'position-left',
                'position-center',
                'position-right',
                'position-right2',
            ];
            // smoothly wrap index around the slides array
            function wrapIndex(index) {
                const len = slides.length;
                return ((index % len) + len) % len;
            }

            function assignPositionClasses() {
                wrappers.forEach((wrapper, idx) => {
                    wrapper.classList.remove(...positionClasses);
                    wrapper.classList.add(positionClasses[idx]);
                });
            }
            // Update carousel images and links based on current index
            function updateCarousel(index) {
                currentIndex = wrapIndex(index);
                assignPositionClasses();

                const indexMap = [
                    wrapIndex(currentIndex - 2),
                    wrapIndex(currentIndex - 1),
                    currentIndex,
                    wrapIndex(currentIndex + 1),
                    wrapIndex(currentIndex + 2),
                ];

                wrappers.forEach((wrapper, idx) => {
                    const slide = slides[indexMap[idx]];
                    const img = wrapper.querySelector('img');
                    const link = wrapper.querySelector('a');
                    img.src = slide.src;
                    img.alt = slide.alt;
                    if (link) {
                        link.href = `trip.php?trip=${slide.id}`;
                    }
                });
            }
            // Navigation functions
            function nextSlide() {
                wrappers.push(wrappers.shift());
                updateCarousel(currentIndex + 1);
            }

            function prevSlide() {
                wrappers.unshift(wrappers.pop());
                updateCarousel(currentIndex - 1);
            }

            function startAutoRotate() {
                if (autoRotate) clearInterval(autoRotate);
                autoRotate = setInterval(nextSlide, 4200);
            }

            function resetAutoRotate() {
                startAutoRotate();
            }

            prevBtn.addEventListener('click', function () {
                prevSlide();
                resetAutoRotate();
            });

            nextBtn.addEventListener('click', function () {
                nextSlide();
                resetAutoRotate();
            });

            updateCarousel(currentIndex);
            startAutoRotate();
        });
    </script>
</body>

</html>