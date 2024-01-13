<header class="header">
    <div class="container">
        <nav>
            <a href="index.php" class="header__logo">spacjar.dev blog</a>
            <div class="header__buttons">
                <?php
                    if(isset($_SESSION["user_id"])) {
                        echo '
                            <form method="POST" action="./src/includes/login/logout.inc.php">
                                <button class="cta cta__primary" type="submit">Logout</button>
                            </form>
                        ';
                    } else {
                        echo '
                            <a href="signup.php" class="cta cta__primary">Sign up</a>
                            <a href="login.php" class="cta cta__secondary">Login</a>
                        ';
                    }
                ?>
            </div>
        </nav>
    </div>
</header>