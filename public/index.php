<?php
    require_once __DIR__ . "/../src/core/Application.php";
    require_once __DIR__ . "/../src/controllers/AuthController.php";
    require_once __DIR__ . "/../src/controllers/BlogController.php";
    require_once __DIR__ . "/../src/controllers/DashboardController.php";
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
    $app->router->get('/', [BlogController::class, "handleList"]);
    $app->router->get('/post/{id}', [BlogController::class, "handleDetailList"]);

    // Dashboard routes
    $app->router->get('/dashboard', [DashboardController::class, "dashboard"]);

    // Dashboard posts routes
    $app->router->get('/dashboard/posts', [DashboardController::class, "dashboardPosts"]);
    $app->router->get('/dashboard/posts/{post-id}', [DashboardController::class, "dashboardPost"]);
    $app->router->get('/dashboard/posts/new', [DashboardController::class, "dashboardPostNew"]);
    $app->router->post('/dashboard/posts/new', [DashboardController::class, "dashboardPostNew"]);
    $app->router->get('/dashboard/posts/{post-id}/edit', [DashboardController::class, "dashboardPostEdit"]);
    $app->router->post('/dashboard/posts/{post-id}/delete', [DashboardController::class, "dashboardPostDelete"]);


    // Dashboard users routes
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