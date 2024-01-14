<?php
    require_once __DIR__ . "/../src/core/Application.php";
    require_once __DIR__ . "/../src/controllers/AuthController.php";
    // require_once __DIR__ . "/../src/controllers/BlogController.php";
    require_once __DIR__ . "/../src/config/config.php";
    
    $config = [
        "db" => [
            "host" => DB_HOST,
            "name" => DB_NAME,
            "user" => DB_USER,
            "password" => DB_PASSWORD,
        ],
        "userClass" => UserModel::class
    ];
    
    $app = new Application(dirname(__DIR__), $config);
    
    // General routes
    $app->router->get('/', "main");
    // $app->router->get('/blog/{post-id}', [BlogController::class, "getPost"]);

    // Dashboard routes
    $app->router->get('/dashboard', [AuthController::class, "dashboard"]);
    // $app->router->get('/dashboard/posts', "dashboard-posts");
    // $app->router->get('/dashboard/posts/{post-id}', "dashboard-post");
    // $app->router->get('/dashboard/posts/{post-id}/edit', "dashboard-post-edit");
    // $app->router->get('/dashboard/posts/new', "dashboard-post-new");
    // $app->router->get('/dashboard/users', "dashboard-users");
    // $app->router->get('/dashboard/users/{user-id}', "dashboard-user");
    // $app->router->get('/dashboard/users/{user-id}/edit', "dashboard-user-edit");


    // Auth routes
    $app->router->get('/login', [AuthController::class, "handleLogin"]);
    $app->router->post('/login', [AuthController::class, "handleLogin"]);
    $app->router->get('/register', [AuthController::class, 'handleRegister']);
    $app->router->post('/register', [AuthController::class, 'handleRegister']);
    $app->router->post('/logout', [AuthController::class, 'handleLogout']);
    $app->run();
?>