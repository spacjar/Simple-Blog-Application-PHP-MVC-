<?php
    if(empty($postDetail)) {
        throw new NotFoundException();
    }

    $postThumbnail = $postDetail['thumbnail_uri'] ? htmlspecialchars($postDetail['thumbnail_uri'], ENT_QUOTES, 'UTF-8') : 'assets/images/placeholder.png';
?>

<main class="blog-detail">
    <div class="blog-detail-header">
        <div class="container">
            <h1 class="heading-1"><?php echo htmlspecialchars($postDetail['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
    </div>
    <div class="blog-detail-information">
        <div class="container">
            <div class="blog-detail-information__info">
                <img src="assets/images/placeholder.png" alt="Blog post image" class="blog-detail-information__avatar">
                <div>
                    <p class="blog-detail-information__author">@<?php echo htmlspecialchars($postDetail['author_id'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="blog-detail-information__date"><?php echo htmlspecialchars((new DateTime($postDetail["created_at"]))->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-detail-thumbnail">
        <div class="container">
            <img src="<?php echo $postThumbnail; ?>" alt="Blog thumbnail">
        </div>
    </div>
    <div class="blog-detail-content">
        <div class="container">
            <div class="blog-detail-content__section">
                <?php echo htmlspecialchars($postDetail['content'], ENT_QUOTES, 'UTF-8'); ?>
            </div>
        </div>
    </div>
</main>