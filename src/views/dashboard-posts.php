<?php
    $posts = $posts ?? [];
?>

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
                                echo "<a href='/dashboard/posts/" . htmlspecialchars($post["id"]) . "/edit'>Edit</a>";
                                echo "<form action='/dashboard/posts/" . htmlspecialchars($post["id"]) . "/delete' method='POST'><button>Delete</button></form>";
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>