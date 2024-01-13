<?php
    require_once "./src/includes/config_session.inc.php";
    require_once "./src/includes/login/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog - Jaroslav Špác</title>

    <!-- Links and scripts -->
    <link rel="stylesheet" href="./src/styles/main.css">
    <link rel="stylesheet" href="./src/styles/pages/signforms.css">
    <script defer src="./src/scripts/pages/auth/login-validations.js" type="module"></script>

    <!-- Components -->
    <link rel="stylesheet" href="./src/styles/components/_header.css">
    <link rel="stylesheet" href="./src/styles/components/_buttons.css">
    <link rel="stylesheet" href="./src/styles/components/_forms.css">
    <link rel="stylesheet" href="./src/styles/components/_footer.css">
</head>
<body>
    <?php 
        include './src/components/_header.php';
    ?>
    <main class="sign">
        <div class="container">
            <?php
                if(isset($_SESSION["user_id"])) {
                    echo '
                        <h1 class="heading-2">You are already logged in as ' . $_SESSION["user_email"] .  '</h1>
                    ';
                }
            ?>
            <div class="sign-description">
                <h1 class="heading-2">Log In</h1>
                <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
            </div>
            <form id="login-form" class="sign-form" method="POST" action="./src/includes/login/login.inc.php">
                <?php
                    login_inputs();
                ?>
                <div class="sign-form__group">
                    <button class="cta cta__primary" type="submit">Log In</button>
                </div>
            </form>
        </div>
    </main>
    <?php 
        include './src/components/_footer.html'; 
    ?>
</body>
</html>