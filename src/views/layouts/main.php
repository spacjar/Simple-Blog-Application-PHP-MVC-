<?php
    require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZWA Term Project - Blog</title>

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/blog-post.css">
</head>
<body>
    <header class="header">
        <?php require_once __DIR__ . "/../components/_navbar.php"; ?>
    </header>
    {{content}}
</body>
</html>