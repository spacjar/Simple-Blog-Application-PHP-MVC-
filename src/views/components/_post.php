<?php
    function generateBlogPostCard($id, $category, $title, $description, $author, $date, $readTime, $postImage = './assets/images/placeholder.png', $avatarImage = './assets/images/placeholder.png') {
        return '
            <a class="blog-post-card" href="/post/'.htmlspecialchars($id).'">
                <!-- Post thumbnail image -->
                <img src="'.htmlspecialchars($postImage).'" alt="Blog post image" class="blog-post-card__image">
                <!-- Post details -->
                <div class="blog-post-card__detail">
                    <p class="blog-post-card__category">'.htmlspecialchars($category).'</p>
                    <h2 class="blog-post-card__header">'.htmlspecialchars($title).'</h2>
                    <p class="blog-post-card__description">'.htmlspecialchars($description).'</p>
                </div>
                <!-- Post information -->
                <div class="blog-post-card__info">
                    <img src="'.htmlspecialchars($avatarImage).'" alt="Blog post image" class="blog-post-card__avatar">
                    <div>
                        <p class="blog-post-card__author">@'.htmlspecialchars($author).'</p>
                        <p class="blog-post-card__date">'.htmlspecialchars($date).'</p>
                        <div>
                            <p class="blog-post-card__read-time">'.htmlspecialchars($readTime).' min</p>
                        </div>
                    </div>
                </div>
            </a>
        ';
    }
?>