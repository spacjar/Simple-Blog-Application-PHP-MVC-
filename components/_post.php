<?php
    function generateBlogPostCard($category, $title, $description, $author, $date, $readTime, $postImage = './assets/placeholder.png', $avatarImage = './assets/placeholder.png') {
        return '
            <a class="blog-post-card" href="post-detail.php">
                <!-- Post thumbnail image -->
                <img src="'.$postImage.'" alt="Blog post image" class="blog-post-card__image">
                <!-- Post details -->
                <div class="blog-post-card__detail">
                    <p class="blog-post-card__category">'.$category.'</p>
                    <h2 class="blog-post-card__header">'.$title.'</h2>
                    <p class="blog-post-card__description">'.$description.'</p>
                </div>
                <!-- Post information -->
                <div class="blog-post-card__info">
                    <img src="'.$avatarImage.'" alt="Blog post image" class="blog-post-card__avatar">
                    <div>
                        <p class="blog-post-card__author">@'.$author.'</p>
                        <p class="blog-post-card__date">'.$date.'</p>
                        <div>
                            <p class="blog-post-card__read-time">'.$readTime.' min</p>
                        </div>
                    </div>
                </div>
            </a>
        ';
    }
?>