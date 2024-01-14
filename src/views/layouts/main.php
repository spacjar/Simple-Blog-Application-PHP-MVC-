<?php
    @require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZWA Term Project - Blog</title>

    <link rel="stylesheet" href="../assets/css/main.css">
<body>
    <?php
        echo "<pre>";
        var_dump(Application::$app->user);
        echo "</pre>";
    ?>

    <header class="header">
        <div class="container">
            <nav>
                <a href="/" class="header__logo">Dev blog</a>
                <div class="header__buttons">
                    <a href="/">Home</a>
                    <?php if(Application::isGuest()): ?>
                        <a href="/login">Login</a>
                        <a href="/register">Register</a>
                    <?php else: ?>
                        <a href="/dashboard">Dashboard</a>
                        <!-- <a href="/logout">@<?php echo Application::$app->user->getDisplayName() ?></a> -->
                        <p>@<?php echo Application::$app->user->getDisplayName() ?></p>
                        <form action="/logout" method="POST">
                            <button type="submit" class="cta cta__primary">Logout</button>
                        </form>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        {{content}}
    </div>
</body>
</html>