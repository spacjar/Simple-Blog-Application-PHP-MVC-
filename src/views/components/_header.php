<header class="header">
    <div class="container">
        <nav>
            <a href="<?php echo BASE_URL . '/'; ?>" class="header__logo">Dev blog</a>
            <div class="header__buttons">
                <?php if(Application::isGuest()): ?>
                    <a href="<?php echo BASE_URL . '/login'; ?>" class="cta cta__secondary">Login</a>
                    <a href="<?php echo BASE_URL . '/register'; ?>" class="cta cta__primary">Register</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL . '/dashboard/posts'; ?>"><?php echo Application::isAdmin() ? "All posts" : "Your posts"; ?></a>
                    <a href="<?php echo BASE_URL . '/dashboard/posts/new'; ?>" class="cta cta__primary">New post</a>
                    <form action="<?php echo BASE_URL . '/logout'; ?>" method="POST">
                        <button type="submit" class="cta cta__secondary">Logout (@<?php echo Application::$app->user->getDisplayName() ?>)</button>
                    </form>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>