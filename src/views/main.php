<?php
    require_once __DIR__ . "/components/_post.php";
    require_once __DIR__ . "/components/_pagination.php";

    $posts = $posts ?? [];
    $page = intval($page) ?: 1;
    $totalPages = intval($totalPages) ?: 1;
?>

<main>
    <section class="blog-highlight">
        <div class="container">
        <?php
            if (empty($posts)) {
                echo "<p>No posts found</p>";
            } else {
                $firstPost = array_shift($posts);
        ?>

            <a class="blog-highlight-card" href="/post/<?php echo htmlspecialchars($firstPost["id"]); ?>">
                <!-- Post thumbnail image -->
                <img src="./assets/images/placeholder.png" alt="Blog post image" class="blog-highlight-card__image">
                <div class="blog-highlight-card__content">
                    <!-- Post details -->
                    <div class="blog-highlight-card__detail">
                        <p class="blog-highlight-card__category">Category</p>
                        <h2 class="blog-highlight-card__header"><?php echo htmlspecialchars($firstPost["title"]); ?></h2>
                        <p class="blog-highlight-card__description"><?php echo htmlspecialchars($firstPost["content"]); ?></p>
                    </div>
                    <!-- Post information -->
                    <div class="blog-highlight-card__info">
                        <img src="./assets/images/placeholder.png" alt="Blog post image" class="blog-highlight-card__avatar">
                        <div>
                            <p class="blog-highlight-card__author">@<?php echo htmlspecialchars($firstPost["author_id"]); ?></p>
                            <!-- <p class="blog-highlight-card__date"><?php echo htmlspecialchars($firstPost["created_at"]); ?></p> -->
                            <p class="blog-highlight-card__date"><?php echo htmlspecialchars((new DateTime($firstPost["created_at"]))->format('F j, Y')); ?></p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <?php
            }
        ?>
    </section>
    <section class="blog-posts">
        <div class="container">
            <?php
                if (empty($posts)) {
                    echo "<p>No more posts found.</p>";
                } else {
                    foreach ($posts as $post) {
                        echo generateBlogPostCard(
                            $post["id"],
                            "Category",
                            $post["title"],
                            $post["content"],
                            $post["author_id"],
                            $post["created_at"],
                            // $post["image"],
                            // $post["avatar"]
                        );
                    }
                }
            ?>
        </div>
    </section>
    <section>
        <div class="container">
            <?php
                generatePagination($page, $totalPages);
            ?>
        </div>
    </section>
</main>