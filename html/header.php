<?php
$_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
?>

<header class="blue">
    <a href="index.php"><img src="images/logo.png" alt="Logo" class="main-logo"></a>
    <!-- search form -->
    <form action="search.php" method="get" class="search-form">
        <input type="text" name="search" id="search-input" class="yellow" placeholder="Search...">
        <!-- hidden submit button for accessibility and to allow form submission with Enter key -->
        <button type="submit" id="search-btn" hidden>Search</button>
    </form>
    <nav>
        <ul id="main-buttons">
            <?php
                if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                    echo '<li><a href="admin.php" class="yellow">Admin</a></li>';
                }
            ?>
             <ul id="main-buttons">
            <?php
                if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === 1) {
                    echo '<li><a href="admin-reviews.php" class="yellow">reviews</a></li>';
                } 
            ?>
            </ul>
            <li><a href="aboutUs.php" class="yellow">About</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<li><a href="profile.php" class="yellow">Profile</a></li>';
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
        <p class="forgot-password-link"><a href="#" id="forgot-password-link">Forgot Password?</a></p>
        <p class="login-register-link">Don't have an account? <a href="#" id="register-link">Register here</a></p>
    </div>
</div>

<!-- Register modal structure (hidden by default) -->
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
            <input type="password" id="register-password-confirm" name="confirm_password" placeholder="Confirm Password"
                required>
            <button type="submit" class="yellow">Register</button>
        </form>
        <p class="register-message" id="register-message"></p>
        <p class="register-login-link">Already have an account? <a href="#" id="login-link-from-forgot">Login here</a>
        </p>
    </div>
</div>

<!-- Login modal structure (hidden by default) -->
<div id="forgot-password-code-modal" class="modal hidden" aria-hidden="true">
    <div class="modal-overlay" id="forgot-password-code-modal-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="forgot-password-code-modal-title">
        <button type="button" class="modal-close" id="forgot-password-code-modal-close"
            aria-label="Close forgot password code form">×</button>
        <h2 id="forgot-password-code-modal-title">Forgot Password</h2>
        <form action="auth/verify_code.php" method="post" class="forgot-password-form">
            <label for="forgot-password-email">Email</label>
            <input type="email" id="forgot-password-email" name="email" placeholder="you@example.com" required>
            <button type="submit" class="yellow">Send Code</button>
        </form>
        <p class="register-login-link">Already have an account? <a href="#" id="login-link-from-register">Login here</a>
        </p>
    </div>

</div>

<!-- Code verification modal (hidden by default) -->
<div id="code-verify-modal" class="modal hidden" aria-hidden="true">
    <div class="modal-overlay" id="code-verify-modal-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="code-verify-modal-title">
        <button type="button" class="modal-close" id="code-verify-modal-close"
            aria-label="Close code verification form">×</button>
        <h2 id="code-verify-modal-title">Enter Verification Code</h2>
        <form action="auth/verify_code.php" method="post" class="code-verify-form">
            <span class="code-hint">The code is always 1234</span>
            <br>
            <label for="code-input">Verification Code</label>
            <input type="text" id="code-input" name="code" placeholder="Enter verification code" required>
            <button type="submit" class="yellow">Verify</button>
        </form>
    </div>
</div>

<!-- password reset modal (hidden by default) -->
<div id="password-reset-modal" class="modal hidden" aria-hidden="true">
    <div class="modal-overlay" id="password-reset-modal-overlay"></div>
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="password-reset-modal-title">
        <button type="button" class="modal-close" id="password-reset-modal-close"
            aria-label="Close password reset form">×</button>
        <h2 id="password-reset-modal-title">Reset Password</h2>
        <form action="auth/reset_password.php" method="post" class="password-reset-form">
            <label for="new-password">New Password</label>
            <input type="password" id="new-password" name="new_password" placeholder="New Password" required>
            <label for="confirm-new-password">Confirm New Password</label>
            <input type="password" id="confirm-new-password" name="confirm_new_password"
                placeholder="Confirm New Password" required>
            <button type="submit" class="yellow">Reset Password</button>
        </form>
    </div>
</div>

<?php
if (isset($_SESSION['error'])) {

    ?>
    <script>
        alert("<?php echo addslashes($_SESSION['error']); ?>");
    </script>

    <?php
    unset($_SESSION['error']);
}
?>

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
    var forgotPasswordCodeModal = document.getElementById("forgot-password-code-modal");
    var forgotPasswordCodeModalClose = document.getElementById("forgot-password-code-modal-close");
    var forgotPasswordCodeModalOverlay = document.getElementById("forgot-password-code-modal-overlay");
    var loginLinkFromRegister = document.getElementById("login-link-from-register");
    var forgotPasswordLink = document.getElementById("forgot-password-link");
    var loginLinkFromForgot = document.getElementById("login-link-from-forgot");
    var codeVerifyModal = document.getElementById("code-verify-modal");
    var codeVerifyModalClose = document.getElementById("code-verify-modal-close");
    var codeVerifyModalOverlay = document.getElementById("code-verify-modal-overlay");
    var passwordResetModal = document.getElementById("password-reset-modal");
    var passwordResetModalClose = document.getElementById("password-reset-modal-close");

    function openLoginModal() {
        loginModal.classList.remove("hidden");
        loginModal.setAttribute("aria-hidden", "false");
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        forgotPasswordCodeModal.classList.add("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "true");
        document.getElementById("login-email").focus();
    }

    function closeLoginModal() {
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        loginMessage.textContent = "";
        window.location.replace("auth/reset_forgot_password_cash.php");
    }

    function openRegisterModal() {
        registerModal.classList.remove("hidden");
        registerModal.setAttribute("aria-hidden", "false");
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        forgotPasswordCodeModal.classList.add("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "true");
        document.getElementById("register-email").focus();
    }

    function closeRegisterModal() {
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        registerMessage.textContent = "";
        window.location.replace("auth/reset_forgot_password_cash.php");
    }

    function openForgotPasswordCodeModal() {
        forgotPasswordCodeModal.classList.remove("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "false");
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        document.getElementById("forgot-password-email").focus();
    }

    function openCodeVerify() {
        codeVerifyModal.classList.remove("hidden");
        codeVerifyModal.setAttribute("aria-hidden", "false");
        forgotPasswordCodeModal.classList.add("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "true");
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
        var codeInput = document.getElementById("code-input");
        if (codeInput) codeInput.focus();
    }

    function closeCodeVerify() {
        codeVerifyModal.classList.add("hidden");
        codeVerifyModal.setAttribute("aria-hidden", "true");
        window.location.replace("auth/reset_forgot_password_cash.php");
    }

    function closeForgotPasswordCodeModal() {
        forgotPasswordCodeModal.classList.add("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "true");
        window.location.replace("auth/reset_forgot_password_cash.php");

    }

    function openPasswordResetModal() {
        passwordResetModal.classList.remove("hidden");
        passwordResetModal.setAttribute("aria-hidden", "false");
        codeVerifyModal.classList.add("hidden");
        codeVerifyModal.setAttribute("aria-hidden", "true");
        forgotPasswordCodeModal.classList.add("hidden");
        forgotPasswordCodeModal.setAttribute("aria-hidden", "true");
        loginModal.classList.add("hidden");
        loginModal.setAttribute("aria-hidden", "true");
        registerModal.classList.add("hidden");
        registerModal.setAttribute("aria-hidden", "true");
    }

    function closePasswordResetModal() {
        passwordResetModal.classList.add("hidden");
        passwordResetModal.setAttribute("aria-hidden", "true");
        window.location.replace("auth/reset_forgot_password_cash.php");
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

    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener("click", function (event) {
            event.preventDefault();
            openForgotPasswordCodeModal();
        });
    }

    if (loginLinkFromForgot) {
        loginLinkFromForgot.addEventListener("click", function (event) {
            event.preventDefault();
            openLoginModal();
        });
    }

    var codeVerified = <?php echo isset($_SESSION['code_verified']) && $_SESSION['code_verified'] === true ? 'true' : 'false'; ?>;
    var emailVerified = <?php echo isset($_SESSION['email_verified']) && $_SESSION['email_verified'] === true ? 'true' : 'false'; ?>;
    if (codeVerified) {
        openPasswordResetModal();
    }
    else if (emailVerified) {
        openCodeVerify();
    }

    if (forgotPasswordCodeModalClose) {
        forgotPasswordCodeModalClose.addEventListener("click", function (event) {
            event.preventDefault();
            closeForgotPasswordCodeModal();
        });
    }

    if (forgotPasswordCodeModalOverlay) {
        forgotPasswordCodeModalOverlay.addEventListener("click", function (event) {
            event.preventDefault();
            closeForgotPasswordCodeModal();
        });
    }

    if (codeVerifyModalClose) {
        codeVerifyModalClose.addEventListener("click", function (event) {
            event.preventDefault();
            closeCodeVerify();
        });
    }

    if (codeVerifyModalOverlay) {
        codeVerifyModalOverlay.addEventListener("click", function (event) {
            event.preventDefault();
            closeCodeVerify();
        });
    }

    if (passwordResetModalClose) {
        passwordResetModalClose.addEventListener("click", function (event) {
            event.preventDefault();
            closePasswordResetModal();
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
            if (forgotPasswordCodeModal && !forgotPasswordCodeModal.classList.contains("hidden")) {
                closeForgotPasswordCodeModal();
            }
            if (codeVerifyModal && !codeVerifyModal.classList.contains("hidden")) {
                closeCodeVerify();
            }
        }
    });

</script>