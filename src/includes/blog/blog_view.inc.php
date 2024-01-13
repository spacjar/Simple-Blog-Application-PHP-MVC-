<?php
    function generate_posts($posts) {
        foreach($posts as $post) {
            echo generateBlogPostCard("#tag", $post['title'], $post['content'], $post["username"], $post["created_at"], 5);
        }
    }
?>