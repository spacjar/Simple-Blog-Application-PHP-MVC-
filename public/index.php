<?php
    require_once __DIR__ . "/../src/core/Application.php";
    require_once __DIR__ . "/../src/controllers/AuthController.php";
    
    $app = new Application();

    $app->router->get('/', "main");
    $app->router->get('/login', [AuthController::class, "handleLogin"]);
    $app->router->post('/login', [AuthController::class, "handleLogin"]);
    $app->router->get('/register', [AuthController::class, 'handleRegister']);
    $app->router->post('/register', [AuthController::class, 'handleRegister']);
    $app->router->post('/logout', [AuthController::class, 'handleLogout']);
    $app->run();
?>