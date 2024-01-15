<?php
    require_once __DIR__ . "/../../../src/core/Application.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $this->title ?></title>

    <link rel="stylesheet" href="../static/css/main.css">
    <link rel="stylesheet" href="../static/css/blog-post.css">
</head>
<body>
    <header class="header">
        <?php require_once __DIR__ . "/../components/_navbar.php"; ?>
    </header>
    {{content}}
</body>
</html>