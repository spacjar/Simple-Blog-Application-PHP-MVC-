<?php
    require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ZWA Term Project - Blog - Dashboard</title>

        <link rel="stylesheet" href="../../../static/css/main.css">
        <link rel="stylesheet" href="../../../static/css/pages/dashboard.css">
        <link rel="stylesheet" href="../../../../static/css/pages/post-form.css">
    </head>
    <body>
        <?php require_once __DIR__ . "/../components/_header.php"; ?>
        <div class="dashboard">
            {{content}}
        </div>
        <?php require_once __DIR__ . "/../components/_footer.php"; ?>
        <!-- <script src="../static/js/pages/dashboard/post-form-validation.js" type="module"></script> -->
    </body>
</html>