<?php
    function generateBlogPostCard($id, $category, $title, $description, $author, $date, $postImage, $avatarImage = './assets/images/placeholder.png') {
        $postImageURI = !empty($postImage) ? htmlspecialchars($postImage, ENT_QUOTES, 'UTF-8') : './assets/images/placeholder.png';
        $avatarImageURI = !empty($avatarImage) ? htmlspecialchars($avatarImage, ENT_QUOTES, 'UTF-8') : './assets/images/placeholder.png';
        
        return '
            <a class="blog-post-card" href="/post/'.htmlspecialchars($id, ENT_QUOTES, 'UTF-8').'">
                <!-- Post thumbnail image -->
                <img src="'.$postImageURI.'" alt="Blog post image" class="blog-post-card__image">
                <!-- Post details -->
                <div class="blog-post-card__detail">
                    <p class="blog-post-card__category">'.htmlspecialchars($category, ENT_QUOTES, 'UTF-8').'</p>
                    <h2 class="blog-post-card__header">'.htmlspecialchars($title, ENT_QUOTES, 'UTF-8').'</h2>
                    <p class="blog-post-card__description">'.htmlspecialchars($description, ENT_QUOTES, 'UTF-8').'</p>
                </div>
                <!-- Post information -->
                <div class="blog-post-card__info">
                    <img src="'.$avatarImageURI.'" alt="Blog post image" class="blog-post-card__avatar">
                    <div>
                        <p class="blog-post-card__author">@'.htmlspecialchars($author, ENT_QUOTES, 'UTF-8').'</p>
                        <p class="blog-post-card__date">'.htmlspecialchars((new DateTime($date))->format('F j, Y'), ENT_QUOTES, 'UTF-8').'</p>
                    </div>
                </div>
            </a>
        ';
    }
?>