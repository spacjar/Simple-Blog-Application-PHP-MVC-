<?php
    require_once '../config_db.php';
    require_once "./blog_controller.inc.php";
    require_once "./blog_view.inc.php";

    $posts = get_all_posts($pdo);
    


?>