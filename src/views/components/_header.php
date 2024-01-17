<header class="header">
    <div class="container">
        <nav>
            <a href="./" class="header__logo">Dev blog</a>
            <div class="header__buttons">
                <?php if(Application::isGuest()): ?>
                    <a href="login" class="cta cta__secondary">Login</a>
                    <a href="register" class="cta cta__primary">Register</a>
                <?php else: ?>
                    <a href="dashboard/posts"><?php echo Application::isAdmin() ? "All posts" : "Your posts"; ?></a>
                    <a href="dashboard/posts/new" class="cta cta__primary">New post</a>
                    <form action="logout" method="POST">
                        <button type="submit" class="cta cta__secondary">Logout (@<?php echo Application::$app->user->getDisplayName() ?>)</button>
                    </form>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>