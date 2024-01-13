<?php
    declare(strict_types=1);

    function get_posts(object $pdo) {
        return get_all_posts($pdo);
    }
?>