<?php
    require_once __DIR__ . "/../core/Application.php";
?>

<div class="container">
    <h1>Dashboard</h1>
    <?php
        if(Application::$app->session->getFlash('success')) {
            echo '<div class="alert alert-success">'.Application::$app->session->getFlash('success').'</div>';
        }
    ?>
</div>
