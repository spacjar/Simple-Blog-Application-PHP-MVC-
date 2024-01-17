<?php
    require_once __DIR__ . "/components/_pagination.php";

    $posts = $posts ?? [];
    $page = intval($page) ?: 1;
    $totalPages = intval($totalPages) ?: 1;
?>

<section class="dashboard__list">
    <div class="container">
        <h1 class="dashaboar__title">Your posts</h1>

        <table class="dashboard__table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <?php
                        if (Application::isAdmin()) {
                            echo "<th>Author</th>";
                        }
                    ?>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($posts)): ?>
                    <tr>
                        <td colspan="<?php echo Application::isAdmin() ? '5' : '4'; ?>">No posts found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td data-label="ID"><?php echo htmlspecialchars($post['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Title"><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <?php
                                if (Application::isAdmin()) {
                                    echo '<td data-label="Author">@' . htmlspecialchars($post['author_id'], ENT_QUOTES, 'UTF-8') . '</td>';
                                }
                            ?>

                            <td data-label="Created at"><?php echo htmlspecialchars((new DateTime($post['created_at']))->format('F j, Y'), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td data-label="Actions">
                                <?php
                                if($post['deleted'] === 0) {
                                    echo "<a href='/dashboard/posts/edit/" . htmlspecialchars($post["id"], ENT_QUOTES, 'UTF-8') . "' class='cta cta__secondary'>Edit</a>";
                                    echo "<form action='/dashboard/posts/delete/". htmlspecialchars($post["id"], ENT_QUOTES, 'UTF-8') . "' method='POST'><button class='cta cta__secondary'>Delete</button></form>";
                                } else if (Application::isAdmin()) {
                                    echo "<p>Deleted</p>";
                                    // echo "<form action='/dashboard/posts/restore/". htmlspecialchars($post["id"], ENT_QUOTES, 'UTF-8') . "' method='POST'><button class='btn btn__secondary'>Restore</button></form>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<section class="dashboard__pagination">
    <div class="container">
        <?php
            generatePagination($page, $totalPages);
        ?>
    </div>
</section>