<?php
    require_once __DIR__ . "/components/_pagination.php";

    $posts = $posts ?? [];
    $page = intval($page) ?: 1;
    $totalPages = intval($totalPages) ?: 1;
?>

<section>
<div class="container">
    <h1 class="dashaboar__title">Your posts</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <!-- <th>Author</th> -->
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($posts)): ?>
                <tr>
                    <!-- <td colspan="5">No posts found.</td> -->
                    <td colspan="4">No posts found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td data-label="ID"><?php echo htmlspecialchars($post['id']); ?></td>
                        <td data-label="Title"><?php echo htmlspecialchars($post['title']); ?></td>
                        <!-- <td data-label="Author">@<?php echo htmlspecialchars($post['author_id']); ?></td> -->
                        <td data-label="Created at"><?php echo htmlspecialchars((new DateTime($post['created_at']))->format('F j, Y')); ?></td>
                        <td data-label="Actions">
                            <?php
                            if($post['deleted'] === 0) {
                                echo "<a href='/dashboard/posts/edit/" . htmlspecialchars($post["id"]) . "' class='cta cta__secondary'>Edit</a>";
                                echo "<form action='/dashboard/posts/delete/". htmlspecialchars($post["id"]) . "' method='POST'><button class='cta cta__secondary'>Delete</button></form>";
                            } else if (Application::isAdmin()) {
                                echo "<p>Deleted</p>";
                                // echo "<form action='/dashboard/posts/restore/". htmlspecialchars($post["id"]) . "' method='POST'><button class='btn btn__secondary'>Restore</button></form>";
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
<section>
    <div class="container">
        <?php
            generatePagination($page, $totalPages);
        ?>
    </div>
</section>