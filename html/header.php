<header class="blue">
    <a href="index.php"><img src="images/logo.jpg" alt="Logo" class="main-logo"></a>
    <!-- search form -->
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="search" id="search-input" class="yellow" placeholder="Search...">
        <!-- hidden submit button for accessibility and to allow form submission with Enter key -->
        <button type="submit" id="search-btn" hidden>Search</button>
    </form>
    <nav>
        <ul id="main-buttons">
            <li><a href="search.php" class="yellow">Search</a></li>
            <li><a href="aboutUs.php" class="yellow">About</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<li><a id="logout-link" href="auth/logout.php" class="yellow">Logout</a></li>';
            } else {
                echo '<li><a id="login-link" href="#" class="yellow">Login</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<!-- Login modal structure (hidden by default) -->
<div id="login-modal" class="modal hidden" aria-hidden="true">
    <div class="modal-overlay" id="login-modal-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="login-modal-title">
        <button type="button" class="modal-close" id="login-modal-close" aria-label="Close login form">×</button>
        <h2 id="login-modal-title">Login</h2>
        <form action="auth/login.php" method="post" class="login-form">
            <input type="hidden" name="redirect" value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" placeholder="you@example.com" required>
            <label for="login-password">Password</label>
            <input type="password" id="login-password" name="password" placeholder="Password" required>
            <button type="submit" class="yellow">Sign In</button>
        </form>
        <p class="login-message" id="login-message"></p>
        <p class="login-register-link">Don't have an account? <a href="#" id="register-link">Register here</a></p>
    </div>
</div>

<!-- no submit button needed only hit enter to submit the form -->
<div id="register-modal" class="modal hidden" aria-hidden="true">
    <div class="modal-overlay" id="register-modal-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="register-modal-title">
        <button type="button" class="modal-close" id="register-modal-close" aria-label="Close register form">×</button>
        <h2 id="register-modal-title">Register</h2>
        <form action="auth/register.php" method="post" class="register-form">
            <label for="register-email">Email</label>
            <input type="email" id="register-email" name="email" placeholder="you@example.com" required>
            <label for="register-name">Name</label>
            <input type="text" id="register-name" name="name" placeholder="Your Name" required>
            <label for="register-password">Password</label>
            <input type="password" id="register-password" name="password" placeholder="Password" required>
            <label for="register-password-confirm">Confirm Password</label>
            <input type="password" id="register-password-confirm" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" class="yellow">Register</button>
        </form>
        <p class="register-message" id="register-message"></p>
        <p class="register-login-link">Already have an account? <a href="#" id="login-link-from-register">Login here</a></p>
    </div>
</div>

<!-- no submit button needed only hit enter to submit the form -->
<script>
    // Get the input field
    var loginLink = document.getElementById("login-link");
    var loginModal = document.getElementById("login-modal");
    var loginModalClose = document.getElementById("login-modal-close");
    var loginModalOverlay = document.getElementById("login-modal-overlay");
    var loginMessage = document.getElementById("login-message");
    var registerLink = document.getElementById("register-link");
    var registerModal = document.getElementById("register-modal");
    var registerModalClose = document.getElementById("register-modal-close");
    var registerModalOverlay = document.getElementById("register-modal-overlay");
    var registerMessage = document.getElementById("register-message");
    var loginLinkFromRegister = document.getElementById("login-link-from-register");

    function openLoginModal() {
        loginModal.classList.remove("hidden");
        loginModal.setAttribute("aria-hidden", "false");
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        document.getElementById("login-email").focus();
    }

    function closeLoginModal() {
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        loginMessage.textContent = "";
    }

    function openRegisterModal() {
        registerModal.classList.remove("hidden");
        registerModal.setAttribute("aria-hidden", "false");
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        document.getElementById("register-email").focus();
    }

    function closeRegisterModal() {
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        registerMessage.textContent = "";
    }

    if (loginLink) {
        loginLink.addEventListener("click", function (event) {
            event.preventDefault();
            openLoginModal();
        });
    }

    if (loginModalClose) {
        loginModalClose.addEventListener("click", closeLoginModal);
    }

    if (loginModalOverlay) {
        loginModalOverlay.addEventListener("click", closeLoginModal);
    }

    if (registerLink) {
        registerLink.addEventListener("click", function (event) {
            event.preventDefault();
            openRegisterModal();
        });
    }

    if (registerModalClose) {
        registerModalClose.addEventListener("click", closeRegisterModal);
    }

    if (registerModalOverlay) {
        registerModalOverlay.addEventListener("click", closeRegisterModal);
    }

    if (loginLinkFromRegister) {
        loginLinkFromRegister.addEventListener("click", function (event) {
            event.preventDefault();
            openLoginModal();
        });
    }

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            if (loginModal && !loginModal.classList.contains("hidden")) {
                closeLoginModal();
            }
            if (registerModal && !registerModal.classList.contains("hidden")) {
                closeRegisterModal();
            }
        }
    });

</script>

<script>
    
</script>