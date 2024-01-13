<?php
    require_once "./src/includes/blog/blog.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Jaroslav Špác</title>
    <meta name="description" content="Osobní blog Jaroslava Špáce">

    <!-- Links and scripts -->
    <link rel="stylesheet" href="./src/styles/main.css">
    <link rel="stylesheet" href="./src/styles/blog-post.css">

    <!-- Components -->
    <link rel="stylesheet" href="./src/styles/components/_header.css">
    <link rel="stylesheet" href="./src/styles/components/_footer.css">
    <link rel="stylesheet" href="./src/styles/components/_buttons.css">
</head>
<body>
    <?php 
        include "./src/components/_header.php";
    ?>
    <main>
        <section class="blog-highlight">
            <div class="container">
                <a class="blog-highlight-card" href="post-detail.php">
                    <!-- Post thumbnail image -->
                    <img src="./public/assets/placeholder.png" alt="Blog post image" class="blog-highlight-card__image">
                    <div class="blog-highlight-card__content">
                        <!-- Post details -->
                        <div class="blog-highlight-card__detail">
                            <p class="blog-highlight-card__category">Category</p>
                            <h2 class="blog-highlight-card__header">Blog title heading will go here</h2>
                            <p class="blog-highlight-card__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
                        </div>
                        <!-- Post information -->
                        <div class="blog-highlight-card__info">
                            <img src="./public/assets/placeholder.png" alt="Blog post image" class="blog-highlight-card__avatar">
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
                    generate_posts($all_blog_posts);
                ?>
            </div>
        </section>
    </main>
    <?php 
        include "./src/components/_footer.html";
    ?>
</body>
</html>