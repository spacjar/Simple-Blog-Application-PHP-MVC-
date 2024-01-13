<?php
    require_once "./src/includes/config_session.inc.php";
    require_once "./src/includes/signup/signup_view.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Blog - Jaroslav Špác</title>

    <!-- Links and scripts -->
    <link rel="stylesheet" href="./src/styles/main.css">
    <link rel="stylesheet" href="./src/styles/pages/signforms.css">
    <script defer src="./src/scripts/pages/auth/sign-up-validations.js" type="module"></script>

    <!-- Components -->
    <link rel="stylesheet" href="./src/styles/components/_header.css">
    <link rel="stylesheet" href="./src/styles/components/_buttons.css">
    <link rel="stylesheet" href="./src/styles/components/_forms.css">
    <link rel="stylesheet" href="./src/styles/components/_footer.css">
</head>
<body>
    <?php 
        include "./src/components/_header.php";
    ?>
    <main class="sign">
        <div class="container">
            <div class="sign-description">
                <h1 class="heading-2">Sign Up</h1>
                <p class="text-medium">Lorem ipsum dolor sit amet adipiscing elit.</p>
            </div>
            <form id="sign-form" class="sign-form" method="POST" action="./src/includes/signup/signup.inc.php">
                <?php
                    signup_inputs();
                ?>  
                <div class="sign-form__group">
                    <button class="cta cta__primary" type="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </main>
    <?php 
        include "./src/components/_footer.html";
    ?>
</body>
</html>