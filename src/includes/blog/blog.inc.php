<?php
    require_once '../config_db.php';
    require_once "./blog_model.inc.php";
    require_once "./blog_controller.inc.php";

    $all_blog_posts = get_all_posts($pdo) ?: [];
?>