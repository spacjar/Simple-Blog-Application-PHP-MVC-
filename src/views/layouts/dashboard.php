<?php
    require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ZWA Term Project - Blog - Dashboard</title>

    <link rel="stylesheet" href="../static/css/main.css">
<body>
    <?php require_once __DIR__ . "/../components/_header.php"; ?>
    {{content}}
    <?php require_once __DIR__ . "/../components/_footer.php"; ?>
</body>
</html>