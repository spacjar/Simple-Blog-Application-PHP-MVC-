<?php
    require_once "includes/config_session.inc.php";
    require_once "includes/login/login_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog - Jaroslav Špác</title>

    <!-- Links and scripts -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/pages/signforms.css">
    <script defer src="scripts/pages/login/login-validations.js" type="module"></script>

    <!-- Components -->
    <link rel="stylesheet" href="styles/components/_header.css">
    <link rel="stylesheet" href="styles/components/_buttons.css">
    <link rel="stylesheet" href="styles/components/_forms.css">
    <link rel="stylesheet" href="styles/components/_footer.css">
</head>
<body>
    <?php 
        include 'components/_header.html';
    ?>
    <main class="sign">
        <div class="container">
            <div class="sign-description">
                <h1 class="heading-2">Log In</h1>
                <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
            </div>
            <form id="login-form" class="sign-form" method="POST" action="includes/login/login.inc.php">
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
        include 'components/_footer.html'; 
    ?>
</body>
</html>