<?php
    include 'DB/database.php';
    include "components/_post.php";

    $posts = $database->getAllPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Jaroslav Špác</title>
    <meta name="description" content="Osobní blog Jaroslava Špáce">

    <!-- Links and scripts -->
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/blog-post.css">

    <!-- Components -->
    <link rel="stylesheet" href="styles/components/_header.css">
    <link rel="stylesheet" href="styles/components/_footer.css">
    <link rel="stylesheet" href="styles/components/_buttons.css">
</head>
<body>
    <?php 
        include "components/_header.php";
    ?>
    <main>
        <section class="blog-highlight">
            <div class="container">
                <a class="blog-highlight-card" href="post-detail.php">
                    <!-- Post thumbnail image -->
                    <img src="./assets/placeholder.png" alt="Blog post image" class="blog-highlight-card__image">
                    <div class="blog-highlight-card__content">
                        <!-- Post details -->
                        <div class="blog-highlight-card__detail">
                            <p class="blog-highlight-card__category">Category</p>
                            <h2 class="blog-highlight-card__header">Blog title heading will go here</h2>
                            <p class="blog-highlight-card__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
                        </div>
                        <!-- Post information -->
                        <div class="blog-highlight-card__info">
                            <img src="./assets/placeholder.png" alt="Blog post image" class="blog-highlight-card__avatar">
                            <div>
                                <p class="blog-highlight-card__author">Author name</p>
                                <p class="blog-highlight-card__date">11 Jan 2022</p>
                                <!-- <div>
                                    <p class="blog-post-card__read-time">5 min</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
        <section class="blog-posts">
            <div class="container">
                <?php
                    foreach($posts as $post) {
                        echo generateBlogPostCard("#tag", $post['title'], $post['content'], $post["username"], $post["created_at"], 5);
                    }
                ?>
            </div>
        </section>
    </main>
    <?php 
        include "components/_footer.html";
    ?>
</body>
</html>