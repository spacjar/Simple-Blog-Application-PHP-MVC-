<div class="container">
    <nav>
        <a href="/" class="header__logo">Dev blog</a>
        <div class="header__buttons">
            <a href="/">Home</a>
            <?php if(Application::isGuest()): ?>
                <a href="/login" class="cta cta__secondary">Login</a>
                <a href="/register" class="cta cta__primary">Register</a>
            <?php else: ?>
                <a href="/dashboard">Dashboard</a>
                <a href="/dashboard/posts">Your posts</a>
                <a href="/dashboard/posts/new">New post</a>
                <a href="/dashboard/users">Users</a>
                <form action="/logout" method="POST">
                    <button type="submit" class="cta cta__primary">@<?php echo Application::$app->user->getDisplayName() ?> (Logout)</button>
                </form>
            <?php endif; ?>
        </div>
    </nav>
</div>