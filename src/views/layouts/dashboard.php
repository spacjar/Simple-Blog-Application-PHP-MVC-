<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZWA Term Project - Blog - Dashboard</title>

    <link rel="stylesheet" href="../assets/css/main.css">
<body>
    <header class="header">
        <div class="container">
            <nav>
                <a href="/" class="header__logo">Dev blog</a>
                <div class="header__buttons">
                    <a href="/">Home</a>
                    <a href="/dashboard" class="cta cta__primary">Dashboard</a>
                    <a href="/dashboard/posts" class="cta cta__secondary">Your posts</a>
                    <a href="/dashboard/users" class="cta cta__secondary">Users</a>
                    <form>
                        <button type="submit" class="cta cta__primary">Logout</button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <div class="container">
        {{content}}
    </div>
</body>
</html>