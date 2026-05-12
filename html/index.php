<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="homepage-body">
    <?php include_once 'header.php'; ?>
    <main id="homepage-main">
        <section id="homepage-main-layout">
            <section class="content">
                <h1>Welcome to our website!</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel sapien eget nunc varius commodo.
                    Sed at ligula a nunc efficitur bibendum. Curabitur ac odio a enim efficitur tincidunt. Proin in
                    ligula ut nisl fermentum bibendum. Nulla facilisi. Donec ut velit nec nisi efficitur convallis.
                    Maecenas ac felis id enim efficitur tincidunt.</p>



                <section class="carousel-section">
                    <h2>Image Carousel</h2>
                    <div class="carousel">
                        <div class="carousel-layout">
                            <div class="slide position-left2" data-pos="left2">
                                <img src="images/scroll-images/Afbeelding4.png" alt="Ghost left far">
                            </div>
                            <div class="slide position-left" data-pos="left">
                                <img src="images/scroll-images/Afbeelding5.png" alt="Ghost left">
                            </div>
                            <div class="slide position-center" data-pos="center">
                                <img src="images/scroll-images/Afbeelding3.png" alt="Main image">
                            </div>
                            <div class="slide position-right" data-pos="right">
                                <img src="images/scroll-images/Afbeelding4.png" alt="Ghost right">
                            </div>
                            <div class="slide position-right2" data-pos="right2">
                                <img src="images/scroll-images/Afbeelding5.png" alt="Ghost right far">
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
                { src: 'images/scroll-images/Afbeelding3.png', alt: 'Image 3' },
                { src: 'images/scroll-images/Afbeelding4.png', alt: 'Image 4' },
                { src: 'images/scroll-images/Afbeelding5.png', alt: 'Image 5' },
            ];

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
                    img.src = slide.src;
                    img.alt = slide.alt;
                });
            }

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