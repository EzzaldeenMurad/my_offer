<header>
    <div class="container">

        <div class="logo-container">
            <div class="logo-content">
                <img src="images/logo.png" alt="" height="80">
            </div>
        </div>
        <div class="profile-content">
            <img src="images/user.png" alt="Profile">
            <span>Account</span>
            <div class="auth-content">
                <a href="register.php">Register</a>
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['user_id'])) : ?>
                    <a href="submit-offer.php">Add Offer</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>