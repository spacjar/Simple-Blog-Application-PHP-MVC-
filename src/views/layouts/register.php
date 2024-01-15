<?php
    require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ZWA Term Project - Blog - Register</title>

        <link rel="stylesheet" href="../static/css/main.css">
        <link rel="stylesheet" href="../static/css/pages/auth-form.css">
    </head>
    <body>
        <header class="header">
            <?php require_once __DIR__ . "/../components/_navbar.php"; ?>
        </header>
        {{content}}
        
        <script src="../static/js/pages/auth/register-validations.js" type="module"></script>
    </body>
</html>