<?php
    require_once __DIR__ . "/components/_post.php";
    require_once __DIR__ . "/components/_pagination.php";
    require_once __DIR__ . "../../utils/text-util.php";

    $posts = $posts ?? [];
    $page = intval($page) ?: 1;
    $totalPages = intval($totalPages) ?: 1;
?>

<main>
    <?php if ($page === 1 && !empty($posts)): ?>
        <?php $firstPost = $posts[0]; ?>
        <section class="blog-highlight">
            <div class="container">
                <a class="blog-highlight-card" href="post/<?php echo htmlspecialchars($firstPost["id"], ENT_QUOTES, 'UTF-8'); ?>">
                    <!-- Post thumbnail image -->
                    <img src="<?php echo $firstPost["thumbnail_uri"] ? htmlspecialchars($firstPost["thumbnail_uri"], ENT_QUOTES, 'UTF-8') : './assets/images/placeholder.png' ?>" alt="Blog post image" class="blog-highlight-card__image">
                    <div class="blog-highlight-card__content">
                        <!-- Post details -->
                        <div class="blog-highlight-card__detail">
                            <p class="blog-highlight-card__category">Category</p>
                            <h2 class="blog-highlight-card__header"><?php echo htmlspecialchars(truncateString($firstPost["title"], 100), ENT_QUOTES, 'UTF-8'); ?></h2>
                            <p class="blog-highlight-card__description"><?php echo htmlspecialchars(truncateString($firstPost["content"], 200), ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <!-- Post information -->
                        <div class="blog-highlight-card__info">
                            <img src="./assets/images/placeholder.png" alt="Blog post image" class="blog-highlight-card__avatar">
                            <div>
                                <p class="blog-highlight-card__author">@<?php echo htmlspecialchars($firstPost["author_id"], ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="blog-highlight-card__date"><?php echo htmlspecialchars((new DateTime($firstPost["created_at"]))->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    <?php endif; ?>
    
    <section class="blog-posts">
        <div class="container">
            <?php if (empty($posts)): ?>
                <p>No more posts found.</p>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <?php echo generateBlogPostCard(
                        $post["id"],
                        "Category",
                        truncateString($post["title"], 100),
                        truncateString($post["content"], 200),
                        $post["author_id"],
                        $post["created_at"],
                        $post["thumbnail_uri"],
                    ); ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <section>
        <div class="container">
            <?php generatePagination($page, $totalPages); ?>
        </div>
    </section>
</main>